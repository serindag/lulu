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
        <h5>Şube Kullancı Yönetimi</h5>
        <p>
            Buradan şube kullanıcıları ekleyebilir,silebilir ve güncelleyebilirsiniz.
        </p>
    </div>

    <table id="example" class="table table-striped example" style="width:100%">
        <thead>
            <tr>
                <th>Kullancı Adı</th>
                <th>E-mail</th>
                <th>Şube</th>
                <th>Şehir</th>
                <th>Durum</th>
                <th>İşlemler</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @isset($user->branch->name)
                            {{ $user->branch->name }}
                        @endisset
                    </td>
                    <td>
                        @isset($user->branch->city)
                            {{ $user->branch->city }}
                        @endisset
                    </td>
                    <td>
                        <span>
                            <a user-id="{{ $user->id }}" class="button status">
                                @if ($user->status > 0)
                                    Aktif
                                @else
                                    Pasif
                                @endif
                            </a>
                        </span>

                    </td>
                    <td>


                        <span class="me-1">
                            <a href="{{ route('admin.branchUser.saveform', $user->id) }}" class="button"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </span>

                        <span class="me-1">
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
            <a href="{{ route('admin.branchUser.saveform') }}" class="btn btn-sm btn-primary"><i
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


                if (confirm("Silinsin mi?") == true) {


                    $.get("{{ isset($user) ? route('admin.branchUser.delete', $user->id) : '' }}",
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

                id = $(this)[0].getAttribute('user-id');
                status_id = $(this).html();
                if (status_id.trim() == "Pasif") {

                    $(this).html('Aktif');

                }
                if (status_id.trim() == "Aktif") {

                    $(this).html("Pasif");

                };
                $.get("{{ route('admin.branchUser.status') }}", {
                    id: id
                }, function(data, status) {


                    console.log(data);
                });

            });
        </script>
    @endpush


</x-back.master>
