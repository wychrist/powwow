import { Entity, PrimaryGeneratedColumn, Column } from "typeorm";

@Entity()
export class Setting {

    @PrimaryGeneratedColumn('increment')
    id: number

    @Column({
        type: 'varchar',
        length: '255'
    })
    name: string

    @Column({
        type: 'text'
    })
    value: string
}
