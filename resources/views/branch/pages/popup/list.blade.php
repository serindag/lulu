<x-branch.master>
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
        <h5>Popup Yönetimi</h5>
        <p>
            Bu bölümden anasayfa ve diğer kategorilerde açılacak açılır kapanır modallar oluşturabilir,silebilir ve
            güncelleyebilirsiniz.
        </p>
    </div>

    <table id="example" class="table table-striped example" style="width:100%">
        <thead>
            <tr>
                <th width="60%">İsim</th>
                <th>Şube</th>
                <th>Kategori</th>
                <th>Durum</th>
                <th>İşlemler</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($popups as $popup)
                <tr>
                    <td> {{ $popup->name }} </td>
                    <td>
                        @isset($popup->branch->name)
                            {{ $popup->branch->name }}
                        @endisset
                    </td>
                    <td>
                        @isset($popup->category->name)
                            {{ $popup->category->name }}
                        @endisset
                    </td>
                    <td>
                        <span>
                            <a popup-id="{{ $popup->id }}" class="button status">
                                @if ($popup->status > 0)
                                    Aktif
                                @else
                                    Pasif
                                @endif
                            </a>
                        </span>
                    </td>
                    <td>
                        <span>
                            <a href="{{ route('user.popup.saveform', $popup->id) }}" class="button"><i
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
            <a href="{{ route('user.popup.saveform') }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i>
                Yeni
                Ekle</a>
            <!--end::Button-->
        </div>
    @endpush

    @push('title')
        Limonist
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

                    $.get("{{ isset($popup) ? route('user.popup.delete', $popup->id) : '' }}",
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
                id = $(this)[0].getAttribute('popup-id');
                status_id = $(this).html();
                if (status_id.trim() == "Pasif") {

                    $(this).html('Aktif');

                }
                if (status_id.trim() == "Aktif") {

                    $(this).html("Pasif");

                };
                $.get("{{ route('user.popup.status') }}", {
                    id: id
                }, function(data, status) {

                    console.log(data);
                });

            });
        </script>
    @endpush




</x-branch.master>
