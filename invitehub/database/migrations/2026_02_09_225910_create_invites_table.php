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
    Schema::create('invites', function (Blueprint $table) {
        $table->id();
        $table->string('email')
            ->comment('E-mail do usuário convidado')
            ->index();
        $table->string('token', 64)
            ->comment('Token único utilizado na URL de aceite do convite')
            ->unique();
        $table->string('status')
            ->comment('Status do convite: pendente, aceito, recusado, expirado,cancelado')
            ->index();
        $table->string('role_name')
            ->comment('Papel que será atribuído ao usuário após aceitar o convite');
        $table->timestamp('expires_at')
            ->nullable()
            ->comment('Data e hora de expiração do convite')
            ->index();
        $table->timestamp('accepted_at')
            ->nullable()
            ->comment('Data e hora em que o convite foi aceito')
            ->index();
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invites');
    }
};
