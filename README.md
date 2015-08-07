# ast_base_framework

This PHP framework is a simple NON-MVC framework that makes your coding life better.

The many features are:
        Many classes to help you code:
                Config class: loads your configuration variables
                Cookie class: Cookie handler
                DB class: an abstract database class
                Form class: extends Input class: make working with forms and inputs easier
                Hash class: create and work with hashing
                IncludeFiles Class: Easy way to include css, js files
                Pagination Class: Makes pagination records easy
                Redirect Class:
                Search Class:
                Session Class: Session Handling
                Strongpass Class: Strong password checker
                Token Class: CSRF protection
                User Class: CRUD of user with other options -- This file can also be duplicated to create other classes that work with the DB
                Validate Class: Form validation

        Helper functions;
                Array, email, form, inflector, string and URL helpers

        Comes preloaded with many css, and js libraries:
                ie...  JQuery, Bootstrap, font-awesome, JQueryValidation, and more (Just make sure on ocation to keep them uptodate)

        It is a smart framework because it can tell if you are working on a live server or localhost server or both.

--------------------------------------------------------------------------------------------------------------------
To use it.

        First: must make the necessary changes to: core/global_config_variables.php
        set the $file_root_document_folder to your base file name, it is it in the root directory then do not change it.
        
        Second: Change the GLOBALS to fit your configuration:
        ie…
                $GLOBALS['config'] = array(
                    'mysql_local' => array(
                        'host'      => 'localhost',
                        'username'  => 'root',
                        'password'  => '',
                        'db'        => 'ast_base_framework'
                    ),
                    'mysql_live' => array(
                        'host'      => 'localhost',
                        'username'  => 'mysql_username',
                        'password'  => 'mysql_password',
                        'db'        => 'mysql_database_name'
                    ),

        Two more things in the GLOBALS can be changed.
            1. cookie_expiry
            2. csrf_protection to true or false.

        be careful changing anything else as I do not recommend changing anymore GLOBALS unless you know what you are doing.

        THIRD: create the database.  
                then upload the ast_base_framework.sql to your mysql database
                
        Then you should be good to go...

To add more functionality and or to lessen the footprint of the code open the  core/init.php
    There you can uncomment or comment out some functionality.  Only change the following.
        date_time.php, array_helper.php, email_helper.php, form_helper.php, inflector_helper.php.

__________________________________________________________________________
To use:

Get DB information

```
// EXAMPLE 1
$user = new User();

// returns true false
$user->isLoggedIn()
if($user->isLoggedIn()){do this} else {do this}

// pulls the row from the database for a single user
// uses the escape function
echo escape($user->data()->username);




// EXAMPLE 2

// Gets all user information
$users = DB::getInstance()->query('SELECT * FROM users');
foreach ($users->results() as $user){ ?>
        <!-- echo $user->username."<br />"; -->
        <p>
            ID: <?php echo escape($user->id); ?> |
            Username:  <a href="profile.php?user=<?php echo escape($user->username); ?>"><?php echo escape($user->username); ?></a> |
            Name: <?php echo escape($user->name); ?> |
            Joined: <?php echo escape($user->joined); ?> |
            Group: <?php echo escape($user->group); ?> |
        </p>
    <?php }



// EXAMPLE 3

$username = Input::get('user');
$user = new User($username);

// checks if the user exists
$user->exists()

// Stores user informatin ins the variable
$data = $user->data();

// echos the data
echo escape($data->username);



// EXAMPLE 4

$users = DB::getInstance()->get('users', array('group', '=', '1'));

$users = DB::getInstance()->get('users', array('id', '=', '1'));

$users = DB::getInstance()->get('users', array('username', '=', 'admin'));

$users = DB::getInstance()->get('users', array('joined', '>', '2012'));
```
