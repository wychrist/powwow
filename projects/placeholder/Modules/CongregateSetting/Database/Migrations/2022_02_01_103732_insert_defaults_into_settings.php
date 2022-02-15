<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use function Modules\CongregateSetting\set_settings;

class InsertDefaultsIntoSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $app_ignore = [
            'key',
            'cipher',
            'providers',
            'aliases'
        ];

        if(Schema::hasTable('settings')) {

            foreach (config('app') as $name  => $value) {
                if (!in_array($name, $app_ignore)) {
                    $fullName = "app.{$name}";
                    set_settings([$fullName => $value]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
