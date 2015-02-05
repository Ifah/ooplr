<?php
require_once 'core/init.php';

if(Input::exists()){
	if(Token::check(Input::get('token'))){

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'disp_text' => 'Username',
				'required' => true
				),
			'password' => array(
				'disp_text' => 'Password',
				'required' => true
				)
			));

		if($validation->passed()){
			
			$user = new User();

			$remember = (Input::get('remember') === 'on') ? true : false;
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);

			if($login){
				Redirect::to('index.php');
			}else{
				echo '<p>Sorry, name or password is incorrect.</p>';
			}

		}else{

			foreach($validation->errors() as $error){
				echo $error, '<br/>';
			}

		}
	}
}
?>
<form action="" method="post">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
	</div>
	<div class="field">
		<label for="password">Password</label>
		<input type="password" name="password" id="password" autocomplete="off">
	</div>
	<div class="field">
		<label for="remember">
			<input type="checkbox" name="remember" id="remember"> Remember me
		</label>
	</div>
	<input type="hidden" name="token" id="token" value="<?php echo Token::generate(); ?>" />
	<input type="submit" value="Log In" />
</form>