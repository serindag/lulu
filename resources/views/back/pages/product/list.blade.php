<x-back.master>
    @push('css')
    <link rel="stylesheet" href="sweetalert2.min.css">
    <style>
         .status:hover
            {
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
    </style>

    @endpush
    <div class="mb-4 mt-5">
        <h5>Grup Yönetimi</h5>
        <p>
            Buradan grup ekleyebilir,silebilir ve grubu güncelleyebilirsiniz.
        </p>
    </div>

    <table id="example" class="table table-striped example" style="width:100%">
        <thead>
            <tr>
                <th >İsim</th>
                <th>Açıklama</th>
                <th>Şube</th>
                <th>Kategori</th>
                <th>Durum</th>
                <th>İşlemler</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)

                    <tr>
                        <td > {{$product->name}} </td>
                        <td > {!!Str::limit($product->description,50,'...')!!} </td>
                        <td >@isset($product->branch->name) {{$product->branch->name}} @endisset</td>
                        <td >@isset($product->category->name) {{$product->category->name}} @endisset</td>
                        <td>
                            <span >
                                <a product-id="{{ $product->id }}" class="button status">
                                    @if($product->status>0)
                                Aktif
                             @else
                                 Pasif
                             @endif
                                </a>
                            </span>
                    </td>
                        <td>
                            <span >
                                <a href="{{ route('admin.product.saveform', $product->id) }}" class="button"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            </span>
                            <span >
                                <a  class="button deletebutton"><i
                                        class="fa-solid fa-trash-can "></i></a>
                            </span>
                            

                        </td>

                    </tr>

            @endforeach


        </tbody>

    </table>





    @push('newedit')
        <div class="d-flex align-items-center py-1">
            <!--begin::Button-->
            <a href="{{route('admin.product.saveform')}}" class="btn btn-sm btn-primary"><i
                    class="fa-solid fa-plus"></i> Yeni Ekle</a>
            <!--end::Button-->
        </div>
    @endpush



    @push('js')
        <script src="sweetalert2.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.example').DataTable();
            });
        </script>
        <script>
            $(".deletebutton").click(function() {
                $.get("{{ isset($product) ? route('admin.product.delete', $product->id) : '' }}",
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
        <script>
            $(".status").click(function(){
                id=$(this)[0].getAttribute('product-id');
                status_id=$(this).html();
                if(status_id.trim()=="Pasif")
                {

                    $(this).html('Aktif');

                }
                if(status_id.trim()=="Aktif")
                {

                    $(this).html("Pasif");

                };
                $.get("{{ route('admin.product.status') }}",{id:id},function(data,status){

                    console.log(data);
                });

            });


        </script>
    @endpush




</x-back.master>