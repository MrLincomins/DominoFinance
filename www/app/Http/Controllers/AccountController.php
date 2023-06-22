<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;


class AccountController extends Controller
{

    //docker exec -i chatbot-php php artisan make:migration create_users_table

    public function registration(Request $request): string
    {
        $name = $request->json('name');
        $age = $request->json('age');
        $mail = $request->json('mail');
        $level = 0;
        if($this->checkRegistration($mail)) {
            $password = password_hash($request->json('password'), PASSWORD_BCRYPT);
            $user = User::create([
                'name' => $name,
                'age' => $age,
                'level' => $level,
                'mail' => $mail,
                'password' => $password,
                'points' => 0
            ]);

            Auth::login($user);

            return True;
        } else {
            return '0';
        }
    }

    public function checkRegistration($mail): bool
    {
        if(!empty(User::all()->where('mail','=', $mail))){
            return False;
        } else{
            return True;
        }
    }

    public function endSession(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\Foundation\Application
    {
        Auth::logout();
        return redirect('/');
    } //Кайфвырь


    public function login(Request $request)
    {
        $this->endSession();
        $mail = $request->json('mail');
        $password = $request->json('password');

        if (Auth::attempt(['mail' => $mail, 'password' => $password])) {
            return response()->json(true);
        } else {
            return response()->json('none');
        }
    }



    public function checkSession(): void
    {
        if (!Auth::check()) {
            // Пользователь не авторизован, выполните нужные действия
            $this->endSession();
        }
    }

}
