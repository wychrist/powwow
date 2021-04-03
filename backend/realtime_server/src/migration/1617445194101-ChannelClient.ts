import { env } from "process";
import { MigrationInterface, QueryRunner, Table } from "typeorm";

const tableName = `${env.DB_TABLE_PREFIX}app_channel_client`;

export class ChannelClient1617445194101 implements MigrationInterface {

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
                    name: 'channelId',
                    type: 'varchar'
                },
                {
                    name: 'client_id',
                    type: 'varchar',
                    length: '255'
                },
                {
                    name: 'user_id',
                    type: 'varchar',
                    length: '255'
                },
                {
                    name: 'info',
                    type: 'text'
                }
            ]
        }));
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        queryRunner.dropTable(tableName, true);
    }

}
