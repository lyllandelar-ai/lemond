<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

$user = User::where('email', 'reyesjo@my.cspc.edu.ph')->first();

if ($user) {
    echo "User found: " . $user->email . "\n";
    echo "User ID: " . $user->id . "\n";
    echo "Password hash: " . substr($user->password, 0, 20) . "...\n\n";
    
    // Test password verification
    $testPassword = 'password123';
    $isValid = Hash::check($testPassword, $user->password);
    
    echo "Testing password '$testPassword': " . ($isValid ? 'CORRECT ✓' : 'INCORRECT ✗') . "\n\n";
    
    // Test Auth::attempt
    $credentials = [
        'email' => 'reyesjo@my.cspc.edu.ph',
        'password' => 'password123'
    ];
    
    if (Auth::attempt($credentials)) {
        echo "Auth::attempt() SUCCESS ✓\n";
        echo "Authenticated user: " . Auth::user()->email . "\n";
    } else {
        echo "Auth::attempt() FAILED ✗\n";
    }
    
} else {
    echo "User not found!\n";
}
