<?php
require 'core/init.php';

$user = new User();
$user->logout();

Session::flash('logged_out', 'You have loged out!');

Redirect::to('index.php');