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
            <td>{{ route('clinics.visits.show', ['clinic' => 1, 'pet' => 1]) }}</td>
            <td>
                <img class="backdrop" src="data:image/svg+xml;base64,{{ $qrCurrentUrl }}" width="71px">
            </td>
        </tr>
    </table>
</body>

</html>