<script src="{{asset('backend/assets/js/vendors/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('backend/assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('backend/assets/js/vendors/select2.min.js')}}"></script>
<script src="{{asset('backend/assets/js/vendors/perfect-scrollbar.js')}}"></script>
<script src="{{asset('backend/assets/js/vendors/jquery.fullscreen.min.js')}}"></script>
<script src="{{asset('backend/assets/js/vendors/chart.js')}}"></script>
<!-- Main Script -->
<script src="{{asset('backend/assets/js/main.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/assets/js/custom-chart.js')}}" type="text/javascript"></script>
<!-- End Main Script -->

<!-- Datatable Script -->
<script src="{{asset('backend/assets/vendor/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/datatable/js/datatables.min.js')}}"></script>

<script src="{{asset('backend/assets/vendor/datatable-button/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/datatable-button/js/buttons.dataTables.js')}}"></script>
<script src="{{asset('backend/assets/vendor/datatable-pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/assets/vendor/datatable-pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/datatable-jszip/jszip.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/datatable-responsive/js/dataTables.responsive.min.js')}}"></script>
<!-- End Datatable Script -->
@stack('scripts')
<script>
    tinymce.init({
        selector: 'textarea',  // change this value according to your HTML
        plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
            'media', 'table', 'emoticons',
        ],
        a_plugin_option: true,
        a_configuration_option: 400,
        height: 200
    });
</script>
