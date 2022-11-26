<?php
require_once 'init.php';

$user = new User();

$validate = new Validate();
$validation = $validate->check($_POST, [
	'current_password' => ['required' => true, 'min' => 3],
	'new_password' => ['required' => true, 'min' => 3],
	'new_password_again' => ['required' => true, 'min' => 3, 'matches' => 'new_password']
]);

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		if ($validation->passed()) {
			if(password_verify(Input::get('current_password'), $user->data()->password)) {
				$user->update(['password' => password_hash(Input::get('new_password'), PASSWORD_DEFAULT)]);
				Session::flash('success', 'Password has been updated.');
				Redirect::to('index.php');
			} else {
				echo "Invalid current password"; exit;
			}
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
	<div class="field">
		<label for="current_password">Current password</label>
		<input type="text" name="current_password">
	</div>
		<div class="field">
		<label for="new_password">New password</label>
		<input type="text" name="new_password">
	</div>
	<div class="field">
		<label for="new_password_again">New password again</label>
		<input type="text" name="new_password_again">
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	<div class="field">
		<button type="submit">Отправить</button>
	</div>
</form>
<?php endif;?>