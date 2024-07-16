<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthLoginController extends Controller
{
    // Phương thức để chuyển hướng người dùng đến trang xác thực của Google
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    // Phương thức xử lý thông tin người dùng trả về từ Google
    public function handleProviderCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                Auth::login($user, true);
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Hash::make(Str::random(16))),
                ]);

                Auth::login($user, true);
            }

            return redirect('/');
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors('Failed to login with Google.');
        }
    }
}
