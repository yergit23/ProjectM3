<?php
require_once 'init.php';

//var_dump(Session::get(Config::get('session.user_session')));

echo Session::flash('success');
$user = new User;
//$anotherUser = new User(8);
//echo $user->data()->username; //user1
//echo $anotherUser->data()->username; //user1

if($user->isLoggedIn()) {
	echo "<br><br>";
	echo "Hi, {$user->data()->username}";
	echo "<p><a href='logout.php'>Logout</a></p>";
	echo "<p><a href='update.php'>Update profile</a></p>";
	echo "<p><a href='changepassword.php'>Update password</a></p>";

	if($user->hasPermissions('admin')) {
		echo 'You are admin!';
	}
	//var_dump($_COOKIE);
} else {
	echo "<a href='login.php'>Login</a> or <a href='register.php'>Register</a>";
	//var_dump($_COOKIE);
}


?>

