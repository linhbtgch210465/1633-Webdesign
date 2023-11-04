<!DOCTYPE html>
<html lang="en">

<head>
    @include('viewhead')
</head>

<body>
    {{-- <-!--class="animsition"--> --}}

    <!-- Header -->
    @include('header')

    <!-- Cart -->
    @include('viewcart')
    <div class="container">
        @yield('content')
    </div>

    @include('footer')

</body>

</html>
