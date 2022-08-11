<?php

declare(strict_types=1);

use Database\Seeders\CreateFirstUser;
use Illuminate\Database\Migrations\Migration;

class AddResetPasswordColumnsUsersTable extends Migration
{
    public function up(): void
    {
        $seeder = new CreateFirstUser();
        $seeder->run();
    }

    public function down(): void
    {
        $seeder = new CreateFirstUser();
        $seeder->rollback();
    }
}
