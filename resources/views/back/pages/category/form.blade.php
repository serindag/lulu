<x-back.master>


    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">

        @foreach ($langs as $lang)
            <li class="nav-item">
                <a class="nav-link @if ($lang->name == $langFirst->name) active @endif" data-bs-toggle="tab"
                    href="#panel-{{ $lang->name }}">{{ $lang->name }}</a>
            </li>
        @endforeach
    </ul>

    <form action="{{ route('admin.category.save') }}" method="POST">
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
                            <label class="form-label">Category Adı:</label>
                            <input type="text" name="names[{{ $lang->id }}]" value="{{ old('name') }}"
                                class="form-control" placeholder="Grup Adı">

                        </div>
                    @else
                        @foreach ($categoryLangs as $categoryLang)
                            @if ($categoryLang->lang_id == $lang->id)
                                <div class="mb-4">
                                    <label class="form-label">Grup Adı:</label>
                                    <input type="text" name="names[{{ $lang->id }}]"
                                        value="{{ $categoryLang->translate }}" class="form-control"
                                        placeholder="Category Adı">
                                    <input type="hidden" name="id[]" value="{{ $categoryLang->id }}">
                                </div>
                            @else
                                @if (count($langs) != count($categoryLangs))
                                    <div class="mb-4">
                                        <label class="form-label">Grup Adı:</label>
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
            <label for="">Şube Adı</label>

            <select name="branch_id" class="form-control" id="">

                @if (count($branchs) == 0)
                    <option value="0">Lütfen Şube Ekleyiniz</option>
                @else
                    @foreach ($branchs as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                @endif



            </select>
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

</x-back.master>
