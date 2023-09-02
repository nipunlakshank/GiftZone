<?php

/**
 * User model
 */

class User extends Model
{
    protected array $errors;
    protected string $table = "users";
    protected array $allowed_columns = [
        'fname',
        'lname',
        'email',
        'password',
    ];

    public function validate($data): bool
    {

        if (empty($data) || empty($data['form'])) {
            return false;
        }

        switch ($data['form']) {
            case "login":
                $this->validateLogin($data);
                break;
            case "register":
                $this->validateRegister($data);
                break;
            default:
                return false;
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;
    }


    private function validateRegister(array $data): void
    {
        $this->errors = [];

        if (empty($data['fname'])) {
            $this->errors['fname'] = "First Name is required";
        } else if (!preg_match("/^[a-zA-Z]+$/", $data['fname'])) {
            $this->errors['fname'] = "Invalid name";
        }

        if (empty($data['lname'])) {
            $this->errors['lname'] = "Last Name is required";
        } else if (!preg_match("/^[a-zA-Z]+$/", $data['lname'])) {
            $this->errors['lname'] = "Invalid name";
        }

        // Validate email
        if (empty($data['reg_email'])) {
            $this->errors['reg_email'] = "Email is required";
        } else if (!filter_var($data['reg_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['reg_email'] = "Invalid email";
        }else if($this->select(['email' => $data['reg_email']])){
            $this->errors['reg_email'] = "Email already exists";
        }

        // Validate password
        if (empty($data['new_password'])) {
            $this->errors['new_password'] = "Password is required";
        } else if ($data['new_password']) {
            // Other validations for password
        }

        if ($data['new_password'] !== $data['confirm_password']) {
            $this->errors['confirm_password'] = "Passwords do not match";
        }
    }


    private function validateLogin(array $data): void
    {
        $this->errors = [];

        if (empty($data['email'])) {
            $this->errors['email'] = "Email is empty";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email";
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "Password is empty";
        }
    }

    protected function insert_hook(array $data): array
    {

        if (isset($data['new_password']))
            $data['password'] = $data['new_password'];

        if (isset($data['reg_email']))
            $data['email'] = $data['reg_email'];

        // Sanitizing data
        $data['fname'] = ucfirst(strtolower($data['fname']));
        $data['lname'] = ucfirst(strtolower($data['lname']));
        $data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        // Password Hashing
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return $data;
    }
}
