

        <script src="{{ asset('dist') }}/assets/plugins/global/plugins.bundle.js"></script>
        <script src="{{ asset('dist') }}/assets/js/scripts.bundle.js"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Page Vendors Javascript(used by this page)-->
        <script src="{{ asset('dist') }}/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
        <script src="{{ asset('dist') }}/assets/plugins/custom/datatables/datatables.bundle.js"></script>
        <!--end::Page Vendors Javascript-->
        <!--begin::Page Custom Javascript(used by this page)-->
        <script src="{{ asset('dist') }}/assets/js/custom/documentation/documentation.js"></script>
        <script src="{{ asset('dist') }}/assets/js/custom/documentation/search.js"></script>
        <script src="{{ asset('dist') }}/assets/js/custom/documentation/general/datatables/buttons.js"></script>
    
    
    @stack('js')
    



