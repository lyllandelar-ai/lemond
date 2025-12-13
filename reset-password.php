<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('email', 'reyesjo@my.cspc.edu.ph')->first();
if ($user) {
    $user->password = Hash::make('password123');
    $user->save();
    echo "Password updated successfully for: " . $user->email . "\n";
    echo "New password is: password123\n";
} else {
    echo "User not found!\n";
}
