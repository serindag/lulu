<x-back.master>
    @push('title')
        Limonist
    @endpush


    <div class="mb-4 mt-5">
        @if ($branchGroups == null)
            <h5>Grup Ekle</h5>
            <p>
                Bu bölümde grup ekleyebilirsiniz.
            </p>
        @else
            <h5>Popup Güncelle</h5>
            <p>
                Bu bölümde oluşturulan grubu düzenleyebilirsiniz.
            </p>
        @endif

    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-5">

            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>


        </div>
    @endif

    @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

    

    <form action="{{ route('admin.branchGroup.save') }}" method="POST">
        @csrf


       

            
                

        <div class="mb-4">
            <label class="form-label">Şube Adı:</label>
            <input type="text" name="name" value="@if ($branchGroups != null) {{ $branchGroups->name }} @else {{ old('name') }} @endif"
                class="form-control" placeholder="Şube Adı">

            <input type="hidden" name="id" value="@if ($branchGroups != null) {{ $branchGroups->id }} @endif">

        </div>

           
        
        <div class="mb-4">
            <button type="submit" class="btn btn-light-success">
                @if ($branchGroups == null)
                    Kaydet
                @else
                    Güncelle
                @endif
            </button>
            <a href="{{ route('admin.branch.list') }}" class="btn btn-light-danger">İptal</a>
        </div>
           

        
       

    </form>

</x-back.master>
