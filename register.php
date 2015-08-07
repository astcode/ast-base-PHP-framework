<?php
require 'core/init.php';

if(Input::exists()) {

	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users',
				'numeric_user'	=>	true,
				'forbiden_username'	=> true

				),
			'password' => array(
				'required' => true,
				'min' => 6//,
				// 'strong_pass'	=>	true,
				// 'forbiden_pass'	=>	true
				),
			'password_again' => array(
				'required' => true,
				'matches' => 'password'),
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50)
		));

		if($validation->passed()) {
			$user = new User();

			$salt = Hash::salt(32);

			try {
				$user->create(array(
					'username' 	=> Input::get('username'),
					'password' 	=> Hash::make(Input::get('password'), $salt),
					'salt'		=> $salt,
					'name' 		=> Input::get('name'),
					'joined'	=> date('Y-m-d H:i:s'),
					'group'		=> 1
				));

				Session::flash('home', 'You have been registered and can now log in!');
				Redirect::to('index.php');

			} catch(Exception $e) {
				die($e->getMessage());
			}

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


	<?php require_once 'template/body/user_pages/register.php'; ?>



<?php require_once 'template/constants/footer.php'; ?>