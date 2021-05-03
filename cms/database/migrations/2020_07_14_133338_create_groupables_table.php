<?php

use App\Models\Group;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('groupables', function (Blueprint $table) {
            $table->uuid('group_id')->index();
            $table->uuidMorphs('groupable');

            // new fields
            $table->date('start')->nullable()->index();
            $table->date('finish')->nullable()->index();
            $table->smallInteger('priority')->default(99)->index();
            $table->string('status')->default(Group::STATUS_ACTIVE);
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
        Schema::dropIfExists('groupables');
    }
}
