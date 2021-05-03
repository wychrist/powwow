<?php

use App\Models\Metadata;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metadata', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuidMorphs('metadata');

            $table->string('value_type', '10')->default(Metadata::TYPE_TEXT);
            $table->bigInteger('int_value')->nullable();
            $table->float('float_value')->nullable();
            $table->text('text_value')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metadata');
    }
}
