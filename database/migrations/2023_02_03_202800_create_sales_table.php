<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("servant_id");
            $table->integer ("quantity");
            $table->decimal("price" , 8, 2);
            $table->decimal("total", 8, 2);
            $table->decimal ("change", 8, 2)->default (0);
            $table->bigInteger("user_id")->unsigned();
            $table->foreign('user_id')
                ->references("id")
                ->on("users")->onDelete("cascade");
            $table->string("payment_type")->default("cash");
            $table->string ("payment_status")->default("paid");
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
        Schema::dropIfExists('sales');
    }
};
