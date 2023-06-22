<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PointController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AccountController extends Controller
{
// php artisan config:cache
    // docker compose exec chatbot-php php artisan migrate
    //php artisan optimize
    //php artisan route:cache

    public function registration(Request $request): string
    {
        $name = $request->json('name');
        $age = $request->json('age');
        $mail = $request->json('mail');
        $level = $request->json('level');
        $user = User::where('mail', $mail)->first();
        if ($user && $user->exists()) {
            return '0';
        } else {
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
            $this->cookie((DB::select('SELECT * FROM users WHERE mail = :mail', ['mail' => $mail])));
            return True;
        }
    }

    public function checkMail($mail): bool
    {
        $user = User::where('mail', $mail)->first();
        if ($user && $user->exists()) {
            return true;
        } else {
            return false;
        }
    }

    public function cookie($data): void
    {
        $data = json_decode(json_encode($data[0]), true);

        $id = $data['id'];
        $name = $data['name'];
        $age = $data['age'];
        $mail = $data['mail'];
        $level = $data['level'];
        $points = $data['points'];
        setcookie('id', $id, time()+36000000, "/");
        setcookie('name', $name, time()+36000000, "/");
        setcookie('age', $age, time()+360000000, "/");
        setcookie('mail', $mail,time()+36000000, "/");
        setcookie('level', $level, time()+36000000, "/");
        setcookie('points' , $points, time()+36000000, "/");
    }
    public function cookieContact($name, $age, $mail): void
    {
        setcookie('name', $name, time()+360000);
        setcookie('age', $age, time()+360000);
        setcookie('mail', $mail,time()+360000);
    }


//    public function registrationPoint(): \App\Http\Controllers\PointController|bool
//    {
//
//        $points = new PointController;
//        $points->registrationUser($userId, $userEmail);
//        return $points;
//    }

    public function endSession(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\Foundation\Application
    {
        Auth::logout();
        return redirect('/');
    } //Кайфырь


    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->endSession();
        $mail = $request->json('mail');
        $password = $request->json('password');
        if (Auth::attempt(['mail' => $mail, 'password' => $password])) {
            $this->cookie(DB::select('SELECT * FROM users WHERE mail = :mail', ['mail' => $mail]));
            return response()->json(true);
        } else {
            return response()->json('none');
        }
    }

    public function updateUser(Request $request): bool
    {
        $name = $request->json('name');
        $age = $request->json('age');
        $mail = $request->json('mail');
        if(!$this->checkMail($mail)) {
            $user = User::find($_COOKIE['id']);
            $user->name = $name;
            $user->age = $age;
            $user->mail = $mail;
            $user->save();
            $this->cookieContact($name, $age, $mail);
            return True;
        } else {
            return False;
        }
    }

    public function storePoints(Request $request)
    {
        $points1 = DB::select('SELECT points FROM users WHERE id = :id', ['id' => $_COOKIE['id']]);
        $points1 = json_decode(json_encode($points1[0]), true)['points'];
        $points = $request->json('points');

        $user = User::find($_COOKIE['id']);
        if ($user) {
            $user->points = $points + $points1;
            $user->save();
            $this->cookieContactPoints($points1 + $points);
            return true;
        } else {
            return false;
        }
    }

    public function buyContent(Request $request): bool
    {
        setcookie('css', 'sponge', time()+36000000, "/");
        $points1 = DB::select('SELECT points FROM users WHERE id = :id', ['id' => $_COOKIE['id']]);
        $points1 = json_decode(json_encode($points1[0]), true)['points'];
        $points = $request->json('points');
        if($points1 > $points) {
            $user = User::find($_COOKIE['id']);
            if ($user) {
                $user->points = $points1 - $points;
                $user->save();
                $this->cookieContactPoints($points1 - $points);
                return true;
            }
        } else {
            return False;
        }
    }

    public function cookieContactPoints($points): void
    {
        setcookie('points' , $points, time()+36000000, "/");
        setcookie('css', 'sponge', time()+36000000, "/");
    }


    public function checkSession(): void
    {
        if (!Auth::check()) {
            // Пользователь не авторизован, выполните нужные действия
            $this->endSession();
        }
    }

}
