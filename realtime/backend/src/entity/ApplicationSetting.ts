import {Column, CreateDateColumn, DeleteDateColumn, Entity, ManyToOne, PrimaryGeneratedColumn, UpdateDateColumn} from "typeorm";
import { Application } from "./Application";

@Entity(
    { name: 'app_setting' }
)
export class ApplicationSetting {


    @PrimaryGeneratedColumn('uuid')
    id: string;

    @ManyToOne(()=> Application, application => application.settings)
    application: Application

    @Column({
        type: 'varchar',
        length: '255'
    })
    name: string

    @Column({
        type: 'text'
    })
    value: string

    @CreateDateColumn()
    createdAt: Date;

    @UpdateDateColumn()
    updatedAt: Date;

    @DeleteDateColumn()
    deletedAt: Date
}
