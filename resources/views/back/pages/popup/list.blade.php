<x-back.master>

    @push('css')
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

    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">

        @foreach ($langs as $lang)
            <li class="nav-item">
                <a class="nav-link @if($lang->name==$langFirst->name) active @endif" data-bs-toggle="tab" href="#panel-{{ $lang->name }}">{{ $lang->name }}</a>
            </li>
        @endforeach
    </ul>

    <form action="">
        <div class="tab-content" id="myTabContent">
                @foreach ($langs as $lang)


                        <div class="tab-pane fade @if($lang->name==$langFirst->name) show active @endif" id="panel-{{ $lang->name }}" role="tabpanel">

                            <div class="card card-p-0 card-flush">
                                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                 <div class="card-title">
                                  <!--begin::Search-->
                                  <div class="d-flex align-items-center position-relative my-1">
                                   <span class="svg-icon svg-icon-1 position-absolute ms-4"></span>
                                   <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Popup Ara" />
                                  </div>
                                  <!--end::Search-->
                                  <!--begin::Export buttons-->
                                  <div id="kt_datatable_example_1_export" class="d-none"></div>
                                  <!--end::Export buttons-->
                                 </div>
                                 <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                  <!--begin::Export dropdown-->
                                  <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                  <span class="svg-icon svg-icon-1 position-absolute ms-4"></span>
                                   Dışa Aktar
                                  </button>
                                  <!--begin::Menu-->
                                  <div id="kt_datatable_example_1_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
                                   <!--begin::Menu item-->
                                   <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="copy">
                                    Verileri kopyala
                                    </a>
                                   </div>
                                   <!--end::Menu item-->
                                   <!--begin::Menu item-->
                                   <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="excel">
                                    Excel olarak aktar
                                    </a>
                                   </div>
                                   <!--end::Menu item-->
                                   <!--begin::Menu item-->
                                   <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="csv">
                                     CSV olarak aktar
                                    </a>
                                   </div>
                                   <!--end::Menu item-->
                                   <!--begin::Menu item-->
                                   <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="pdf">
                                    PDF olarak aktar
                                    </a>
                                   </div>
                                   <!--end::Menu item-->
                                  </div>
                                  <!--end::Menu-->
                                  <!--end::Export dropdown-->
                                 </div>
                                </div>
                                <div class="card-body">
                                 <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example_1">
                                  <thead>
                                   <!--begin::Table row-->
                                   <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase">
                                    <th class="min-w-100px">İçerik</th>
                                    <th class="min-w-100px">İşlemler</th>

                                   </tr>
                                   <!--end::Table row-->
                                  </thead>
                                  <tbody class="fw-bold text-gray-600">

                                @foreach ($popups as $popup)
                                    @if($popup->lang_id==$lang->id)

                                        <tr class="odd">
                                            <td width="85%">
                                                {{ $popup->description }}
                                            </td>

                                            <td class="text-end" width="15%">
                                                <span style="float:right;margin-left:5px">
                                                    <a href="" class="button"><i
                                                            class="fa-solid fa-trash-can "></i></a>
                                                </span>
                                                <span style="float:right;margin-left:5px">
                                                    <a href="" class="button"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                </span>

                                                <span  style="float:right;margin-left:5px">
                                                    <a category-id="" class="button status">
                                                        Aktif
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>

                                    @endif
                                @endforeach
                                  </tbody>
                                 </table>
                                </div>
                               </div>




                        </div>



                @endforeach
        </div>


    </form>

</x-back.master>




