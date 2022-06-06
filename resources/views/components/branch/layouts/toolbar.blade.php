<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->



            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">


                Anasayfa



                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                <!--end::Separator-->
                <!--begin::Description-->
                @if (Request::segment(1) == 'user' and !Request::segment(2))
                @endif
                @if (Request::segment(1) == 'user' and Request::segment(2) == 'user')
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Kullanıcı Bilgileri</small>
                @endif
                @if (Request::segment(1) == 'user' and Request::segment(2) == 'popup')
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Popup Yönetimi</small>
                @endif
                @if (Request::segment(1) == 'user' and Request::segment(2) == 'category')
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Havuz Veri Yönetimi</small>
                @endif
               
                @if (Request::segment(1) == 'user' and Request::segment(2) == 'feedback')
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Feedback Yönetimi</small>
                @endif
                @if (Request::segment(1) == 'user' and Request::segment(2) == 'product')
                <small class="text-muted fs-7 fw-bold my-1 ms-1">Ürünler</small>
                @endif
               

                <!--end::Description-->
            </h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->


        @stack('newedit')





    </div>
    <!--end::Container-->
</div>
