import { env } from "process";
import {MigrationInterface, QueryRunner, Table } from "typeorm";
import { Status } from "../type/status";

const tableName = `${env.DB_TABLE_PREFIX}app_channel`;

export class Channel1617445182370 implements MigrationInterface {

    public async up(queryRunner: QueryRunner): Promise<void> {
        queryRunner.createTable(new Table({
            name: tableName,
            columns: [
                 {
                    name: 'id',
                    type: 'varchar',
                    isPrimary: true,
                    generationStrategy: 'uuid'
                },
                {
                    name: 'applicationId',
                    type: 'varchar'
                },
                {
                    name: 'name',
                    type: 'varchar',
                    length: '255'
                },
                {
                    name: 'limit',
                    type: 'int',
                    default:'500'
                },
                {
                    name: 'status',
                    type: 'varchar',
                    length: '255'
                }
            ]
        }));
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        queryRunner.dropTable(tableName, true);
    }

}
