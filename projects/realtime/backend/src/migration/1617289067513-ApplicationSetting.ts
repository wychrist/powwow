import { env } from "process";
import {MigrationInterface, QueryRunner, Table} from "typeorm";

const tableName = `${env.DB_TABLE_PREFIX}app_setting`;

export class ApplicationSetting1617289067513 implements MigrationInterface {

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
