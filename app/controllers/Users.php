<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        
    }

    public function signup()
    {
        //First check for post
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Then run the form
            define('FILTER_SANITIZE_STRING', 513);

// Now, instead of using the constant, you can use the integer value directly
           $_POST = filter_input_array(INPUT_POST, 513);

            $data = [
               'firstname'=> trim($_POST['first-name']),
               'lastname' => trim($_POST['last-name']),
               'email'=> trim($_POST['email-address']),
               'password'=> trim($_POST['password']),
               'firstname_err' =>'',
               'lastname_err' => '',
               'email_err' =>'',
               'password_err' => ''            
            ];

            //validating the first name 
            if(empty($data['firstname']))
            {
                $data['firstname_err'] = 'Please enter your first name';
            }
            //validating the last name
            if(empty($data['lastname']))
            {
                $data['lastname_err'] = 'Please enter your last name';
            }
            //validating the email address
            if(empty($data['email']))
            {
                $data['email_err'] = 'Please enter your email address';
            }else{
                if($this->userModel->finduserbyEmail($data['email']))
                {
                    $data['email_err'] = 'Email is already taken';
                }
            }
            //validating the first name
            if(empty($data['password']))
            {
                $data['password_err'] = 'Please enter passoword';
            }
            elseif(strlen($data['password']) < 8 )
            {
                $data['password_err'] = 'Password must be atleast 8 characters';
            }

            if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['email_err']) && empty($data['password_err']))
            {
                //Hashing the password
                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                //Register user
                if($this->userModel->signup($data))
                {
                  flash('register_success', 'You are registered and can now login');
                  redirect('users/login');
                }
                else
                {
                    die('Something went wrong');
                }




            }
            else
            {
                //Load view with errors
                $this->view('users/signup',$data);
            }



        }
        else
        {
            //Init data
            $data = [
               'firstname'=> '',
               'lastname' =>'',
               'email'=>'',
               'password'=> '',
               'firstname_err' =>'',
               'lastname_err' => '',
               'email_err' =>'',
               'password_err' => ''
              ];
        }
    }

    public function login()
    {
        //First check for post
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Then run the form
            define('FILTER_SANITIZE_STRING', 513);

// Now, instead of using the constant, you can use the integer value directly
           $_POST = filter_input_array(INPUT_POST, 513);

            $data = [

               'email'=> trim($_POST['email-address']),
               'password'=> trim($_POST['password']),
               'email_err' =>'',
               'password_err' => ''            
            ];

            if(empty($data['email']))
            {
                $data['email_err'] = 'Please enter your email address';
            }
            if(empty($data['password']))
            {
                $data['password_err'] = 'Please enter password';
            }

            //checking for users' email
            if($this->userModel->finduserbyEmail($data['password_err']))
            {
                //validated the user and setting the logged in user
                $loggedInUser = $this->userModel->login($data['email']. $data['password']);

                if($loggedInUser)//if there is a logged in user
                {
                    //Create a session
                    $this->createUserSession($loggedInUser);//Check the argument

                }
                else{
                    $data['passsword_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            }

            //Make sure the errors are empty
            if(empty($data['email_err']) && empty($data['password_err']))
            {
                die('Successful login');
            }
            else{
                $this->view('users/login', $data);
            }

            

        }
        else{
               $data = [
               'email'=>'',
               'password'=> '',
               'email_err' =>'',
               'password_err' => ''
               ];

               //load the view
               $this->view('users/login' ,$data);

        }
    }
    public function createUserSession($user)
    {
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        redirect('posts');

    }

    public function logout()
    {
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }

    public function isLoggedIn()
    {
        if(isset($_SESSION['user_email']))
        {
            return true;
        }else{
            return false;
        }
    }



}