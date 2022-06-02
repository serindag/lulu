<x-branch.master>
    @push('title') Limonist @endpush
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

    <div class="mb-4 mt-5">
        @if ($popupLangs == null)
            <h5>Popup Ekle</h5>
            <p>
                Bu bölümde açılır modal ekleyebilirsiniz.
            </p>
        @else
            <h5>Popup Güncelle</h5>
            <p>
                Bu bölümde yapılan açılır modalı düzenleyebilirsiniz.
            </p>

        @endif
        
    </div>



    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">

        @foreach ($langs as $lang)
            <li class="nav-item">
                <a class="nav-link @if ($lang->name == $langFirst->name) active @endif" data-bs-toggle="tab"
                    href="#panel-{{ $lang->name }}">{{ $lang->name }}</a>
            </li>
        @endforeach
    </ul>

    <form action="{{route('user.popup.save')}}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($popupLangs!=null)
            <input type="hidden" name="popup_id" value="{{ $popupLangs[0]->popup_id }}">
        @endif

        <div class="tab-content" id="myTabContent">

            @foreach ($langs as $lang)
                <div class="tab-pane fade @if ($lang->name == $langFirst->name) show active @endif"
                    id="panel-{{ $lang->name }}" role="tabpanel">

                    @if ($popupLangs == null)
                    
                        <div class="mb-4">
                            <label class="form-label">Popup içeriği:</label>
                                <textarea class="open-source-plugins" name="names[{{ $lang->id }}]"></textarea>
                        </div>
                    @else
                        @foreach ($popupLangs as $popupLang)
                            @if ($popupLang->lang_id == $lang->id)
                                
                                <div class="mb-4">
                                    <label class="form-label">Popup içeriği:</label>
                                    <textarea class="open-source-plugins" name="names[{{ $lang->id }}]">{!! $popupLang->translate !!}</textarea>
                                    <input type="hidden" name="id[]" value="{{ $popupLang->id }}">
                                </div>
                            @else
                                @if (count($langs) != count($popupLangs))
                                    <div class="mb-4">
                                        <label class="form-label">Grup Adı:</label>
                                        <textarea class="open-source-plugins" name="names[{{ $lang->id }}]">{{ old('description') }}</textarea>
                                       
                                        <input type="hidden" name="id[]" value="{{ $popupLang->id }}">
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
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Başlangıç Tarihi</label>
                        <input type="datetime-local" class="form-control" name="date_start">
                    </div>
                    <div class="col-md-6">
                        <label for="">Bitiş Tarihi</label>
                        <input type="datetime-local" class="form-control" name="date_end">
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <button type="submit" class="btn btn-success me-2 mb-2">
                @if ($popupLangs == null)
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
