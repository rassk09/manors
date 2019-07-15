<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /****************************
         * Users
         ****************************/

        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable()->after('name');
            $table->string('role')->nullable()->after('email');
        });

        /****************************
         * Manors
         ****************************/

        Schema::create('manors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->nullable();
            $table->integer('privacy_type_id')->nullable();
            $table->integer('state_type_id')->nullable();
            $table->integer('owner_id')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->string('address')->nullable();
            $table->float('geo_lat', 9, 3)->nullable();
            $table->float('geo_lng', 9, 3)->nullable();
            $table->integer('is_active')->default(1)->nullable();
            $table->timestamps();
        });

        Schema::create('manors_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manor_id')->nullable();
            $table->string('image')->nullable();
            $table->integer('position')->nullable();
            $table->timestamps();
        });

        Schema::create('manors_text', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manor_id')->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->integer('position')->nullable();
            $table->timestamps();
        });

        Schema::create('privacy_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('is_active')->default(1)->nullable();
            $table->timestamps();
        });

        Schema::create('state_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('is_active')->default(1)->nullable();
            $table->timestamps();
        });

        Schema::create('owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('is_active')->default(1)->nullable();
            $table->timestamps();
        });

        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('position')->nullable();
            $table->float('geo_lat', 9, 3)->nullable();
            $table->float('geo_lng', 9, 3)->nullable();
            $table->timestamps();
        });

        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('region_id')->nullable();
            $table->string('name')->nullable();
            $table->float('geo_lat', 9, 3)->nullable();
            $table->float('geo_lng', 9, 3)->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('role');
        });

        Schema::dropIfExists('manors');
        Schema::dropIfExists('manors_photos');
        Schema::dropIfExists('manors_text');
        Schema::dropIfExists('privacy_types');
        Schema::dropIfExists('state_types');
        Schema::dropIfExists('owners');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('areas');
    }
}
