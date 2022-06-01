<x-branch.master>
    
   
        @push('title')
            Limonist
        @endpush
        @push('css')
            <style>
                
    
                .menu-style
                {
                   
                   
                }
    
            </style>
        @endpush
       
    
            <div class="row mt-5">
                <div class="col-md-3 menu-style by-3">
                    <a href="{{route('user.user.form')}}">
                        <div class="text-center mb-3" ><i style="font-size: 50px" class="fa fa-user"></i>
                        </div>
                        <h3 class="text-center">Kullanıcı Bilgileri</h3>
                        <p class="text-center">Buradan kullanıcı bilgilerini güncelleyebilirsiniz...</p>
                        <div class="bg-cover light"></div>
                    </a>
                </div>
                <div class="col-md-3 menu-style by-3">
                    <a href="{{route('user.popup.list')}}">
                        <div class="text-center mb-3" ><i style="font-size: 50px" class="fa-solid fa-list-check"></i>
                        </div>
                        <h3 class="text-center">Popup Yönetimi</h3>
                        <p class="text-center">Buradan anasayfada ve diğer sayfalara açılır koyabilirisiniz.</p>
                        <div class="bg-cover light"></div>
                    </a>
                </div>
                <div class="col-md-3 menu-style by-3">
                    <a href="{{route('user.category.list')}}">
                        <div class="text-center mb-3" ><i style="font-size: 50px" class="fa-solid fa-database"></i>
                        </div>
                        <h3 class="text-center">Havuz Veri Yönetimi</h3>
                        <p class="text-center">Buradan kategori ve ürün ekleyebilirsiniz.</p>
                        <div class="bg-cover light"></div>
                    </a>
                </div>
                
                
                
                <div class="col-md-3 menu-style by-3">
                    <a href="{{route('user.feedback.list')}}">
                        <div class="text-center mb-3" ><i style="font-size: 50px" class="fa-solid fa-comment-dots"></i>
                        </div>
                        <h3 class="text-center">Feedback Yönetimi</h3>
                        <p class="text-center">Buradan gelen yorumlara bakabilirsiniz.</p>
                        <div class="bg-cover light"></div>
                    </a>
                </div>
                <div class="col-md-3 menu-style by-3">
                    <a href="admin/user_infos">
                        <div class="text-center mb-3" ><i style="font-size: 50px" class="fa-solid fa-file-export"></i>
                        </div>
                        <h3 class="text-center">Dışa Aktar</h3>
                        <p class="text-center">Buradan veri tabanının yedeğini alabilirsiniz.</p>
                        <div class="bg-cover light"></div>
                    </a>
                </div>
                <div class="col-md-3 menu-style by-3">
                    <a href="{{route('user.logout')}}">
                        <div class="text-center mb-3" ><i style="font-size: 50px" class="fa-solid fa-right-from-bracket"></i>
                        </div>
                        <h3 class="text-center">Oturum Kapatma</h3>
                        <p class="text-center">Buradan oturumunuzu kapatabilirsiniz.</p>
                        <div class="bg-cover light"></div>
                    </a>
                </div>
               
    
            </div>

   
    
</x-branch.master>
