import env from '../setup_env'
import * as Queue from 'bull'
import {Webhook} from '../pusher/Webhook'

const options = {
    redis: {
        host: env.REDIS_HOST,
        port: parseInt(env.REDIS_PORT, 10),
        username: env.REDIS_USER,
        password: env.REDIS_PASSWORD
    }
};

export const example = new Queue('example', options);
export const webhookQueue = new Queue('webhookQueue', options)

webhookQueue.process((job, done) => {
    Webhook.send(job.data, done);
})

example.process((job, done) => {
    console.info('------ processing job ---------');
    console.log(job.data);
    done();
    console.log('------ processing done -----');
})
