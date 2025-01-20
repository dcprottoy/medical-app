<script src="{{asset('backend/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('backend/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('backend/adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- Moment App -->
<script src="{{asset('backend/adminlte/plugins/moment/moment.min.js')}}"></script>
<!-- Calender App -->
<script src="{{asset('backend/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('backend/adminlte/plugins/toastr/toastr.min.js')}}"></script>
<script>
    @if(session('success'))
        toastr.success('{{session('success')}}')
    @elseif(session('info'))
        toastr.info('{{session('info')}}')
    @elseif(session('warning'))
        toastr.warning('{{session('warning')}}')
    @elseif(session('error'))
        toastr.error('{{session('error')}}')
    @endif
</script>
@stack('scripts')
</body>
</html>
