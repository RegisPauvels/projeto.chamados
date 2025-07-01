<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('status', [
                'open', 'assigned', 'in_progress', 
                'on_hold', 'resolved', 'closed', 'cancelled'
            ])->default('open');
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('analyst_id')->nullable()->constrained('users');
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('ticket_type_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('urgency_level_id')->constrained();
            $table->text('resolution')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
