<x-back.master>


    <form action="{{ route('admin.branch.save') }}" method="POST">
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
        <h5>Şube Ekle</h5>
        <p>
           Şube eklemek için kullanılır.
        </p>
    </div>
    <div class="mb-4">
        <label class="form-label">Şube Adı:</label>
        <input type="text" name="name"  value="{{$branchs->name}}" class="form-control" placeholder="Şube Adı">
        <input type="hidden" name="id"  value="{{$branchs->id}}" >
        
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-4">
        <label class="form-label">Şube Adı:</label>
        <select class="selectpicker form-control" name="branch_group_id"  data-live-search="true" title="Select a number" >

            @if ($branchGroups->all()==null)
                <option value="0">Lütfen Grup Ekleyiniz</option>
            @else
                @foreach ($branchGroups as $branchGroup)
                    @if($branchGroup->id==$branchs->branch_group_id)
                        <option selected value="{{ $branchGroup->id }}">{{ $branchGroup->name }}</option>
                    @else
                        <option value="{{ $branchGroup->id }}">{{ $branchGroup->name }}</option>
                    @endif

                @endforeach
            @endif


          </select>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-4">
        <label class="form-label">Şehir:</label>
        <input type="text" value="{{$branchs->city}}"  name="city" class="form-control" placeholder="Şehir">
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-4">
        <label class="form-label">Adres:</label>
        <textarea name="address" id="" cols="30" rows="4" class="form-control" placeholder="Adres">
        {{$branchs->address}}
        </textarea>

    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-4">
        <label class="form-label">Telefon:</label>
        <input type="tel" name="telephone" value="{{$branchs->telephone}}" class="form-control" placeholder="Telefon">
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-4">
        <label class="form-label">Fax:</label>
        <input type="tel" name="fax" value="{{$branchs->fax}}"  class="form-control" placeholder="Fax">
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-4">
        <label class="form-label">Email:</label>
        <input type="email" name="email" value="{{$branchs->email}}"  class="form-control" placeholder="Email">
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Servis Başlangıç Saati:</label>
            <input type="time" name="service_start" value="{{$branchs->service_start}}"  class="form-control" >
            </div>

            <div class="col-md-6">
                <label class="form-label">Servis Bitiş Saati:</label>
            <input type="time" name="service_end" value="{{$branchs->service_end}}"  class="form-control" >
            </div>
        </div>

    </div>
    <!--end::Input group-->

    <div class="mb-4">
        <button type="submit" class="btn btn-light-success">Güncelle</button>
        <a href="#" class="btn btn-light-danger">İptal</a>
    </div>

</form>
@push('css')

<!-- Latest compiled and minified CSS -->



    <


@endpush

@push('js')




@endpush




</x-back.master>
