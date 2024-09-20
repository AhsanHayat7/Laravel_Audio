<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>One Music - Modern Media </title>

    <!-- Favicon -->
    @include('layouts2.styles')

</head>
<body>
    @include('layouts2.header')
    @yield('content')

    @include('layouts2.footer')
    @include('layouts2.scritps')
</body>

</html>
