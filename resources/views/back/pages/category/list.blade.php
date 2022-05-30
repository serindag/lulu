<x-back.master>
    <div class="mb-4 mt-5">
        <h5>Şube Yönetimi</h5>
        <p>
            Buradan şube ekleyebilir,silebilir ve grubu güncelleyebilirsiniz.
        </p>
    </div>

    <menu id="nestable-menu">
        <button type="button" data-action="expand-all">Expand All</button>
        <button type="button" data-action="collapse-all">Collapse All</button>
    </menu>

    <div class="cf nestable-lists">

        <div class="dd" id="nestable">
            <ol class="dd-list">
                @foreach($categories as $category)
                   
                  
                        <li class="dd-item" data-id="{{$category->id}}">
                            <div class="dd-handle">{{$category->name}}</div>
                    
                            @foreach($category->childreen as $child)
                                 <ol class="dd-list">
                                    <li class="dd-item" data-id="{{$child->id}}"><div class="dd-handle">{{$child->name}}</div>

                                  @foreach($child->childreen as $subchild) 
                                    <ol class="dd-list">
                                <li class="dd-item" data-id="{{$subchild->id}}"><div class="dd-handle">{{$subchild->name}}</div></li>
                               
                                </ol>

                                  @endforeach  
                                    
                                    
                                    
                                    </li>
                        
                        
                       
                                </ol>

                            @endforeach
                        </li>
                   
                   
                @endforeach

                
            </ol>
        </div>



    </div>


    <p><strong>Serialised Output (per list)</strong></p>

    <textarea id="nestable-output"></textarea>






    @push('newedit')
        <div class="d-flex align-items-center py-1">
            <!--begin::Button-->
            <a href="{{ route('admin.branch.saveform') }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i>
                Yeni Ekle</a>
            <!--end::Button-->
        </div>
    @endpush

    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="{{asset('dist/assets/css/nestable.css')}}">

    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.min.js"></script>
        <script>
            $(".deletebutton").click(function() {
                $.get("{{ isset($branch) ? route('admin.branch.delete', $branch->id) : '' }}",
                    function(data, status) {

                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        })

                        swalWithBootstrapButtons.fire({
                            title: 'Silinsin mi',
                            text: "Veri Kalıcı olarak silinecektir.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Evet, Sil',
                            cancelButtonText: 'İptal',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                swalWithBootstrapButtons.fire(
                                    'Silindi!',
                                    'Veri sildindi',
                                    'success'
                                );
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);

                            } else if (
                                /* Read more about handling dismissals below */
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                                swalWithBootstrapButtons.fire(
                                    'İptal',
                                    'Veri silme işlemi iptal edildi.',
                                    'error'
                                )
                            }
                        })

                    });

            })
        </script>


        <script src="{{ asset('dist') }}/assets/js/jquery-nestable.js"></script>
        <script>
           $(document).ready(function()
                {

                    var updateOutput = function(e)
                    {
                        var list   = e.length ? e : $(e.target),
                            output = list.data('output');



                            $.ajax({
                                url:"{{route('admin.category.order')}}",
                                headers:{'X-CSRF-TOKEN':'{{csrf_token()}}'},
                                method:"POST",
                                data:{
                                    data:list.nestable('serialize'),
                                },
                                success:function(data)
                                {
                                    console.log(data);
                                }
                            });



                        if (window.JSON) {
                            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                        } else {
                            output.val('JSON browser support required for this demo.');
                        }
                    };

                    // activate Nestable for list 1
                    $('#nestable').nestable({
                        group: 1
                    })
                    .on('change', updateOutput);




                    // output initial serialised data
                    updateOutput($('#nestable').data('output', $('#nestable-output')));


                    $('#nestable-menu').on('click', function(e)
                    {
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
    @endpush


</x-back.master>
