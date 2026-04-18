<!-- BOOTSTRAP CSS -->
<link id="style" href="{{asset('assets/backend')}}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

<!-- STYLE CSS -->
<link href="{{asset('assets/backend')}}/css/style.css" rel="stylesheet" />
<link href="{{asset('assets/backend')}}/css/skin-modes.css" rel="stylesheet" />

<!--- FONT-ICONS CSS -->
<link href="{{asset('assets/backend')}}/css/icons.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlXzpF2nY8f6Z5WdZ/4VGeT+/JBVqjrQzSdeRhQxI8qJ6MYjqD9U89vZq4dUgkDzI1bpwYQqQ+P7Q21wZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!---flatpickr CSS -->
<link href="{{asset('assets/backend')}}/css/flatpickr.min.css" rel="stylesheet" />
<link href="{{asset('assets/backend')}}/css/nano.min.css" rel="stylesheet" />

<!-- INTERNAL SWITCHER CSS -->
<link href="{{asset('assets/backend')}}/switcher/css/switcher.css" rel="stylesheet" />
<link href="{{asset('assets/backend')}}/switcher/demo.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@stack('backend_style')
<style>
    @media (min-width: 992px) {
        .side-header {
            width: 270px !important;
            display: flex !important;
            padding: 7px 17px !important;
        }
    }
</style>
