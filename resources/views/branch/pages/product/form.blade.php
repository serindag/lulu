<x-branch.master>
    @push('title')
        Limonist
    @endpush
    @push('css')
        <style>
            .tox.tox-tinymce.tox-tinymce--toolbar-sticky-off {
                height: 300px !important;
            }

        </style>
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

    <form action="{{ route('user.product.save') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if ($productLangs != null)
            <input type="hidden" name="product_id" value="{{ $productLangs[0]->product_id }}">
        @endif

        <div class="tab-content" id="myTabContent">

            @foreach ($langs as $lang)
                <div class="tab-pane fade @if ($lang->name == $langFirst->name) show active @endif"
                    id="panel-{{ $lang->name }}" role="tabpanel">

                    @if ($productLangs == null)
                        <div class="mb-4">
                            <label class="form-label">Ürün Adı:</label>
                            <input type="text" name="names[{{ $lang->id }}]" class="form-control" />

                        </div>

                        <div class="mb-4">
                            <label class="form-label">Ürün içeriği:</label>
                            <textarea class="open-source-plugins" name="descriptions[{{ $lang->id }}]"></textarea>
                        </div>
                    @else
                        @foreach ($productLangs as $productLang)
                            @if ($productLang->lang_id == $lang->id)
                                <div class="mb-4">
                                    <label class="form-label">Ürün Adı:</label>
                                    <input type="text" name="names[{{ $lang->id }}]"
                                        value="{{ $productLang->translate_name }}" class="form-control" />

                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Ürün İçeriği:</label>
                                    <textarea class="open-source-plugins" name="descriptions[{{ $lang->id }}]">{!! $productLang->translate_description !!}</textarea>
                                    <input type="hidden" name="id[]" value="{{ $productLang->id }}">
                                </div>
                            @else
                                @if (count($langs) != count($productLangs))
                                    <div class="mb-4">
                                        <label class="form-label">Ürün Adı:</label>
                                        <input type="text" name="names[{{ $lang->id }}]" class="form-control" />

                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Ürün İçeriği:</label>
                                        <textarea class="open-source-plugins" name="descriptions[{{ $lang->id }}]">{{ old('description') }}</textarea>

                                        <input type="hidden" name="id[]" value="{{ $productLang->id }}">
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif

                </div>
            @endforeach


            <div class="mb-4">
                <label class="form-label">Görünlecek Yer:</label>
                <select name="category_id" id="" class="form-control">
                    <option value="">Kategori Seçiniz</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="mb-4">
                <label class="form-label">Fiyat:</label>
                <input type="text" class="form-control" name="price"
                    value="@isset($product) {{ $product->price }} @endisset">
            </div>
            <div class="mb-4">
                <label class="form-label">Resim:</label>
                <img style="width: 200px"
                    src="@isset($product->image) {{ asset($product->image) }} @endisset" alt=""
                    class="img-thumbnail rounded img-fluid">
                <input type="file" class="form-control" name="image" value="">
            </div>

        </div>
        <div class="row">
            <button type="submit" class="btn btn-success me-2 mb-2">
                @if ($productLangs == null)
                    Kaydet
                @else
                    Güncelle
                @endif
            </button>
        </div>

    </form>


    @push('js')
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

            tinymce.init({
                selector: 'textarea.open-source-plugins',
                plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                imagetools_cors_hosts: ['picsum.photos'],
                menubar: 'file edit view insert format tools table help',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                toolbar_sticky: true,
                autosave_ask_before_unload: true,
                autosave_interval: '30s',
                autosave_prefix: '{path}{query}-{id}-',
                autosave_restore_when_empty: false,
                autosave_retention: '2m',
                image_advtab: true,

                importcss_append: true,

                templates: [{
                        title: 'New Table',
                        description: 'creates a new table',
                        content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                    },
                    {
                        title: 'Starting my story',
                        description: 'A cure for writers block',
                        content: 'Once upon a time...'
                    },
                    {
                        title: 'New list with dates',
                        description: 'New List with dates',
                        content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                    }
                ],
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                height: 100,
                image_caption: true,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                noneditable_noneditable_class: 'mceNonEditable',
                toolbar_mode: 'sliding',
                contextmenu: 'link image imagetools table',
                skin: useDarkMode ? 'oxide-dark' : 'oxide',
                content_css: useDarkMode ? 'dark' : 'default',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });
        </script>
    @endpush




</x-branch.master>
