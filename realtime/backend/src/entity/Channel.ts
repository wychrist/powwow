import {
    Column,
    CreateDateColumn,
    Entity,
    OneToMany,
    ManyToOne,
    PrimaryGeneratedColumn,
    UpdateDateColumn
} from "typeorm";
import { Status } from "../type/status";
import { Application } from "./Application";
import { ChannelClient } from "./ChannelClient";

@Entity(
    { name: 'app_channel' }
)
export class Channel {

    @PrimaryGeneratedColumn('uuid')
    id: string;

    @ManyToOne(() => Application, application => application.channels)
    application: Application

    @Column({
        type: 'varchar',
        length: '255'
    })
    name: string

    @Column({
        type: 'int',
        default: '500'
    })
    limit: number;

    @Column({
        type: 'varchar',
        length: '255',
        default: `${Status.ACTIVE}`
    })
    status: string;

    @OneToMany(() => ChannelClient, client => client.channel)
    clients: ChannelClient[]

    @CreateDateColumn()
    createdAt: Date;

    @UpdateDateColumn()
    updatedAt: Date;
}
