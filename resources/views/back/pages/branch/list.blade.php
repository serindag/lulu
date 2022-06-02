<x-back.master>
    @push('title')
        Limonist
    @endpush

    @push('css')
        <link rel="stylesheet" href="sweetalert2.min.css">
        <style>
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

        </style>
    @endpush

    <div class="mb-4 mt-5">
        <h5>Şube Yönetimi</h5>
        <p>
            Buradan şube ekleyebilir,silebilir ve grubu güncelleyebilirsiniz.
        </p>
    </div>

    <table id="example" class="table table-striped example" style="width:100%">
        <thead>
            <tr>
                <th width="50%">Şube Adı</th>
                <th>Şehir</th>
                <th width="20%">Telefon</th>
                <th width="20%">Durum</th>
                <th>İşlemler</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($branchs as $branch)
                <tr>
                    <td width="50%">{{ $branch->name }}</td>
                    <td>{{ $branch->city }}</td>
                    <td>{{ $branch->telephone }}</td>
                    <td>
                        <span>
                            <a branch-id="{{ $branch->id }}" status-id="{{ $branch->status }}"
                                class="button status">
                                @if ($branch->status > 0)
                                    Aktif
                                @else
                                    Pasif
                                @endif
                            </a>
                        </span>
                    </td>
                    <td>

                        <span>
                            <a href="{{ route('admin.branch.saveform', $branch->id) }}" class="button"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </span>

                        <span>
                            <a class="button deletebutton"><i class="fa-solid fa-trash-can "></i></a>
                        </span>




                    </td>
                </tr>
            @endforeach


        </tbody>

    </table>


    @push('newedit')
        <div class="d-flex align-items-center py-1">
            <!--begin::Button-->
            <a href="{{ route('admin.branch.saveform') }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i>
                Yeni Ekle</a>
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


                if (confirm("Silinsin mi?") == true) {


                    $.get("{{ isset($branch) ? route('admin.branch.delete', $branch->id) : '' }}",
                        function(data, status) {
                            alert(data);
                            location.reload();


                        });

                } else {
                    alert('işlem İptal Edildi');
                }

            })
        </script>




        <script>
            $(".status").click(function() {

                id = $(this)[0].getAttribute('branch-id');
                status_id = $(this).html();
                if (status_id.trim() == "Pasif") {

                    $(this).html('Aktif');

                }
                if (status_id.trim() == "Aktif") {

                    $(this).html("Pasif");

                };
                $.get("{{ route('admin.branch.status') }}", {
                    id: id
                }, function(data, status) {


                    console.log(data);
                });

            });
        </script>
    @endpush


</x-back.master>
