<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberBD - Cyber Security Course Bangladesh</title>

    @include('frontendone.layouts.include.style')

</head>

<body>

    <!-- Header Section -->
    @include('frontendone.layouts.include.header')

    <!-- Hero Image Slider Only -->
    @include('frontendone.layouts.include.hero-slider')

    @yield('frontendone_content')

    <!-- Footer -->
    @include('frontendone.layouts.include.footer')


    @include('frontendone.layouts.include.script')

</body>

</html>
