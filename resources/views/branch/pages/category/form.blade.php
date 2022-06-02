<x-branch.master>
    @push('title')
        Limonist
    @endpush

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

    <form action="{{ route('user.category.save') }}" method="POST" enctype="multipart/form-data">
        @csrf


        @if ($categoryLangs != null)
            <input type="hidden" name="category_id" value="{{ $categoryLangs[0]->category_id }}">
        @endif




        <div class="tab-content" id="myTabContent">

            @foreach ($langs as $lang)
                <div class="tab-pane fade @if ($lang->name == $langFirst->name) show active @endif"
                    id="panel-{{ $lang->name }}" role="tabpanel">

                    @if ($categoryLangs == null)
                        <div class="mb-4">
                            <label class="form-label">Kategori Adı:</label>
                            <input type="text" name="names[{{ $lang->id }}]" value="{{ old('name') }}"
                                class="form-control" placeholder="Grup Adı">

                        </div>
                    @else
                        @foreach ($categoryLangs as $categoryLang)
                            @if ($categoryLang->lang_id == $lang->id)
                                <div class="mb-4">
                                    <label class="form-label">Kategori Adı:</label>
                                    <input type="text" name="names[{{ $lang->id }}]"
                                        value="{{ $categoryLang->translate }}" class="form-control"
                                        placeholder="Kategori Adı">
                                    <input type="hidden" name="id[]" value="{{ $categoryLang->id }}">
                                </div>
                            @else
                                @if (count($langs) != count($categoryLangs))
                                    <div class="mb-4">
                                        <label class="form-label">Kategori Adı:</label>
                                        <input type="text" name="names[{{ $lang->id }}]"
                                            value="{{ old('name') }}" class="form-control" placeholder="Grup Adı">
                                        <input type="hidden" name="id[]" value="{{ $categoryLang->id }}">
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif

                </div>
            @endforeach

        </div>


        <div class="row mb-2">
            <label for="">Kategori Resmi</label>
            <img style="width: 200px"
                src="@isset($category->image) {{ asset($category->image) }} @endisset" alt=""
                class="img-thumbnail rounded img-fluid">
            <input type="file" name="image">
        </div>

        <div class="row">
            <button type="submit" class="btn btn-success me-2 mb-2">
                @if ($categoryLangs == null)
                    Kaydet
                @else
                    Güncelle
                @endif
            </button>
        </div>

    </form>

</x-branch.master>
