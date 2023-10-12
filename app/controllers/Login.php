<?php

class Login extends Controller
{

    public function index()
    {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_POST['form'] === "login") {
                $this->login();
                return;
            }
            if ($_POST['form'] === 'register') {
                $this->register();
                return;
            }
        }
        $this->view('login');
    }

    private function login()
    {
        $data = [];
        $user = new User();
        if ($user->validate($_POST)) {
            $row = $user->selectOne(['email' => $_POST['email']]);

            if ($row) {
                $matched = password_verify($_POST['password'], $row->password);
                if ($matched) {
                    // authenticate
                    AUTH::authenticate($row);
                    redirect('home');
                }
                $data['errors'] = ['email' => 'Wrong email or password', 'password' => ' '];
            }
        } else {
            $data['errors'] = $user->get_errors();
        }

        $data['form'] = $_POST['form'];
        $this->view('login', $data);
    }

    private function register()
    {
        $data = [];
        $user = new User();
        if ($user->validate($_POST)) {
            $id = $user->insert($_POST);
            if ($id) {
                message("You have successfully registered. Please login.");
                redirect('login');
            }
            message("Something went wrong");
        }
        $data['errors'] = $user->get_errors();
        $data['form'] = $_POST['form'];
        $this->view('login', $data);
    }
}
