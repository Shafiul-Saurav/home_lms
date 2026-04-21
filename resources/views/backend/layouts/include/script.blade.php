<!-- JQUERY JS -->
<script src="{{ asset('assets/backend') }}/js/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="{{ asset('assets/backend') }}/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- SIDE-MENU JS -->
<script src="{{ asset('assets/backend') }}/plugins/sidemenu/sidemenu.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="{{ asset('assets/backend') }}/plugins/p-scroll/perfect-scrollbar.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/p-scroll/pscroll.js"></script>

<!-- STICKY JS -->
<script src="{{ asset('assets/backend') }}/js/sticky.js"></script>

<!-- INTERNAL Summernote Editor js -->
<script src="{{ asset('assets/backend') }}/plugins/summernote-editor/summernote1.js"></script>
<script src="{{ asset('assets/backend') }}/js/summernote.js"></script>

<!-- WYSIWYG Editor JS -->
<script src="{{ asset('assets/backend') }}/plugins/wysiwyag/jquery.richtext.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/wysiwyag/wysiwyag.js"></script>

<!-- FORMEDITOR JS -->
<script src="{{ asset('assets/backend') }}/plugins/quill/quill.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/form-editor2.js"></script>

<!-- SELECT2 JS -->
<script src="{{ asset('assets/backend') }}/plugins/select2/select2.full.min.js"></script>

<!-- APEXCHART JS -->
<script src="{{ asset('assets/backend') }}/js/apexcharts.js"></script>

<!-- INTERNAL SELECT2 JS -->

{{-- <script src="{{asset('assets/backend')}}/plugins/select2/select2.full.min.js"></script> --}}

<!-- CHART-CIRCLE JS-->
<script src="{{ asset('assets/backend') }}/js/circle-progress.min.js"></script>

<!-- flatpickr JS-->
<script src="{{ asset('assets/backend') }}/js/flatpickr.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/pickr.es5.min.js"></script>

<!-- INTERNAL DATA-TABLES JS-->
<script src="{{ asset('assets/backend') }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/datatable/dataTables.responsive.min.js"></script>

{{-- <!-- FORM ELEMENTADVANCED JS -->
<script src="{{asset('assets/backend')}}/js/formelementadvnced.js"></script> --}}

<!-- INDEX JS -->
<script src="{{ asset('assets/backend') }}/js/index1.js"></script>

<!-- REPLY JS-->
<script src="{{ asset('assets/backend') }}/js/reply.js"></script>


<!-- COLOR THEME JS -->
<script src="{{ asset('assets/backend') }}/js/themeColors.js"></script>

<!-- CUSTOM JS -->
<script src="{{ asset('assets/backend') }}/js/custom.js"></script>

<!-- SWITCHER JS -->
<script src="{{ asset('assets/backend') }}/switcher/js/switcher.js"></script>

<!-- jQuery UI Date Picker js -->
<script src="https://laravelui.spruko.com/noa/assets/plugins/date-picker/jquery-ui.js"></script>
<!-- bootstrap-datepicker js (Date picker Style-01) -->
<script src="https://laravelui.spruko.com/noa/assets/plugins/bootstrap-datepicker/js/datepicker.js"></script>

<!-- DATEPICKER INITIALIZATION -->
<script>
    $(document).ready(function() {
        // Initialize jQuery UI Datepicker for fc-datepicker (only if not already initialized)
        window.initDatepicker = function() {
            if ($.fn.datepicker && $('.fc-datepicker').length > 0) {
                $('.fc-datepicker').each(function() {
                    // Skip if already has datepicker attached
                    if (!$(this).hasClass('hasDatepicker')) {
                        $(this).datepicker({
                            showOtherMonths: true,
                            selectOtherMonths: true,
                            dateFormat: 'dd/mm/yy',
                            changeMonth: true,
                            changeYear: true,
                            yearRange: '2020:2030'
                        });
                    }
                });
            }
        }

        window.initDatepicker();

        // Handle dynamic fields sync for datepicker
        $(document).on('change input', '.fc-datepicker', function() {
            var displayDate = $(this).val();
            if (displayDate) {
                var parts = displayDate.split('/');
                if (parts.length === 3) {
                    var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0];
                    $(this).siblings('input[type="hidden"]').val(formattedDate);
                }
            }
        });
    });
</script>

@stack('backend_script')
