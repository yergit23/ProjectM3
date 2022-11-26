<?php
session_start();

require_once 'init.php';

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
	$validate = new Validate();

	$validation = $validate->check($_POST, [
		'username' => [
			'required' => true,
			'min' => 2,
			'max' => 15,
			'unique' => 'users'
		],
		'email' => [
			'required' => true,
			'email' => true,
			'unique' => 'users'
		],
		'password' => [
			'required' => true,
			'min' => 3
		],
		'password_again' => [
			'required' => true,
			'matches' => 'password'
		]
		/*
		'my_file' => [
			'file' => true
		]
		*/
	]);

	if ($validation->passed()) {
		//echo 'passed';

		//Database
		$user = new User();
		$user->create([
			'username' => Input::get('username'),
			'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
			'email' => Input::get('email')
		]);

		Session::flash('success', 'register success');
		//header('Location: /project3/test.php');
		//Redirect::to('test.php');
		//Redirect::to(404);
	} else {
		foreach($validation->errors() as $error) {
			echo $error . "<br>";
		}
	}
}
}



?>

<form action="" method="post">
	<?php echo Session::flash('success');?>
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" value="<?php echo Input::get('username');?>">
	</div>
	<div class="field">
		<label for="email">Email</label>
		<input type="text" name="email" value="<?php echo Input::get('email');?>">
	</div>
	<div class="field">
		<label for="">Password</label>
		<input type="text" name="password">
	</div>
	<div class="field">
		<label for="">Password Again</label>
		<input type="text" name="password_again">
	</div>
	<!-- <input type="file" name="my_file"> -->
	<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	<div class="field">
		<button type="submit">Отправить</button>
	</div>
</form>