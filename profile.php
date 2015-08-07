<?php
require 'core/init.php';

if (!$user->isLoggedIn()) {
	Session::flash('danger', 'You must be logged or have a user account in to view this file!');
	Redirect::to('index.php');
}

if(!$username = Input::get('user')) {
	Redirect::to('index.php');
} else {
	// $user = new User($username);

	if(!$user->exists()) {
		Redirect::to(404);
	} else {
		$data = $user->data();
	}
	?>

	<?php require_once 'template/constants/header.php'; ?>


	<?php require_once 'template/constants/navigation.php'; ?>


		<?php require_once 'template/body/user_pages/profile.php'; ?>

<?php }  ?>

<?php require_once 'template/constants/footer.php'; ?>