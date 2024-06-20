<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.11/dist/sweetalert2.all.min.js"></script>
<script src="{{asset('assets/backend')}}/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/backend')}}/js/dataTables.bootstrap5.js"></script>
<script src="{{asset('assets/backend')}}/js/dataTables.buttons.min.js"></script>
<script src="{{asset('assets/backend')}}/js/buttons.bootstrap5.min.js"></script>
<script src="{{asset('assets/backend')}}/js/jszip.min.js"></script>
<script src="{{asset('assets/backend')}}/js/pdfmake.min.js"></script>
<script src="{{asset('assets/backend')}}/js/vfs_fonts.js"></script>
<script src="{{asset('assets/backend')}}/js/buttons.html5.min.js"></script>
<script src="{{asset('assets/backend')}}/js/buttons.print.min.js"></script>
<script src="{{asset('assets/backend')}}/js/buttons.colVis.min.js"></script>
<script src="{{asset('assets/backend')}}/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets/backend')}}/js/responsive.bootstrap5.min.js"></script>
<script src="{{asset('assets/backend')}}/js/table-data.js"></script>
<script src="{{asset('assets/backend')}}/js/fileupload.js"></script>
<script src="{{asset('assets/backend')}}/js/file-upload.js"></script>
<script>
    $('.show_confirm').click(function(event){
            let form = $(this).closest('form');

            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                })
        })
</script>
<script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
    }
            toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
</script>
