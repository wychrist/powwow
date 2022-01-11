import {Column, CreateDateColumn, Entity, ManyToOne, PrimaryGeneratedColumn } from "typeorm";
import { Channel } from "./Channel";

@Entity()
export class ChannelClient {

    @PrimaryGeneratedColumn('uuid')
    id: string;

    @ManyToOne(()=> Channel, channel => channel.clients)
    channel: Channel 


    @Column({
        name: 'client_id',
        type: 'varchar',
        length: '255'
    })
    clientId: string;

    @Column({
        name: 'user_id',
        type: 'varchar',
        length: '255'
    })
    userId: string;

    @Column({
        type: 'text'
    })
    info: string;

    @CreateDateColumn()
    createdAt: Date;
}
