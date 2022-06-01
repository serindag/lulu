<x-back.master>

    @push('title') Limonist @endpush
    <form action="{{ route('admin.branchUser.save') }}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger mt-5">

                <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>


            </div>
        @endif
        <div class="mb-4 mt-5">
        <!--begin::Input group-->
        @if (!Request::segment(4))
            <h5>Şube Kullancı Ekle</h5>
            <p>
                Bu bölümde Şube kullancıları ekleyebilirsiniz.
            </p>
        @else
            <h5>Şube Kullancı Güncelle</h5>
            <p>
                Bu bölümde oluşturulan Şube kullancılarını düzenleyebilirsiniz.
            </p>

        @endif
        </div>

        <div class="mb-4">
            <label class="form-label">Kullancı Adı:</label>
            <input type="text" name="name" value="@isset($user->name) {{ $user->name }} @endisset"
                class="form-control" placeholder="Kullanıcı Adı">
                <input type="hidden" name="id" value="@isset($user->id) {{ $user->id }} @endisset">
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-4">
            <label class="form-label">E mail:</label>
            <input type="text" value="@isset($user->email) {{ $user->email }} @endisset" name="email"
                class="form-control" placeholder="E-mail">
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-4">
            <label class="form-label">Şifre:</label>
            <input type="password" name="password" class="form-control" placeholder="Şifre">
        </div>
        <!--end::Input group-->

        <div class="mb-4">
            <label class="form-label">Şubeler:</label>
            <select class="selectpicker form-control" name="branch_id" data-live-search="true"
                title="Select a number">
                @if ($user != null)
                    
                    @if ($branchs->all() == null)
                    
                        <option value="0">Lütfen grup ekleniniz.</option>
                    @else
                        @foreach ($branchs as $branch)
                            @if ($branch->id == $user->branch_id)
                                <option selected value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @else
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endif
                        @endforeach
                    @endif
                @else
                    @if ($branchs->all() == null)
                        <option value="0">Lütfen grup ekleniniz.</option>
                    @else
                        @foreach ($branchs as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    @endif

                @endif


            </select>
        </div>
        <!--end::Input group-->



        <div class="mb-4">
            <button type="submit" class="btn btn-light-success">
                @if (!Request::segment(4))
                Kaydet
                @else
                Güncelle
                @endif
                
                </button>
            <a href="{{ route('admin.branchUser.list') }}" class="btn btn-light-danger">İptal</a>
        </div>

    </form>




</x-back.master>
