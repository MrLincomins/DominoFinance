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

    public function login($mail, $password): bool
    {
        $user = DB::table('users')->where('mail', '=', $mail)->get();
    }

}
