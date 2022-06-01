<x-back.master>
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
                <a href="{{route('admin.user.form')}}">
                    <div class="text-center mb-3" ><i style="font-size: 50px" class="fa fa-user"></i>
                    </div>
                    <h3 class="text-center">Kullanıcı Bilgileri</h3>
                    <p class="text-center">Buradan kullanıcı bilgilerini güncelleyebilirsiniz...</p>
                    <div class="bg-cover light"></div>
                </a>
            </div>
            <div class="col-md-3 menu-style by-3">
                <a href="{{route('admin.popup.list')}}">
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
                <a href="{{route('admin.branchGroup.list')}}">
                    <div class="text-center mb-3" ><i style="font-size: 50px" class="fa-solid fa-people-roof"></i>
                    </div>
                    <h3 class="text-center">Grup Yönetimi</h3>
                    <p class="text-center">Buradan grup ekleyebilirsiniz.</p>
                    <div class="bg-cover light"></div>
                </a>
            </div>
            <div class="col-md-3 menu-style by-3">
                <a href="{{route('admin.branch.list')}}">
                    <div class="text-center mb-3" ><i style="font-size: 50px" class="fa-solid fa-code-branch"></i>
                    </div>
                    <h3 class="text-center">Şube Yönetimi</h3>
                    <p class="text-center">Buradan şube ekleyebilirsiniz.</p>
                    <div class="bg-cover light"></div>
                </a>
            </div>
            <div class="col-md-3 menu-style by-3">
                <a href="{{route('admin.branchUser.list')}}">
                    <div class="text-center mb-3" ><i style="font-size: 50px" class="fa-solid fa-people-carry-box"></i>
                    </div>
                    <h3 class="text-center">Şube Yöneticisi Ekle</h3>
                    <p class="text-center">Buradan şubelere yönetici ekleyebilirsiniz.</p>
                    <div class="bg-cover light"></div>
                </a>
            </div>
            <div class="col-md-3 menu-style by-3">
                <a href="{{route('admin.feedback.list')}}">
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
        






    

</x-back.master>
