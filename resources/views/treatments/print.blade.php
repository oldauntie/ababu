<!DOCTYPE html>
<html>

<head>



</head>

<body>
    <h1>{{ $clinic->name }}</h1>

    @if($clinic->logo != null)
    <img src="{{ public_path('images') . DIRECTORY_SEPARATOR . $clinic->logo }}" style="width: 200px">
    @endif


    <img class="backdrop" src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path('images/no-image-available.svg'))) }}">
    <img class="backdrop" src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path('images/beacon.svg'))) }}">

    <img src="http://dev.ababu.cloud/images/no-image-available.svg" />




    <h1>Welcome to my page - {{ $title }}</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</body>

</html>