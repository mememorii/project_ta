<?php

namespace App\Validation;

use App\Models\AuthModel;

class AuthRules
{


    public function validateUser(string $str, string $fields, array $data)
    {

        $model = new AuthModel();
        $user = $model->where('nik', $data['nik'])
                      ->first();

        if (!$user) {
            return false;
        }
        else{
            return password_verify($data['password'], $user['password']);
        }

    }

    public function validateExists(string $str, string $fields, array $data)
    {
        $model = new AuthModel();
        $user = $model->where('nik', $data['nik'])
        ->first();

        if (!$user) {
            return false;
        } else {
            return true;
        }
    }

    
    public function validateExists1(string $str, string $fields, array $data)
    {
        $model = new AuthModel();
        $user = $model->where('email', $data['email'])
        ->first();

        if (!$user) {
            return false;
        } else {
            return true;
        }
    }

    




}