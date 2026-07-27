<?php

namespace App\Classes;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UsersClass
{

    public function getData()
    {

        try {
            $data = User::all();
            return DataTables::of($data)
                ->addColumn('status_name', function ($user) {
                    if ($user->status == 1) {
                        return "Aktif";
                    } else {
                        return "Pasif";
                    }
                })
                ->addColumn('action', function ($user) {
                    return '<a href="' . route('users/edit', [$user->id]) . '" class="btn btn-primary btn-sm me-2 min-btn-table">Düzenle</a>' . '<a href="#" class="btn btn-danger btn-sm min-btn-table delUserBtn" data-id="' . $user->id . '">Sil</a>';
                })
                ->setRowAttr([
                    'data-id' => function($user) {
                        return $user->id;
                    }
                ])
                ->make(true);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function saveUser()
    {
        try {

            $name_surname = request()->get('name_surname');
            $email = request()->get('email');
            $phone = request()->get('phone');
            $password = request()->get('password');
            $password_rep = request()->get('password_rep');
            $status = request()->get('status');
            $user_id = request()->get('user_id');

            if ($name_surname == null) {
                return ["status" => false, "message" => "Ad Soyad alanı boş olamaz."];
            }

            if ($email == null) {
                return ["status" => false, "message" => "E-Mail alanı boş olamaz."];
            }



            if ($user_id == null) {
                $mailCheck = User::where('email', $email)->first();
                if ($mailCheck) {
                    return ["status" => false, "message" => "Bu e-mail adresi ile daha önce kayıt yapılmış."];
                }

                if ($password == null) {
                    return ["status" => false, "message" => "Şifre alanı boş olamaz."];
                }

                if ($password_rep == null) {
                    return ["status" => false, "message" => "Şifre tekrar alanı boş olamaz."];
                }

                if ($password != $password_rep) {
                    return ["status" => false, "message" => "Şifreler uyuşmuyor."];
                }

                $user = new User();
                $user->create_user_id = FacadesAuth::user()->id;
                $user->password = Hash::make($password);
                $user->updated_at = null;
            } else {

                $user = User::find($user_id);
                $user->update_user_id = FacadesAuth::user()->id;
                $user->updated_at = Carbon::now();

                if ($password != null) {
                    if ($password_rep == null) {
                        return ["status" => false, "message" => "Şifre tekrar alanı boş olamaz."];
                    }

                    if ($password != $password_rep) {
                        return ["status" => false, "message" => "Şifreler uyuşmuyor."];
                    }

                    $user->password = Hash::make($password);
                }
            }





            $user->name = $name_surname;
            $user->email = $email;
            $user->phone = $phone;
            $user->status = $status;

            if ($user->save()) {
                return ["status" => true, "message" => "Kullanıcı kaydı başarıyla " . ($user_id == null ? 'gerçekleşti' : 'güncellendi') . "."];
            } else {
                return ["status" => false, "message" => "Kullanıcı kaydı sırasında bir hata oluştu."];
            }
        } catch (\Throwable $th) {
            return ["status" => false, "message" => "Kullanıcı kaydı sırasında bir hata oluştu."];
        }
    }


    public function delUSer()
    {
        try {

            $user_id = request()->get('user_id');
            if ($user_id == null) {
                return ["status" => false, "message" => "Parametre bilgileri alınamadı."];
            }

            if (FacadesAuth::user()->id == $user_id) {
                return ["status" => false, "message" => "Kendi kullanıcı kaydınızı silemezsiniz."];
            }

            if (DB::table('users')->where('id', $user_id)->delete()) {
                return ["status" => true, "message" => "Kullanıcı kaydı başarıyla silindi."];
            } else {
                return ["status" => false, "message" => "Kullanıcı kaydı silinirken bir hata oluştu."];
            }
        } catch (\Throwable $th) {
            return ["status" => false, "message" => "Kullanıcı kaydı sırasında bir hata oluştu."];
        }
    }
}
