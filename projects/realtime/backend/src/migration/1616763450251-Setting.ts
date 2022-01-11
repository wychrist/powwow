import { MigrationInterface, QueryRunner, Table } from "typeorm";
import { env } from "process";
import { getSettingRepo } from "../settings";
import { Setting } from "../entity/Setting";
import { generateRadom } from "../type/api";

const tableName = `${env.DB_TABLE_PREFIX}setting`;

export class Setting1616763450251 implements MigrationInterface {

    public async up(queryRunner: QueryRunner): Promise<void> {
        queryRunner.createTable(new Table({
            name: tableName,
            columns: [
                {
                    name: 'id',
                    type: 'int',
                    isPrimary: true
                },
                {
                    name: 'name',
                    type: 'varchar',
                    length: '255'
                },
                {
                    name: 'value',
                    type: 'text'
                }
            ]
        }))

    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        queryRunner.dropTable(tableName, true)
    }

}
