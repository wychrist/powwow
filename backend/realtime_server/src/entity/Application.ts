import { type } from "os";
import { Entity, PrimaryGeneratedColumn, Column, CreateDateColumn, UpdateDateColumn, DeleteDateColumn, OneToMany } from "typeorm";
import { ApplicationSetting } from "./ApplicationSetting";
import { Channel } from "./Channel";

@Entity()
export class Application {

    @PrimaryGeneratedColumn('uuid')
    id: string;

    @Column({
        type: 'varchar',
        length: '255'
    })
    name: string;

    @Column({
        type: 'varchar',
        length: '255'
    })
    status: string;

    @Column({
        type: 'varchar',
        length: '512'
    })
    domain: string;

    @Column({
        type: 'varchar',
        length: '256'
    })
    key: string;

    @Column({
        type: 'varchar',
        length: '256'
    })
    secret: string;

    @OneToMany(() => ApplicationSetting, setting => setting.application)
    settings: ApplicationSetting[]

    @OneToMany(() => Channel, channel => channel.application)
    channels: Channel[]

    @CreateDateColumn()
    createdAt: Date;

    @UpdateDateColumn()
    updatedAt: Date;

    @DeleteDateColumn()
    deletedAt: Date
}