<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTestUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a test user for login testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = 'revesjo@my.cspc.edu.ph';
        
        // Check if user already exists
        $existingUser = User::where('email', $email)->first();
        
        if ($existingUser) {
            $this->info('User already exists!');
            $this->info('Email: ' . $email);
            $this->info('You can update the password...');
            
            $existingUser->password = Hash::make('password123');
            $existingUser->save();
            
            $this->info('Password has been reset to: password123');
            return 0;
        }
        
        // Create new user
        $user = User::create([
            'name' => 'Test User',
            'email' => $email,
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);
        
        $this->info('Test user created successfully!');
        $this->info('Email: ' . $email);
        $this->info('Password: password123');
        $this->info('Admin: Yes');
        
        return 0;
    }
}
