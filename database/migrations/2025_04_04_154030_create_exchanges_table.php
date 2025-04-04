<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->string('currency_code', 3)->comment('通貨コード（例：IDR, USD）');
            $table->decimal('rate_to_jpy', 15, 6)->comment('日本円に対するレート（例：1IDR = 0.0089JPY）');
            $table->date('updated_date')->comment('レート更新日');
            $table->timestamps();
            // 通貨コードは一意
            $table->unique('currency_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchanges');
    }
};
