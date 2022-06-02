<x-back.master>
    @push('title')
        Limonist
    @endpush


    <div class="mb-4 mt-5">
        @if ($branchGroupLangs == null)
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

    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">

        @foreach ($langs as $lang)
            <li class="nav-item">
                <a class="nav-link @if ($lang->name == $langFirst->name) active @endif" data-bs-toggle="tab"
                    href="#panel-{{ $lang->name }}">{{ $lang->name }}</a>
            </li>
        @endforeach
    </ul>

    <form action="{{ route('admin.branchGroup.save') }}" method="POST">
        @csrf


        @if ($branchGroupLangs != null)
            <input type="hidden" name="branchGroup_id" value="{{ $branchGroupLangs[0]->branchGroup_id }}">
        @endif




        <div class="tab-content" id="myTabContent">

            @foreach ($langs as $lang)
                <div class="tab-pane fade @if ($lang->name == $langFirst->name) show active @endif"
                    id="panel-{{ $lang->name }}" role="tabpanel">

                    @if ($branchGroupLangs == null)
                        <div class="mb-4">
                            <label class="form-label">Grup Adı:</label>
                            <input type="text" name="names[{{ $lang->id }}]" value="{{ old('name') }}"
                                class="form-control" placeholder="Grup Adı">

                        </div>
                    @else
                        @foreach ($branchGroupLangs as $branchGroupLang)
                            @if ($branchGroupLang->lang_id == $lang->id)
                                <div class="mb-4">
                                    <label class="form-label">Grup Adı:</label>
                                    <input type="text" name="names[{{ $lang->id }}]"
                                        value="{{ $branchGroupLang->translate }}" class="form-control"
                                        placeholder="Grup Adı">
                                    <input type="hidden" name="id[]" value="{{ $branchGroupLang->id }}">
                                </div>
                            @else
                                @if (count($langs) != count($branchGroupLangs))
                                    <div class="mb-4">
                                        <label class="form-label">Grup Adı:</label>
                                        <input type="text" name="names[{{ $lang->id }}]"
                                            value="{{ old('name') }}" class="form-control" placeholder="Grup Adı">
                                        <input type="hidden" name="id[]" value="{{ $branchGroupLang->id }}">
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif

                </div>
            @endforeach

        </div>
        <div class="row">
            <button type="submit" class="btn btn-success me-2 mb-2">
                @if ($branchGroupLangs == null)
                    Kaydet
                @else
                    Güncelle
                @endif
            </button>
        </div>

    </form>

</x-back.master>
