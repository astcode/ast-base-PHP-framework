<?php
class Validate {
	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function check($source, $items = array()) {
  //       echo "string";
		// var_dump($source);
  //       die();

        if (isset($source['username'])) {
            $username = $source['username'];
        }
        if (isset($source['password'])) {
            $password = $source['password'];
        }
        if (isset($source['password_again'])) {
            $password_again = $source['password_again'];
        }
        if (isset($source['first_name'])) {
            $firstname = $source['first_name'];
        }
        if (isset($source['last_name'])) {
            $lastname = $source['last_name'];
        }
        if (isset($source['name'])) {
            $name = $source['name'];
        }
        if (isset($source['email'])) {
            $email = $source['email'];
        }
        if (isset($source['password_current'])) {
            $password_current = $source['password_current'];
        }
        if (isset($source['password_new'])) {
            $password_new = $source['password_new'];
        }
        if (isset($source['password_new_again'])) {
            $password_new_again = $source['password_new_again'];
        }
        if (isset($source['register'])) {
            $register = $source['register'];
            if (empty($source['username']) || empty($source['password']) || empty($source['password_again']) || empty($source['name'])) {
                if (empty($source['username'])) {
                    $this->addError("Username field must have a value");
                }
                if (empty($source['password'])) {
                    $this->addError("Password field must have a value");
                }
                if (empty($source['password_again'])) {
                    $this->addError("Password Again field must have a value");
                }
                if (empty($source['first_name'])) {
                    $this->addError("First Name field must have a value");
                }
                if (empty($source['last_name'])) {
                    $this->addError("Last Name field must have a value");
                }
                if (empty($source['name'])) {
                    $this->addError("Name field must have a value");
                }
                if (empty($source['email'])) {
                    $this->addError("Email field must have a value");
                }
            }
        }
        if (isset($source['sign_up'])) {
            $sign_up = $source['sign_up'];
            if (empty($source['first_name']) || empty($source['last_name']) || empty($source['email'])) {
                if (empty($source['first_name'])) {
                    $this->addError("First Name field must have a value");
                }
                if (empty($source['last_name'])) {
                    $this->addError("Last Name field must have a value");
                }
                if (empty($source['email'])) {
                    $this->addError("Email field must have a value");
                }
            }
        }
        if (isset($source['update_user'])) {
            $update_user = $source['update_user'];

            if (empty($source['username'])) {
                $this->addError("Username field must have a value");
            }
            if (empty($source['email'])) {
                $this->addError("Email field must have a value");
            }
        }
        if (isset($source['update_password'])) {
            $update_password = $source['update_password'];
            if (empty($source['password_current']) || empty($source['password_new']) || empty($source['password_new_again'])) {
                if (empty($source['password_current'])) {
                    $this->addError("Current Password field must have a value");
                }
                if (empty($source['password_new'])) {
                    $this->addError("New Password field must have a value");
                }
                if (empty($source['password_new_again'])) {
                    $this->addError("New Password Again field must have a value");
                }
            }
        }
        if (isset($source['update_profile'])) {
            $update_profile = $source['update_profile'];
            if (empty($source['name'])) {
                $this->addError("Name field must have a value");
            }
        }
        /*
          ["nlTemp"]=>
          string(11) "BlockColumn" || "ComplexDesign" || "PlainNewsletter"
          ["subject"]
          ["semail"]
          ["sname"]
          ["content"]
          ["submit"]=> "Submit"
         */
        if (isset($source['newsletter'])) {
            $newsletter = $source['newsletter'];
            if (empty($source['nlTemp'])) {
                $this->addError("Please select a template");
            }
            if (empty($source['subject'])) {
                $this->addError("Please Add A Subject");
            }
            if (empty($source['semail'])) {
                $this->addError("Please Add The Senders Email Address");
            }
            if (empty($source['sname'])) {
                $this->addError("Please Add The Senders Name");
            }
            if (empty($source['content'])) {
                $this->addError("Please Add Content To Your Newsletter");
            }
        }

		foreach($items as $item => $rules) {
			foreach($rules as $rule => $rule_value) {
				$value = trim($source[$item]);

				if($rule === 'required' && $value === true && empty($value)) {
					$this->addError("{$item} is required.");
				} else if (!empty($value)) {

					switch($rule) {
                        case 'email':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addError("This email address: ({$value}) is NOT a valid email address.");
                            }
                        break;
                        case 'min':
                            if(strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                        break;
						case 'max':
							if(strlen($value) > $rule_value) {
								$this->addError("{$item} must be a maximum of {$rule_value} characters.");
							}
						break;
						case 'matches':
							if($value != $source[$rule_value]) {
								$this->addError("{$rule_value} must match {$item}.");
							}
						break;
						case 'unique':
							$check = $this->_db->get('users', array($item, '=', $value));
							if($check->count()) {
								$this->addError("{$item} is already taken.");
							}
						break;
                        case 'alpha':
                            if (ctype_alpha($value)) {
                                $this->addError("{$item} must contain only alphabetic characters.");

                            }
                        break;
                        case 'numeric':
                            if (ctype_digit($value)) {
                                $this->addError("{$item} must contain only numbers.");

                            }
                        case 'alnum':
                            if (ctype_digit($value)) {
                                $this->addError("{$item} must contain letters and numbers.");

                            }
                        case 'alnum_user':
                            if (ctype_alnum($username)) {
                                $this->addError("{$item} must contain letters and numbers.");

                            }
                        break;
                        case 'strong_pass':
                            if (strlen($password) < 6) {
                                $this->addError("Password must be at least 6 characters.");
                            } else if (is_numeric($password)) {
                                $this->addError("Password must contain atleast one letter.");
                            } else if (!preg_match('#[0-9]#', $password)) {
                                $this->addError("Password must contain atleast one number.");
                            } else if (!preg_match('#[A-Z]#', $password)) {
                                $this->addError("Password must contain atleast one UpperCase letter.");
                            } else if (!preg_match('#[a-z]#', $password)) {
                                $this->addError("Password must contain atleast one LowerCase letter.");
                            } else if (($password == "password") || ($password == "Password1")) {
                                $this->addError("Password must contain atleast one LowerCase letter.");
                            }
                        break;
                        case 'forbiden_username':
                            $stringtocheck = $username;
                            $forbiddenword = 'admin';
                            if (preg_match("/$forbiddenword/i", $username)) {
                                $this->addError("The {$item} canNOT contain the string {$forbiddenword}");
                            }
                        break;
                        case 'forbiden_pass':
                            $stringtocheck = $password;
                            $forbiddenword = 'password';
                            if (preg_match("/$forbiddenword/i", $password)) {
                                $this->addError("The {$item} canNOT contain the string {$forbiddenword}");
                            }
                        break;
					}

				}

			}
		}

		if(empty($this->_errors)) {
			$this->_passed = true;
		}

		return $this;
	}

	protected function addError($error) {
		$this->_errors[] = $error;
	}

	public function passed() {
		return $this->_passed;
	}

	public function errors() {
		return $this->_errors;
	}
}