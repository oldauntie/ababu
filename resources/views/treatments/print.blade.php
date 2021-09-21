@php
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
@endphp

<!DOCTYPE html>
<html>

<head>
</head>

<body>

    <table border="1" width="100%">
        <tr>
            <td>{!! $generator->getBarcode('0001245259636', $generator::TYPE_CODE_128) !!}</td>
            <td>{{ url()->current() }}</td>
            <td>
                <img class="backdrop" src="data:image/svg+xml;base64,{{ $qrCurrentUrl }}" width="71px">
            </td>
        </tr>
    </table>


    <h3>Product: 0001245259636</h3>
  

  
  
<h3>Product 2: 000005263635</h3>
@php
    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
@endphp
  
<img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('000005263635', $generatorPNG::TYPE_CODE_128)) }}">

    <div class="row justify-content-center">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
            nanna
        </div>
    </div>




    <h1>{{ $clinic->name }}</h1>

    @if($clinic->logo != null)
    <img src="{{ public_path('images') . DIRECTORY_SEPARATOR . $clinic->logo }}" style="width: 200px">
    @endif


    <img class="backdrop"
        src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path('images/no-image-available.svg'))) }}">
    <img class="backdrop"
        src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path('images/beacon.svg'))) }}">





    <h1>Welcome to my page - {{ $title }}</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</body>

</html>