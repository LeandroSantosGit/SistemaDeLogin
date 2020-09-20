<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

/**
 * Class User
 * @package Source\Models
 */
class User extends DataLayer
{
    /**
     * User construct.
     */
    public function __construct()
    {
        parent::__construct("users", ["first_name", "last_name", "email", "passwd"], "id", true);
    }

    /**
     * @return boolean
     */
    public function save(): bool
    {
        if (
            !$this->validateEmail()
            || !$this->validatePassword()
            || !parent::save()
        ) {
            return false;
        }
        return true;
    }

    /**
     * @return boolean
     */
    protected function validateEmail(): bool
    {
        if (empty($this->email || !filter_var($this->email, FILTER_VALIDATE_EMAIL))) {
            $this->fail = new Exception("Infome um email válido");
            return false;
        }

        $userByEmail = null;
        if (!$this->id) {
            $userByEmail = $this->find("email = :email", "email={$this->email}")->count();
        } else {
            $userByEmail = $this->find("email = :email AND id != :id", "email={$this->email}&id={$this->id}")->count();
        }

        if ($userByEmail) {
            $this->fail = new Exception("O email informado já cadastrado!");
        }
        return true;
    }

    /**
     * @return boolean
     */
    protected function validatePassword(): bool
    {
        if (empty($this->passwd) || strlen($this->passwd) < 5) {
            $this->fail = new Exception("Informe um senha com pelo menos 5 caracteres");
            return false;
        }

        if (password_get_info($this->passwd)["algo"]) {
            return true;
        }

        $this->passwd = \password_hash($this->passwd, PASSWORD_DEFAULT);
        return true;
    }
}
