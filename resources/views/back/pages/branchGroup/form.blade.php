<x-back.master>


    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">

        @foreach ($langs as $lang)
            <li class="nav-item">
                <a class="nav-link @if($lang->name==$langFirst->name) active @endif" data-bs-toggle="tab" href="#panel-{{ $lang->name }}">{{ $lang->name }}</a>
            </li>
        @endforeach
    </ul>

    <form action="{{ route('admin.branchGroup.save') }}" method="POST">
        @csrf
        <div class="tab-content" id="myTabContent">

            @foreach ($langs as $lang)

                <div class="tab-pane fade @if($lang->name==$langFirst->name) show active @endif" id="panel-{{ $lang->name }}" role="tabpanel">

                    <div class="mb-4">
                        <label class="form-label">Grup Adı:</label>
                        <input type="text" name="names[{{ $lang->id }}]"  value="{{ old('name') }}" class="form-control" placeholder="Grup Adı">
                    </div>
                </div>

            @endforeach

        </div>
        <div class="row">
            <button  type="submit" class="btn btn-success me-2 mb-2">
                Kaydet
            </button>
        </div>

    </form>

</x-back.master>




