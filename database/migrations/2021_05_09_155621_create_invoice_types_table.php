<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTypesTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->bigInteger('invoice_type_id')->nullable()->after('id');
            $table->bigInteger('invoice_number')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_types');
    }
}
