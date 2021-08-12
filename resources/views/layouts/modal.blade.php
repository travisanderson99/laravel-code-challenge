@yield('content')

<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>

<!-- Page JS Helpers -->
<script>jQuery(function(){ One.helpers(['ckeditor', 'core-bootstrap-tooltip', 'datepicker', 'select2', 'masked-inputs']); });</script>