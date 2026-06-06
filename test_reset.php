$user = App\User::first();
echo "Email: " . $user->email . "\n";
$user->password = bcrypt("password");
$user->save();
echo "Password reset OK\n";
