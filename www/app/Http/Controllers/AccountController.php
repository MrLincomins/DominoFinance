<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;


class AccountController extends Controller
{
    public function registration(Request $request): bool
    {
        $name = $request->json('name');
        $age = $request->json('age');
        $mail = $request->json('mail');
        $level = $request->json('level');
        if($this->checkRegistration($mail)) {

            $password = password_hash($request->json('password'), PASSWORD_BCRYPT);
            $this->cookiesAdder($name, $age, $mail ,$level, $password, 0);
            DB::table('users')->insert([
                'name' => $name,
                'age' => $age,
                'level' => $level,
                'mail' => $mail,
                'password' => $password,
                'points' => 0
            ]);
            return True;
        } else {
            return False;
        }
    }

    public function cookiesAdder($name, $age, $mail, $level, $password, $points): void
    {
        Cookie::make('name', $name, 43800);
        Cookie::make('age', $age, 43800);
        Cookie::make('mail', $mail, 43800);
        Cookie::make('password', $password, 43800);
        Cookie::make('level', $level, 43800);
        Cookie::make('password', $password, 43800);
        Cookie::make('points', $points, 43800);
    }

    public function checkRegistration($mail): bool
    {
        if(DB::table('users')->where('mail','=', $mail)->exists()){
            return False;
        } else {
            return True;
        }
    }

    public function endSession(): void
    {
        Cookie::make('name', 0, 0);
        Cookie::make('age', 0, 0);
        Cookie::make('mail', 0, 0);
        Cookie::make('password', 0, 0);
        Cookie::make('level', 0, 0);
        Cookie::make('password', 0, 0);
        Cookie::make('points', 0, 0);
    } //Переделать

    public function login(Request $request): bool
    {
        $this->endSession();
        $mail = $request->json('mail');
        $password = $request->json('password');
        $user = json_decode(DB::table('users')->where('mail', '=', $mail)->get(), true)[0];
        if (password_verify($password, $user['password'])) {
            $this->cookiesAdder($user['name'], $user['age'], $user['mail'], $user['level'], $user['password'], $user['points']);
            return True;
        } else {
            return False;
        }
    }

    public function checkSession(): void
    {
        $user = json_decode(DB::table('users')->where('mail', '=', Cookie::get('mail'))->get(), true)[0];
        if(!empty($user)) {
            if(!Cookie::get('name') == $user['name']
                and !Cookie::get('level') == $user['level']
                and !Cookie::get('age') == $user['age']
                and !password_verify(Cookie::get('password'), $user['password'])){
                //help
                $this->endSession();
            }
        }
    }

}
