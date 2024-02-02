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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('task_id');
            $table->string('name');

            $table->unsignedBigInteger('giver_id');
            $table->foreign('giver_id')->references('giver_id')->on('givers')->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->foreign('receiver_id')->references('receiver_id')->on('receivers')->onUpdate('cascade')->onDelete('cascade');

            $table->json('appliers')->default(json_encode([]));
            
            $table->string('urgency')->default('0')->comment('0=Not urgent, 1=Urgent');
            $table->text('description')->nullable();
            $table->timestamp('deadline');
            $table->string('pod')->comment('price of development');
            $table->string('state')->default('0')->comment('0=Unaccepted, 1=In Progress, 2=Completed');
            $table->string('pidx')->nullable();
            $table->string('paid')->default('0')->comment('0=Unpaid, 1=Paid');
            $table->timestamp('completed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
