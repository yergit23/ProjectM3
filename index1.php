<?php
require_once 'database.php';
require_once 'config.php';

$GLOBALS['config'] = [
	'mysql' => [
		'host' => 'localhost',
		'username' => 'root',
		'password' => 'root',
		'database' => 'project3',
		'something' => [
			'no' => [
				'foo' => [
					'bar' => 'baz'
				]
			]
		]
	]

	//'config_my' => []
];

echo Config::get('mysql.something.no.foo.bar');

//$users = Database::getInstance()->query("SELECT * FROM users WHERE username IN (?, ?)", ['john Doe', 'Bob Smith']);
//$users = Database::getInstance()->get('users', ['password', '=', 'password1']);
//$users = Database::getInstance()->delete('users', ['username', '=', 'Bob Smith']);
/*
$users = Database::getInstance()->get('users', ['username', '=', 'Master2']);
var_dump($users->results()[0]);

echo $users->first()->username;
*/

/*
Database::getInstance()->insert('users', [
	'username' => 'Master',
	'password' => 'password'
]);

$id = 3;
Database::getInstance()->update('users', $id, [
	'username' => 'Master2',
	'password' => 'password2'
]);
*/
/*
if($users->error()) {
	echo 'we have an error';
} else {
	foreach ($users->results() as $user) {
	echo $user->username . '<br>';
	}
}
*/






?>