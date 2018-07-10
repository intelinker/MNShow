<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('store_count');
            $table->integer('channel_category1')->default(1);
            $table->integer('channel_category2')->default(1);
            $table->integer('channel_category3')->default(1);
            $table->string('visit_time')->nullable();
            $table->string('contract_time')->nullable();
            $table->string('contract_duration')->nullable();
            $table->string('progress')->nullable();
            $table->integer('created_by')->references('id')->on('users')->onDelete('cascade');
//            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('customers');
    }
}
