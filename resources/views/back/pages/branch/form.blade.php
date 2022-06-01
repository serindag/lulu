<x-back.master>
    @push('title') Limonist @endpush

    <form action="{{ route('admin.branch.save') }}" method="POST">
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
        <!--begin::Input group-->

        <div class="mb-4 mt-5">
            @if (!Request::segment(4))
                <h5>Şube Ekle</h5>
                <p>
                    Bu bölümde şube ekleyebilirsiniz.
                </p>
            @else
                <h5>Şube Güncelle</h5>
                <p>
                    Bu bölümde oluşturulan şubeyi düzenleyebilirsiniz.
                </p>
    
            @endif
            
        </div>

        
        <div class="mb-4">
            <label class="form-label">Şube Adı:</label>
            <input type="text" name="name" value="@if ($branchs != null) {{ $branchs->name }} @endif"
                class="form-control" placeholder="Şube Adı">
            <input type="hidden" name="id" value="@if ($branchs != null) {{ $branchs->id }} @endif">

        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-4">
            <label class="form-label">Şube Adı:</label>
            <select class="selectpicker form-control" name="branch_group_id" data-live-search="true"
                title="Select a number">
                @if ($branchs != null)
                    @if ($branchGroups->all() == null)
                        <option value="0">Lütfen grup ekleniniz.</option>
                    @else
                        @foreach ($branchGroups as $group)
                            @if ($group->id == $branchs->branch_group_id)
                                <option selected value="{{ $group->id }}">{{ $group->name }}</option>
                            @else
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endif
                        @endforeach
                    @endif
                @else
                    @if ($branchGroups->all() == null)
                        <option value="0">Lütfen grup ekleniniz.</option>
                    @else
                        @foreach ($branchGroups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    @endif

                @endif


            </select>
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-4">
            <label class="form-label">Şehir:</label>
            <input type="text" value="@if ($branchs != null) {{ $branchs->city }} @endif" name="city"
                class="form-control" placeholder="Şehir">
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-4">
            <label class="form-label">Adres:</label>
            <textarea name="address" id="" cols="30" rows="4" class="form-control" placeholder="Adres">
            @if ($branchs != null)
{{ $branchs->address }}
@endif
        
        </textarea>

        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-4">
            <label class="form-label">Telefon:</label>
            <input type="tel" name="telephone" value="
        @if ($branchs != null) {{ $branchs->telephone }} @endif" class="form-control"
                placeholder="Telefon">
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-4">
            <label class="form-label">Fax:</label>
            <input type="tel" name="fax" value="@if ($branchs != null) {{ $branchs->fax }} @endif"
                class="form-control" placeholder="Fax">
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-4">
            <label class="form-label">Email:</label>
            <input type="email" name="email" value="@if ($branchs != null) {{ $branchs->email }} @endif"
                class="form-control" placeholder="Email">
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Servis Başlangıç Saati:</label>
                    <input type="time" name="service_start"
                        value="@if ($branchs != null) {{ $branchs->service_start }} @endif"
                        class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Servis Bitiş Saati:</label>
                    <input type="time" name="service_end" value="{
            @if ($branchs != null) {{ $branchs->service_end }} @endif" class="form-control">
                </div>
            </div>

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
            <a href="{{route('admin.branch.list')}}" class="btn btn-light-danger">İptal</a>
        </div>

    </form>
    @push('css')
        <!-- Latest compiled and minified CSS -->



        < @endpush @push('js') @endpush </x-back.master>
