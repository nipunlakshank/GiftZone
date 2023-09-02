<?php

class Login extends Controller
{
    private array $data = [];

    public function index()
    {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_POST['form'] === "login") {
                $this->login();
                return;
            } else if ($_POST['form'] === 'register') {
                $this->register();
                return;
            }
        }
        $this->view('login', $this->data);
    }

    private function login()
    {
        $data = [];
        $user = new User();
        if($user->validate($_POST)){
        //     $user->insert($_POST);
        }

        $data['errors'] = $user->get_errors();
        $data['form'] = $_POST['form'];
        $this->view('login', $data);
    }

    private function register()
    {
        $data = [];
        $user = new User();
        if ($user->validate($_POST)) {
            $id = $user->insert($_POST);
            if($id){
                message("You have successfully registered.\nPlease login with your credentials.");
                redirect('login');
            }
            message("Something went wrong");
        }
        $data['errors'] = $user->get_errors();
        $data['form'] = $_POST['form'];
        $this->view('login', $data);
    }
}
