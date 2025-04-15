<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckAdminUser extends Command
{
    protected $signature = 'user:check-admin {email?}';
    protected $description = 'Check if a user is admin and update if needed';

    public function handle()
    {
        $email = $this->argument('email');
        
        if ($email) {
            $user = User::where('email', $email)->first();
            
            if (!$user) {
                $this->error("User with email {$email} not found!");
                return 1;
            }
            
            $this->info("User: {$user->firstname} {$user->lastname} ({$user->email})");
            $this->info("Current role: {$user->role}");
            
            if ($user->role !== 'admin') {
                if ($this->confirm('Do you want to set this user as admin?')) {
                    $user->role = 'admin';
                    $user->save();
                    $this->info("User role updated to admin!");
                }
            } else {
                $this->info("User is already an admin.");
            }
        } else {
            // List all users
            $users = User::all();
            $headers = ['ID', 'Name', 'Email', 'Role'];
            $rows = [];
            
            foreach ($users as $user) {
                $rows[] = [
                    $user->id,
                    $user->firstname.' '.$user->lastname,
                    $user->email,
                    $user->role
                ];
            }
            
            $this->table($headers, $rows);
        }
        
        return 0;
    }
} 