@php
$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
@endphp

<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
</head>

<body>

    <table border="0" width="100%">
        <tr class="border-bottom">
            <td>{!! $generator->getBarcode($prescription->id, $generator::TYPE_CODE_128) !!}</td>
            <td>{{ route('clinics.visits.show', ['clinic' => 1, 'pet' => 1]) }}</td>
            <td>
                <img class="backdrop" src="data:image/svg+xml;base64,{{ $qrCurrentUrl }}" width="71px">
            </td>
        </tr>
    </table>



    <div class="row">
        <table class="w50 float-left">
            <tr>
                <td class="border-bottom uppercase bold">{{ __('translate.prescription') }}</td>
                <td class="border-bottom bold">{{ $prescription->id }} </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.date') }}</td>
                <td>{{ $prescription->created_at }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.note') }}</td>
                <td>{{ $prescription->print_notes?$prescription->notes:"" }}</td>
            </tr>
        </table>

        <table class="w50 float-left">
            <tr>
                <td class="border-bottom uppercase bold">{{ __('translate.veterinary') }}</td>
                <td class="border-bottom"></td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.lastname') . ", " . __('translate.firstname') }}</td>
                <td class="uppercase">{{ Auth::user()->name . ", " . Auth::user()->name }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.ssn') }}</td>
                <td class="uppercase">{{ Auth::user()->ssn }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.registration') }}</td>
                <td class="uppercase">{{ Auth::user()->registration }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.phone') }}</td>
                <td class="uppercase">{{ Auth::user()->phone }}</td>
            </tr>
        </table>
    </div>
    <div class="row">
        <table class="w50 float-left">
            <tr>
                <td class="border-bottom uppercase bold">{{ __('translate.owner') }}</td>
                <td class="border-bottom"></td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.lastname') . ", " . __('translate.firstname') }}</td>
                <td>{{ $prescription->created_at }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.ssn') }}</td>
                <td>{{ $prescription->notes }}</td>
            </tr>
        </table>

        <table class="w50 float-left">
            <tr>
                <td class="border-bottom uppercase bold">{{ __('translate.clinic') }}</td>
                <td class="border-bottom"></td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.name') }}</td>
                <td class="uppercase">{{ Auth::user()->name . ", " . Auth::user()->name }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.ssn') }}</td>
                <td class="uppercase">{{ Auth::user()->ssn }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.registration') }}</td>
                <td class="uppercase">{{ Auth::user()->registration }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.phone') }}</td>
                <td class="uppercase">{{ Auth::user()->phone }}</td>
            </tr>
        </table>
    </div>
    



</body>

</html>