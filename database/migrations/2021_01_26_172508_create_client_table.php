<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->unique();
            $table->string('financial_contact_name');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('billing_address');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('swif_code');
            $table->string('transit_number');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('is_deleted')->nullable();
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
        Schema::dropIfExists('client');
    }
}
