<x-back.master>
    @push('title') Limonist @endpush
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
                <th width="80%">İsim</th>
                <th>Durum</th>
                <th>İşlemler</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($branchGroups as $branchGroup)

                    <tr>
                        <td >{{ $branchGroup->name }}</td>
                        <td>
                            <span>
                                <a group-id="{{ $branchGroup->id }}" class="button status">
                                    @if($branchGroup->status>0)
                                Aktif
                             @else
                                 Pasif
                             @endif
                                </a>
                            </span>
                        </td>
                        <td>
                            <span>
                                <a href="{{ route('admin.branchGroup.saveform', $branchGroup->id) }}" class="button"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            </span>
                            <span>
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
            <a href="{{ route('admin.branchGroup.saveform') }}" class="btn btn-sm btn-primary"><i
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
                $.get("{{ isset($branchGroup) ? route('admin.branchGroup.delete', $branchGroup->id) : '' }}",
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
        <script>
            $(".status").click(function(){
                id=$(this)[0].getAttribute('group-id');
                status_id=$(this).html();
                if(status_id.trim()=="Pasif")
                {

                    $(this).html('Aktif');

                }
                if(status_id.trim()=="Aktif")
                {

                    $(this).html("Pasif");

                };
                $.get("{{ route('admin.branchGroup.status') }}",{id:id},function(data,status){

                    console.log(data);
                });

            });


        </script>
    @endpush




</x-back.master>
