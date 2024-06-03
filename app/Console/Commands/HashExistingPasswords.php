<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdateAdminPassword extends Command
{
    protected $signature = 'update:admin-password';
    protected $description = 'Update the admin password to a hashed version';

    public function handle()
    {
        $email = $this->ask('Enter the admin email');
        $plainPassword = $this->secret('Enter the new password');

        $hashedPassword = Hash::make($plainPassword);

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->password = $hashedPassword;
            $user->save();

            $this->info("Password updated for user: {$user->email}");
        } else {
            $this->error('User not found');
        }
    }
}
