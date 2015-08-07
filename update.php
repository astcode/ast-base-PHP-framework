<?php
require 'core/init.php';

if (!$user->isLoggedIn()) {
	Session::flash('danger', 'You must be logged in to update your profile!');
	Redirect::to('index.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50,
				'numeric_user'	=>	true)
		));

		if($validation->passed()) {

			try {
				$user->update(array(
					'name' => Input::get('name')
				));
			} catch(Exception $e) {
				die($e->getMessage());
			}

			Session::flash('home', 'Your details have been updated.');
			Redirect::to('index.php');
		} else {
			foreach($validate->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}

?>

<?php require_once 'template/constants/header.php'; ?>


<?php require_once 'template/constants/navigation.php'; ?>


	<?php require_once 'template/body/user_pages/update.php'; ?>



<?php require_once 'template/constants/footer.php'; ?>