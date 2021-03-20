import { MigrationInterface, QueryRunner, Table } from "typeorm";

export class Application1616158722399 implements MigrationInterface {

    public async up(queryRunner: QueryRunner): Promise<void> {
        queryRunner.createTable(new Table({
            name: 'application',
            columns: [
                {
                    name: 'id',
                    type: 'int',
                    isPrimary: true
                },
                {
                    name: 'name',
                    type: 'string',
                    length: '255'
                },
                {
                    name: 'status',
                    type: 'string',
                    length: '255'
                }
            ]
        }), true)
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        queryRunner.dropTable('application', true);
    }

}
