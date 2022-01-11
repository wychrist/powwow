import { env } from "process";
import { MigrationInterface, QueryRunner, Table } from "typeorm";

const tableName = `${env.DB_TABLE_PREFIX}application`;

export class Application1616158722399 implements MigrationInterface {

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
                    name: 'name',
                    type: 'varchar',
                    length: '255'
                },
                {
                    name: 'status',
                    type: 'varchar',
                    length: '255'
                },
                {
                    name: "domain",
                    type: "varchar",
                    length: "512"
                },
                {
                    name: "webhook",
                    type: "varchar",
                    length: "512",
                    isNullable: true
                },
                {
                    name: "key",
                    type: "varchar",
                    length: "256"
                },
                {
                    name: "secret",
                    type: "varchar",
                    length: "256"
                }
            ]
        }), true)
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        queryRunner.dropTable(tableName, true);
    }

}
