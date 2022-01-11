import { Application } from "../entity/Application"
import axios from 'axios'
import { IWebhookClientEvent } from "../type/Interfaces"
import { createHmac } from 'crypto'
import { webhookQueue } from '../schedule'

export class Webhook {

    public static queue(name: string, data: any, app: Application, delay: number = 0) {
        const headers = {
            'X-Pusher-Key': app.key,
            'X-Pusher-Signature': ''
        }
        const payload = {
            name,
            ...data
        }

        const fullPayload = {
            time_ms: Date.now(),
            events: [payload]
        }

        headers["X-Pusher-Signature"] = createHmac('sha256', app.secret).update(JSON.stringify(fullPayload)).digest('hex').toString();

        const jobData = {
            headers,
            fullPayload,
            url: app.webhook
        }
        
        setTimeout(() => {
            webhookQueue.add(jobData)
        }, delay)
    }


    public static send(data: {url: string, fullPayload: unknown, headers: unknown }, callback: () => void) {

        axios.post(data.url, data.fullPayload, { headers: data.headers })
            .then((result) => {
                console.log("webhook result", result.data)
                callback()
            }).catch((error) => {
                console.log("webhook error", error)
            })
    }



    public  static publishChannelOccupied (channelName: string, app: Application)
    {
        this.queue('channel_occupied', {channel: channelName}, app)
    }

    public static pubishChannelVacated(channelName: string, app: Application) {
        this.queue('channel_vacated', { channel: channelName }, app)
    }

    public static publishChannelMemberAdded(channelName: string, userId: string, app: Application) {
        if (channelName.indexOf('presence-') === 0) {
            this.queue('member_added', {channel: channelName, user_id: userId }, app)
        }
    }

    public static publishChannelMemberRemoved(channelName:string, userId: string, app: Application) {
        if (channelName.indexOf('presence-') === 0) {
            this.queue('member_removed', {channel: channelName, user_id: userId }, app)
        }
    }

    public static publishClientEvent(data: IWebhookClientEvent, app: Application)
    {
        if (data.channel.indexOf('presence-') === 0 || data.channel.indexOf('presence-') === 0) {
            this.queue('client_event', data, app) 
        }
    }
}