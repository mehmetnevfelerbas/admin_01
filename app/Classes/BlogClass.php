<?php

namespace App\Classes;

use App\Models\Blogs;
use App\Models\BlogsTranslate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class BlogClass
{


    public function getData()
    {

        try {

            $status = request()->get('status');
            $type = request()->get('type');


            $data = Blogs::join('blogs_translate as bt', 'bt.blog_id', '=', 'blogs.id')
                ->select('blogs.*', 'bt.title', 'bt.description')
                ->where('blogs.status',  $status)
                ->where('bt.lang_code', "tr");

            if ($type != 0) {
                $data = $data->where('blogs.type_id',  $type);
            }

            $data = $data->get();

            return DataTables::of($data)
                ->addColumn('status_name', function ($blog) {
                    if ($blog->status == 1) {
                        return "Aktif";
                    } else {
                        return "Pasif";
                    }
                })
                ->addColumn('type_name', function ($blog) {
                    if ($blog->type_id == 1) {
                        return "Blog";
                    } else {
                        return "Haber";
                    }
                })
                ->addColumn('action', function ($blog) {
                    return '<a href="' . route('blog/edit', ["id" => $blog->id]) . '" class="btn btn-primary btn-sm me-2 min-btn-table">Düzenle</a>'
                        . '<a href="#" class="btn btn-' . ($blog->status == 1 ? 'warning' : 'success') . ' btn-sm me-2 min-btn-table  ' . ($blog->status == 1 ? 'passiveBtn' : 'activeBtn') . ' " data-id="' . $blog->id . '">' . 
                        
                        ($blog->status == 1 ? 'Pasif' : 'Aktif') . ' Yap</a>' .
                        '<a href="#" class="btn btn-danger btn-sm min-btn-table deleteBtn " data-id="' . $blog->id . '">Sil</a>';
                })
                ->setRowAttr([
                    'data-id' => function ($blog) {
                        return $blog->id;
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

    public function passive()
    {
        try {

            $blog_id = request()->get('blog_id');
            if ($blog_id == null) {
                return ["status" => false, "message" => "Parametre bilgileri alınamadı."];
            }


            $mdl = Blogs::find($blog_id);
            $mdl->status = 0;
            $mdl->update_user_id = FacadesAuth::user()->id;
            $mdl->updated_at  = Carbon::now();

            if ($mdl->save()) {
                return ["status" => true, "message" => "Blog kaydı başarıyla pasif yapıldı."];
            } else {
                return ["status" => false, "message" => "İşlem başarısız."];
            }
        } catch (\Throwable $th) {
            return ["status" => false, "message" => "İşlem başarısız."];
        }
    }

    public function active()
    {
        try {

            $blog_id = request()->get('blog_id');
            if ($blog_id == null) {
                return ["status" => false, "message" => "Parametre bilgileri alınamadı."];
            }


            $mdl = Blogs::find($blog_id);
            $mdl->status = 1;
            $mdl->update_user_id = FacadesAuth::user()->id;
            $mdl->updated_at  = Carbon::now();

            if ($mdl->save()) {
                return ["status" => true, "message" => "Blog kaydı başarıyla aktif yapıldı."];
            } else {
                return ["status" => false, "message" => "İşlem başarısız."];
            }
        } catch (\Throwable $th) {
            return ["status" => false, "message" => "İşlem başarısız."];
        }
    }

    public function delete()
    {
        try {


            $blog_id = request()->get('blog_id');
            if ($blog_id == null) {
                return ["status" => false, "message" => "Parametre bilgileri alınamadı."];
            }

            DB::beginTransaction();

            DB::table('blogs_translate')->where('blog_id', $blog_id)->delete();

            if (DB::table('blogs')->where('id', $blog_id)->delete()) {
                DB::commit();
                return ["status" => true, "message" => "Blog kaydı başarıyla silindi."];
            } else {
                DB::rollBack();
                return ["status" => false, "message" => "İşlem başarısız."];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return ["status" => false, "message" => "İşlem başarısız. " . $th->getMessage()];
        }
    }

    public function save()
    {
        try {

            $title = request()->get('title');
            $description = request()->get('description');
            $type = request()->get('type');
            $status = request()->get('status');
            $content = request()->get('content');
            $lang = request()->get('lang');
            $blog_id = request()->get('blog_id');

            if ($title == null) {
                return ["status" => false, "message" => "Başlık alanı boş geçilemez."];
            }

            DB::beginTransaction();

            if ($blog_id == null) {
                $mdl = new Blogs();
                $mdl->created_at = Carbon::now();
                $mdl->updated_at = null;
                $mdl->create_user_id = FacadesAuth::user()->id;
            } else {
                $mdl = Blogs::find($blog_id);
                $mdl->updated_at = Carbon::now();
                $mdl->update_user_id = FacadesAuth::user()->id;
            }


            $mdl->status = $status;
            $mdl->type_id = $type;

            if ($mdl->save()) {


                $check = BlogsTranslate::where('blog_id', $mdl->id)->where('lang_code', $lang)->first();
                if ($check != null) {
                    $translate = BlogsTranslate::find($check->id);
                    $translate->update_user_id = FacadesAuth::user()->id;
                    $translate->updated_at = Carbon::now();
                } else {
                    $translate = new BlogsTranslate();
                    $translate->created_at = Carbon::now();
                    $translate->updated_at = null;
                    $translate->create_user_id = FacadesAuth::user()->id;
                }

                $translate->title = $title;
                $translate->description = $description;
                $translate->content = $content;
                $translate->image_path = null;
                $translate->lang_code = $lang;
                $translate->blog_id = $mdl->id;

                if ($translate->save()) {
                    DB::commit();
                    return ["status" => true, "message" => "Blog kaydı başarıyla eklendi."];
                } else {
                    DB::rollBack();
                    return ["status" => false, "message" => "İşlem başarısız."];
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return ["status" => false, "message" => "İşlem başarısız. " . $th->getMessage()];
        }
    }

    public function getBlogData()
    {
        try {

            $blog_id = request()->get('blog_id');
            $lang_code = request()->get('lang_code');
            if ($lang_code == null) {
                $lang_code = "tr";
            }

            if ($blog_id == null) {
                return ["status" => false, "message" => "Parametre bilgileri alınamadı."];
            }

            $data = Blogs::join('blogs_translate as bt', 'bt.blog_id', '=', 'blogs.id')
                ->select('blogs.*', 'bt.title', 'bt.description', 'bt.content')
                ->where('blogs.id',  $blog_id)
                ->where('bt.lang_code', $lang_code)
                ->first();

            return ["status" => true, "data" => $data];
        } catch (\Throwable $th) {
            return ["status" => false, "message" => "İşlem başarısız."];
        }
    }
}
