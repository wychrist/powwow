import { Entity, PrimaryGeneratedColumn, Column } from "typeorm";

@Entity()
export class Application {

    @PrimaryGeneratedColumn()
    id: number

    @Column({
        type: 'varchar',
        length: '255'
    })
    name: string

    @Column({
        type: 'varchar',
        length: '255'
    })
    server: string

    @Column({
        type: 'varchar',
        length: '120'
    })
    status: string

}