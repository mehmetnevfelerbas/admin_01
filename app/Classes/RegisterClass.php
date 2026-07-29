<?php

namespace App\Classes;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterClass
{
    public function register()
    {
        try {
            $name     = request()->get('name');
            $email    = request()->get('email');
            $phone    = request()->get('phone'); 
            $password = request()->get('password');

            if (empty($name)) {
                return ["status" => false, "message" => "Ad Soyad alanı boş olamaz."];
            }

            if (empty($email)) {
                return ["status" => false, "message" => "Email alanı boş olamaz."];
            }

            if (empty($phone)) {
                return ["status" => false, "message" => "Telefon numarası alanı boş olamaz."];
            }

            if (empty($password)) {
                return ["status" => false, "message" => "Şifre alanı boş olamaz."];
            }

            $checkUser = User::where('email', $email)->first();
            if ($checkUser) {
                return ["status" => false, "message" => "Bu e-posta adresi zaten kayıtlı."];
            }

            User::create([
                'name'     => $name,
                'email'    => $email,
                'phone'    => $phone, 
                'password' => Hash::make($password),
                'status'   => 0
            ]);

            return [
                "status"  => true,
                "message" => "Kayıt talebiniz alınmıştır! Yönetici onayından sonra giriş yapabilirsiniz."
            ];

        } catch (\Throwable $th) {
            return ["status" => false, "message" => "Hata: " . $th->getMessage()];
        }
    }
}