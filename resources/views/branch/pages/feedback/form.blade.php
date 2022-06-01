<x-branch.master>
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
            .card .card-header
            {
                min-height: 35px !important;
            }
            .card .card-footer
            {
                padding: 1rem 2.25rem;
            }
    </style>

    @endpush
    <div class="mb-4 mt-5">
        <!--begin::Input group-->
        
            <h5> Müşteri Yorumları</h5>
            <p>
                Bu bölümde şube yorumlarını inceleyebilirsiniz. 
            </p>

       
        </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2>Mesaj İçeriği</h2>
                
            </div>
            @if ($feedback->status==0)
                <form action="{{ route('user.feedback.save') }}" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{ $feedback->id }}">
            @endif
            
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <strong>İlgili Şube:</strong>
                        </div>
                        <div class="col-md-10">
                            {{ $feedback->branch->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <strong>Ad Soyad:</strong>
                        </div>
                        <div class="col-md-10">
                            {{ $feedback->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <strong>Mail Adresi:</strong>
                        </div>
                        <div class="col-md-10">
                            {{ $feedback->email }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <strong>Telefon:</strong>
                        </div>
                        <div class="col-md-10">
                            {{ $feedback->telephone }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <strong>Yorum:</strong>
                        </div>
                        <div class="col-md-10">
                            {{ $feedback->message }}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                
                        
                        <a href="{{ route('user.feedback.list') }}" class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i> İptal</a>
                        @if ($feedback->status==0)
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> İncelendi</button>
                        @endif
                    
                </div>
                @if ($feedback->status==0)
                    </form>
            @endif
            
        </div>
    </div>



</x-branch.master>
