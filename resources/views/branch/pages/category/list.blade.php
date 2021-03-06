<x-branch.master>

    @push('title')
        Limonist
    @endpush
    @push('css')
        <link rel="stylesheet" href="{{ asset('dist/assets/css/nestable.css') }}">



        <style type="text/css">
            .status:hover {
                cursor: pointer;
            }

            .button {
                border: 1px solid #2996cc;
                padding: 4px;
                border-radius: 5px;

            }

            .edit>i {
                color: #2996cc
            }


            .cf:after {
                visibility: hidden;
                display: block;
                font-size: 0;
                content: " ";
                clear: both;
                height: 0;
            }

            * html .cf {
                zoom: 1;
            }

            *:first-child+html .cf {
                zoom: 1;
            }

            html {
                margin: 0;
                padding: 0;
            }

            body {
                font-size: 100%;
                margin: 0;
                padding: 1.75em;
                font-family: 'Helvetica Neue', Arial, sans-serif;
            }

            h1 {
                font-size: 1.75em;
                margin: 0 0 0.6em 0;
            }

            a {
                color: #2996cc;
            }

            a:hover {
                text-decoration: none;
            }

            p {
                line-height: 1.5em;
            }

            .small {
                color: #666;
                font-size: 0.875em;
            }

            .large {
                font-size: 1.25em;
            }

            /**
                   * Nestable
                   */

            .dd {
                position: relative;
                display: block;
                margin: 0;
                padding: 0;
                max-width: 100%;
                list-style: none;
                font-size: 13px;
                line-height: 20px;
            }

            .dd-list {
                display: block;
                position: relative;
                margin: 0;
                padding: 0;
                list-style: none;
            }

            .dd-list .dd-list {
                padding-left: 30px;
            }

            .dd-collapsed .dd-list {
                display: none;
            }

            .dd-item,
            .dd-empty,
            .dd-placeholder {
                display: block;
                position: relative;
                margin: 0;
                padding: 0;
                min-height: 20px;
                font-size: 13px;
                line-height: 20px;
            }

            .dd-handle {
                display: block;
                height: 30px;
                margin: 5px 0;
                padding: 5px 10px;
                color: #333;
                text-decoration: none;
                font-weight: bold;
                border: 1px solid #ccc;
                background: #fafafa;
                background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
                background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
                background: linear-gradient(top, #fafafa 0%, #eee 100%);
                -webkit-border-radius: 3px;
                border-radius: 3px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }

            .dd-handle:hover {
                color: #2ea8e5;
                background: #fff;
            }

            .dd-item>button {
                display: block;
                position: relative;
                cursor: pointer;
                float: left;
                width: 25px;
                height: 20px;
                margin: 5px 0;
                padding: 0;
                text-indent: 100%;
                white-space: nowrap;
                overflow: hidden;
                border: 0;
                background: transparent;
                font-size: 12px;
                line-height: 1;
                text-align: center;
                font-weight: bold;
            }

            .dd-item>button:before {
                content: '+';
                display: block;
                position: absolute;
                width: 100%;
                text-align: center;
                text-indent: 0;
            }

            .dd-item>button[data-action="collapse"]:before {
                content: '-';
            }

            .dd-placeholder,
            .dd-empty {
                margin: 5px 0;
                padding: 0;
                min-height: 30px;
                background: #f2fbff;
                border: 1px dashed #b6bcbf;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }

            .dd-empty {
                border: 1px dashed #bbb;
                min-height: 100px;
                background-color: #e5e5e5;
                background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                    -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
                background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
                background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                    linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
                background-size: 60px 60px;
                background-position: 0 0, 30px 30px;
            }

            .dd-dragel {
                position: absolute;
                pointer-events: none;
                z-index: 9999;
            }

            .dd-dragel>.dd-item .dd-handle {
                margin-top: 0;
            }

            .dd-dragel .dd-handle {
                -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
                box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
            }

            /**
                   * Nestable Extras
                   */

            .nestable-lists {
                display: block;
                clear: both;
                padding: 0px !important;
                width: 100%;
                border: 0;

            }

            #nestable-menu {
                padding: 0;
                margin: 20px 0;
            }

            #nestable-output {
                width: 100%;
                height: 7em;
                font-size: 0.75em;
                line-height: 1.333333em;
                font-family: Consolas, monospace;
                padding: 5px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }




            @media only screen and (min-width: 700px) {

                .dd {
                    float: left;
                    width: 100%;
                }

                .dd+.dd {
                    margin-left: 2%;
                }

            }

            .dd-hover>.dd-handle {
                background: #2ea8e5 !important;
            }

            /**
                   * Nestable Draggable Handles
                   */

            .dd3-content {
                display: block;
                height: 30px;
                margin: 5px 0;
                padding: 5px 10px 5px 40px;
                color: #333;
                text-decoration: none;
                font-weight: bold;
                border: 1px solid #ccc;
                background: #fafafa;
                background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
                background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
                background: linear-gradient(top, #fafafa 0%, #eee 100%);
                -webkit-border-radius: 3px;
                border-radius: 3px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }

            .dd3-content:hover {
                color: #2ea8e5;
                background: #fff;
            }

            .dd-dragel>.dd3-item>.dd3-content {
                margin: 0;
            }

            .dd3-item>button {
                margin-left: 30px;
            }

            .dd3-handle {
                position: absolute;
                margin: 0;
                left: 0;
                top: 0;
                cursor: pointer;
                width: 30px;
                text-indent: 100%;
                white-space: nowrap;
                overflow: hidden;
                border: 1px solid #aaa;
                background: #ddd;
                background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
                background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
                background: linear-gradient(top, #ddd 0%, #bbb 100%);
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
            }

            .dd3-handle:before {
                content: '???';
                display: block;
                position: absolute;
                left: 0;
                top: 3px;
                width: 100%;
                text-align: center;
                text-indent: 0;
                color: #fff;
                font-size: 20px;
                font-weight: normal;
            }

            .dd3-handle:hover {
                background: #ddd;
            }

            /**
                   * Socialite
                   */

            .socialite {
                display: block;
                float: left;
                height: 35px;
            }

        </style>
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    @endpush



    <menu id="nestable-menu">
        <button type="button" class="btn btn-success btn-sm" data-action="expand-all">T??m??n?? Geni??let</button>
        <button type="button" class="btn btn-danger btn-sm" data-action="collapse-all">T??m??n?? Daralt</button>
    </menu>

    <div class="cf nestable-lists">

        <div class="dd" id="nestable">
            <ol class="dd-list">
                @foreach ($categories as $category)
                    <li class="dd-item dd3-item" data-id="{{ $category->id }}">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">{{ $category->name }}



                            <span style="float:right;margin-left:5px">
                                <a class="button deletebutton"><i class="fa-solid fa-trash-can "></i></a>
                            </span>

                            <span style="float:right;margin-left:5px">
                                <a href="{{ route('user.category.saveform', $category->id) }}"
                                    class="button"><i class="fa-solid fa-pen-to-square"></i></a>
                            </span>
                            <span style="float:right;margin-left:5px">
                                <a href="{{ route('user.product.list', $category->id) }}" class="button"><i
                                        class="fa-solid fa-martini-glass"></i></a>
                            </span>

                            <span style="float:right;margin-left:5px">
                                <a category-id="{{ $category->id }}" class="button status">
                                    @if ($category->status > 0)
                                        Aktif
                                    @else
                                        Pasif
                                    @endif
                                </a>
                            </span>




                        </div>
                        @if (count($category->children) != 0)
                            <ol class="dd-list">

                                @foreach ($category->children as $child)
                                    <li class="dd-item dd3-item" data-id="{{ $child->id }}">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content">{{ $child->name }}

                                            <span style="float:right;margin-left:5px">
                                                <a href="" class="button"><i
                                                        class="fa-solid fa-trash-can "></i></a>
                                            </span>

                                            <span style="float:right;margin-left:5px">
                                                <a href="{{ route('user.category.saveform', $child->id) }}"
                                                    class="button"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </span>
                                            <span style="float:right;margin-left:5px">
                                                <a href="{{ route('user.product.list', $child->id) }}"
                                                    class="button"><i class="fa-solid fa-martini-glass"></i></a>
                                            </span>


                                            <span style="float:right;margin-left:5px">
                                                <a category-id="{{ $child->id }}" class="button status">
                                                    @if ($child->status > 0)
                                                        Aktif
                                                    @else
                                                        Pasif
                                                    @endif

                                                </a>
                                            </span>




                                        </div>
                                    </li>
                                @endforeach


                                <ol class="dd-list">



                                    @foreach ($child->children as $subchild)
                                        <li class="dd-item dd3-item" data-id="{{ $subchild->id }}">
                                            <div class="dd-handle dd3-handle"></div>
                                            <div class="dd3-content">{{ $subchild->name }}


                                                <span style="float:right;margin-left:5px">
                                                    <a href="" class="button"><i
                                                            class="fa-solid fa-trash-can "></i></a>
                                                </span>
                                                <span style="float:right;margin-left:5px">
                                                    <a href="{{ route('user.category.saveform', $subchild->id) }}"
                                                        class="button"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                </span>
                                                <span style="float:right;margin-left:5px">
                                                    <a href="{{ route('user.product.list', $subchild->id) }}"
                                                        class="button"><i
                                                            class="fa-solid fa-martini-glass"></i></a>
                                                </span>
                                                <span style="float:right;margin-left:5px">
                                                    <a category-id="{{ $subchild->id }}" class="button status">
                                                        @if ($child->status > 0)
                                                            Aktif
                                                        @else
                                                            Pasif
                                                        @endif
                                                    </a>
                                                </span>



                                            </div>
                                        </li>
                                    @endforeach



                                </ol>


                            </ol>
                        @endif
                    </li>
                @endforeach


            </ol>
        </div>


    </div>





    @push('js')
        <script src="{{ asset('dist/assets/js/jquery-nestable.js') }}"></script>

        <script>
            $(document).ready(function() {

                var updateOutput = function(e) {
                    var list = e.length ? e : $(e.target),
                        output = list.data('output');

                    $.ajax({
                        url: "{{ route('user.category.placement') }}",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        method: "POST",
                        data: {
                            data: list.nestable('serialize'),
                        },
                        success: function(data) {
                            console.log(data);
                        }
                    });



                    if (window.JSON) {
                        output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
                    } else {
                        output.val('JSON browser support required for this demo.');
                    }
                };

                // activate Nestable for list 1
                $('#nestable').nestable({
                        group: 1
                    })
                    .on('change', updateOutput);

                // activate Nestable for list 2


                // output initial serialised data
                updateOutput($('#nestable').data('output', $('#nestable-output')));



                $('#nestable-menu').on('click', function(e) {
                    var target = $(e.target),
                        action = target.data('action');
                    if (action === 'expand-all') {
                        $('.dd').nestable('expandAll');
                    }
                    if (action === 'collapse-all') {
                        $('.dd').nestable('collapseAll');
                    }
                });

                $('#nestable3').nestable();

            });
        </script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

        <script>
            $(".status").click(function() {
                id = $(this)[0].getAttribute('category-id');
                status_id = $(this).html();
                if (status_id.trim() == "Pasif") {

                    $(this).html('Aktif');

                }
                if (status_id.trim() == "Aktif") {

                    $(this).html("Pasif");

                };
                $.get("{{ route('user.category.status') }}", {
                    id: id
                }, function(data, status) {

                    console.log(data);
                });

            });
        </script>
        <script>
            $(".deletebutton").click(function() {


                if (confirm("Silinsin mi?") == true) {


                    $.get("{{ isset($category) ? route('user.category.delete', $category->id) : '' }}",
                        function(data, status) {
                            alert(data);
                            location.reload();

                        });

                } else {
                    alert('i??lem ??ptal Edildi');
                }


            })
        </script>
    @endpush

    @push('newedit')
        <div class="d-flex align-items-center py-1">
            <!--begin::Button-->
            <a href="{{ route('user.category.saveform') }}" class="btn btn-sm btn-primary"><i
                    class="fa-solid fa-plus"></i> Yeni Ekle</a>
            <!--end::Button-->
        </div>
    @endpush


</x-branch.master>
