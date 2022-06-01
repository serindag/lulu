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
                <th>Şube</th>
                <th>Ad Soyad</th>
                <th>E-mail</th>
                <th>Telefon</th>
                <th>Mesaj</th>
                <th>Durum</th>
                <th>Görüntüle</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->branch->name }} </td>
                    <td>{{ $feedback->name }}</td>
                    <td>{{ $feedback->email }}</td>
                    <td>{{ $feedback->telephone }}</td>
                    <td>{{ $feedback->message }}</td>
                    <td>
                        @if ($feedback->id==0)
                        Okunmadı
                        @else
                        Okundu
                        @endif
                </td>
                    <td><a class="button" href="{{ route('admin.feedback.saveform', $feedback->id) }}"><i class="fa-solid fa-eye"></i></a></td>

                </tr>
                
            @endforeach
                    

           


        </tbody>

    </table>


    @push('newedit')
        <div class="d-flex align-items-center py-1">
            <!--begin::Button-->
            <a href="" class="btn btn-sm btn-primary"><i
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
      
        
    @endpush




</x-back.master>
