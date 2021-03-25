import { env } from "process";
import {MigrationInterface, QueryRunner, Table} from "typeorm";

export class Client1616662735901 implements MigrationInterface {

    public async up(queryRunner: QueryRunner): Promise<void> {
        queryRunner.createTable(new Table({
            name: `${env.DB_TABLE_PREFIX}client`,
            columns: [
                {
                    name: 'id',
                    type: 'varchar',
                    isPrimary: true,
                    generationStrategy: 'uuid'
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
        queryRunner.dropTable('client', true);
    }

}
