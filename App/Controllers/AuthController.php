<?php

namespace App\Controllers;

use App\Request;
use App\Models\User;

class AuthController
{
    public function index()
    {
        return view('Auth/login');
    }
    public function RegisterIndex()
    {
        return view('Auth/register');
    }

    public function auth($username, $password)
    {
        $user = new User();
        $user = $user->search($username, 'username');

        if ($user) {
            return $password == $user->getPassword();
        } else {
            return false;
        }
    }
    public function register(Request $r)
    {
        try {

            $r->validate([
                "username" => "required|regex:[a-zA-Z]|max:20",
                "email" => "required|email",
                "phone" => "required|phone",
                "name" => "required|max:20",
                "lastname" => "required|max:20",
                "password" => "required|password",
            ]);
            $r = $r->all();
            $user = new User();

            $user->create([
                "username" => $r->username,
                "email" => $r->email,
                "phone" => $r->phone,
                "name" => $r->name,
                "lastname" => $r->lastname,
                "password" =>  hash('sha256', $r->password),
            ]);

            return view('Auth/login',);
        } catch (\Exception $e) {
            return view('Auth/login', [], [
                $e->getMessage()
            ]);
        }
    }

    public function login(Request $r)
    {
        try {
            $r->validate([
                "username" => "required",
                "password" => "required",
            ]);

            if ($this->auth(
                $r->all()->username,
                hash('sha256', $r->all()->password)
            )) {
                return view('home/home');
            } else {
                return view('Auth/login', [], [
                    "El Usuario o la Contraseña no son Válidos"
                ]);
            }
        } catch (\Exception $e) {
            return view('Auth/login', [], [
                $e->getMessage()
            ]);
        }
    }
}
