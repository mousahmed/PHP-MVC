<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if (!isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];
                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter email';
                } else {
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter name';
                }

                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter password';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must be at least 6 characters';
                }

                if (empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Please confirm password';
                } else {
                    if ($data['password'] != $data['confirm_password']) {
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                }

                if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    if ($this->userModel->register($data)) {
                        flash('success', 'You are registered and can sign in');
                        redirect('/users/login');
                    }
                } else {
                    $this->view('users/register', $data);
                }

            } else {
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];
                $this->view('users/register', $data);
            }
        }
    }

    public function login()
    {
        if (!isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'password_err' => '',
                    'email_err' => '',
                ];
                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter email';
                }
                if ($this->userModel->findUserByEmail($data['email'])) {

                } else {
                    $data['email_err'] = 'No user found';
                }

                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter password';
                }

                if (empty($data['email_err']) && empty($data['password_err'])) {

                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    if ($loggedInUser) {
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['password_err'] = 'Password Incorrect';
                        $this->view('users/login', $data);
                    }
                } else {

                    $this->view('users/login', $data);
                }

            } else {
                $data = [
                    'email' => '',
                    'password' => '',
                    'password_err' => '',
                    'email_err' => '',
                ];
                $this->view('users/login', $data);
            }

        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_admin'] = $user->is_admin;

        redirect('/home');

    }

    public function logout()
    {
        session_destroy();
        redirect('/home');
    }


}