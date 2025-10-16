<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->createRoles();
        $this->createManager();
    }

    private function createRoles(): void
    {
        foreach (RoleEnum::cases() as $case) {
            Role::create(['name' => $case->value]);
        }
    }

    private function createManager(): void
    {
        $manager = \App\Models\User::factory()->create([
            'email'             => 'manager@gmail.com',
            'password'          => '12345678',
            'email_verified_at' => now(),
        ]);

        $manager->assignRole(RoleEnum::MANAGER);
    }
}
