@extends('layouts.app.app')

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <h4 class="">Kullanıcı {{ ($user != null ? 'Güncelleme' : 'Kayıt') }} İşlemleri {{ ($user == null ? '' : ' - '. $user->name ) }}</h4>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <span class="badge badge-primary bg-primary float-end p-2" style="font-style: italic;font-weight:600">Sisteme yeni bir kullanıcı ekleyebilir veya düzenleyebilirsiniz.</span>

    </div>
</div>
<hr/>
    <div class="card">
        <div class="card-header card-border">
            <a href="{{ route('users') }}"><button type="button" class="btn btn-primary min-btn">Listeye Dön</button></a>

            <button type="button" class="btn btn-success min-btn float-end saveUserBtn">Bilgileri Kaydet</button>
        </div>
        <div class="card-body">
            <form id="usersForm">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label">Adı Soyadı *</label>
                            <input type="text" class="form-control name_surname" name="name_surname"
                                placeholder="Adı soyadı yazınız." value="{{ $user == null ? null : $user->name }}" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label">E-Mail Adresi *</label>
                            <input type="email" class="form-control email" name="email"
                                placeholder="E-Mail adresi yazınız." value="{{ $user == null ? null : $user->email }}" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label">Şifre *</label>
                            <input type="password" class="form-control password" name="password"
                                placeholder="Şifre yazınız." autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label">Şifre Tekrarı *</label>
                            <input type="password" class="form-control password_rep" name="password_rep"
                                placeholder="Şifrenizi tekrar yazınız." />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label">Telefon Numarası </label>
                            <input type="number" class="form-control phone" name="phone"
                                placeholder="Telefon numarası yazınız."value="{{ $user == null ? null : $user->phone }}" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label">Durum *</label>
                            <select class="form-control status">
                                <option value="1" {{ ($user == null ? 'selected'  :($user->status == 1 ? 'selected' : '')) }}>Aktif</option>
                                <option value="0" {{ ($user == null ? '' : ($user->status == 0 ? 'selected' : '')) }}>Pasif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <input type="hidden" value="{{ ($user == null ? null : $user->id) }}" class="user_id" />
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        var checkInterval = setInterval(function() {
            if (app.loader !== undefined && app.loader !== null) {
                app.loader.setModule("Users");
                clearInterval(checkInterval);
            }
        }, 500);
    </script>
@endsection
