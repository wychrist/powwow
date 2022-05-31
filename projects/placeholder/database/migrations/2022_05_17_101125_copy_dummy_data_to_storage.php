<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!file_exists(content_dir())) {
            File::copyDirectory(app_root_dir('dummy_content'), content_dir());
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (file_exists(content_dir())) {
            File::deleteDirectories(content_dir());
        }
    }
};
