<?php
require_once 'core/init.php';

// $user = DB::getInstance()->get('users', array('username', '=', 'alex'));
// $userInsert = DB::getInstance()->update('users', 3, array(
// 	'password' => 'newpassword',
// 	'name' => 'Dale Garrett'
// 	));

// if(!$user->count()){
// 	echo 'No user';
// }else{
// 	// foreach($user->results() as $user){
// 	// 	echo $user->username, '<br/>';
// 	// }
// 	echo $user->first()->username;
// }

if(Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
//echo $user->data()->username;
// echo Session::get(Config::get('session/session_name'));
if($user->isLoggedIn()){
?>
	<p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</p>
	<ul>
		<li><a href="logout.php">Log out</a></li>
		<li><a href="update.php">Update details</a></li>
		<li><a href="changepassword.php">Change password</a></li>
	</ul>
<?php
	if($user->hasPermission('admin')){
		echo '<p> You are an admin! </p>';
	}

	if($user->hasPermission('moderator')){
		echo '<p> You are a moderator! </p>';
	}

	//alternate use
	//on top of every page
	// if(!$user->hasPermission('admin')){
	// 	Redirect::to(404);
	// }

}else{
	echo '<p>You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
}
?>