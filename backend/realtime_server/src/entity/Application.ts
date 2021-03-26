import { Entity, PrimaryGeneratedColumn, Column } from "typeorm";

@Entity()
export class Application {

    @PrimaryGeneratedColumn('uuid')
    id: string

    @Column({
        type: 'varchar',
        length: '255'
    })
    name: string

    @Column({
        type: 'varchar',
        length: '255'
    })
    status: string 

    @Column({
        type: 'varchar',
        length: '512'
    })
    domain: string

    @Column({
        type: 'varchar',
        length: '256'
    })
    key: string

    @Column({
        type: 'varchar',
        length: '256'
    })
    secret: string
}