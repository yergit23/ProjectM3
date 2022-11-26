<?php
require_once 'init.php';

$user = new User();

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
	$validate = new Validate();

	$validation = $validate->check($_POST, [
		'username' => [
			'required' => true,
			'min' => 2,
			'max' => 15
		]
	]);

	if ($validation->passed()) {
		//echo 'passed';

		//Database
		$user->update(['username' => Input::get('username')]);
		//Session::flash('success', 'update success');
		//header('Location: /project3/test.php');
		Redirect::to('update.php');
		//Redirect::to(404);
	} else {
		foreach($validation->errors() as $error) {
			echo $error . "<br>";
		}
	}
}
}



if(!$user->isLoggedIn()):
echo "<a href='login.php'>Login</a> or <a href='register.php'>Register</a>";
else:
?>

<form action="" method="post">
	<?php echo Session::flash('success');?>
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" value="<?php echo $user->data()->username;?>">
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	<div class="field">
		<button type="submit">Отправить</button>
	</div>
</form>
<?php endif;?>