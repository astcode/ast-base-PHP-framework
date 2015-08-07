<?php
require 'core/init.php';

if ($user->isLoggedIn()) {
	Session::flash('warning', 'You are logged in already, you do not need to login again!');
	Redirect::to('index.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$user = new User();

		$remember = (Input::get('remember') === 'on') ? true : false;
		$login = $user->login(Input::get('username'), Input::get('password'), $remember);

		if($login) {
			Session::flash('home', 'Welcome, You are logged in '.escape($user->data()->username).'!');
			Redirect::to('index.php');
		} else {
			echo '<p>Sorry, that username and password wasn\'t recognised.</p>';
		}
	}
}

?>

<?php require_once 'template/constants/header.php'; ?>


<?php require_once 'template/constants/navigation.php'; ?>


	<?php require_once 'template/body/user_pages/login.php'; ?>



<?php require_once 'template/constants/footer.php'; ?>