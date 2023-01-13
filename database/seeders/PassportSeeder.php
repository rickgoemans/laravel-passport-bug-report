<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Passport\Database\Factories\ClientFactory;

class PassportSeeder extends Seeder
{
    public function run(): void
    {
        if (!app()->isLocal()) {
            return;
        }

        (new ClientFactory())
            ->create([
                'name'                   => 'test-client',
                'secret'                 => null,
                'provider'               => null,
                'redirect'               => config('app.frontend_url') . '/auth/callback',
                'personal_access_client' => false,
                'password_client'        => false,
                'revoked'                => false,
            ]);
    }
}
