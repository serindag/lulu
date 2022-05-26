<x-back.master>

    <form action="{{ route('admin.user.save') }}" method="POST">
        @csrf
            @if($errors->any())
                <div class="alert alert-danger mt-5">

                        <ul>
                            @foreach($errors->all() as $error)
                            <li> {{$error}}</li>
                            @endforeach
                        </ul>


                </div>
        @endif
    <!--begin::Input group-->
    <div class="mb-4 mt-5">
        <h5>Kullanıcı Bilgileri</h5>
        <p>
            Buradan adınızı,soyadınızı,mail adresinizi ve şifrenizi güncelleyebilirsiniz...
        </p>
    </div>
    <div class="mb-4">
        <label class="form-label">Kullancı Adı:</label>
        <input type="text" name="name"  value="@isset($user->name){{ $user->name }}@endisset" class="form-control" placeholder="Kullanıcı Adı">
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-4">
        <label class="form-label">E mail:</label>
        <input type="text"  value="@isset($user->email){{ $user->email }}@endisset" name="email" class="form-control" placeholder="E-mail">
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-4">
        <label class="form-label">Şifreniz:</label>
        <input type="password"  name="lastPassword" class="form-control" placeholder="Şifre">
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-4">
        <label class="form-label">Yeni Şifre:</label>
        <input type="password" name="newPassword" class="form-control" placeholder="Yeni Şifre">
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-4">
        <label class="form-label">Yeni Şifre Kontrol:</label>
        <input type="password" name="newPasswordRepeat"  class="form-control" placeholder="Yeni Şifre Tekrar">
    </div>
    <!--end::Input group-->

    <div class="mb-4">
        <button type="submit" class="btn btn-light-success">Güncelle</button>
        <a href="#" class="btn btn-light-danger">İptal</a>
    </div>

</form>




</x-back.master>
