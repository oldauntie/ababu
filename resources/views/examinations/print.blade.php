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
            <td>{!! $generator->getBarcode($examination->id, $generator::TYPE_CODE_128) !!}</td>
            <td>{{ route('clinics.visits.show', ['clinic' => $clinic->id, 'pet' => $pet->id]) }}</td>
            <td>
                <img class="backdrop" src="data:image/svg+xml;base64,{{ $qrCurrentUrl }}" width="71px">
            </td>
        </tr>
    </table>



    <div class="row">
        <table class="w50 float-left">
            <tr>
                <td class="border-bottom uppercase bold">{{ __('translate.examination') }}</td>
                <td class="border-bottom bold">{{ $examination->id }} </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.date') }}</td>
                <td>{{ $examination->created_at }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.note') }}</td>
                <td>{{ $examination->print_notes?$examination->notes:"" }}</td>
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
                <td>{{ $pet->owner->lastname . ", " . $pet->owner->firstname }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.address') . ", " . __('translate.firstname') }}</td>
                <td>{{ $pet->owner->address . ", " . $pet->owner->postcode . ", " . $pet->owner->city }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.ssn') }}</td>
                <td>{{ $pet->owner->ssn }}</td>
            </tr>
        </table>

        <table class="w50 float-left">
            <tr>
                <td class="border-bottom uppercase bold">{{ __('translate.clinic') }}</td>
                <td class="border-bottom"></td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.name') }}</td>
                <td class="uppercase">{{ $pet->clinic->name }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.manager') }}</td>
                <td class="uppercase">{{ $pet->clinic->manager }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.phone') }}</td>
                <td class="uppercase">{{ $pet->clinic->phone }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.code') }}</td>
                <td class="uppercase">{{ $pet->clinic->code }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.address') }}</td>
                <td class="uppercase">{{ $pet->clinic->address }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.city') }}</td>
                <td class="uppercase">{{ $pet->clinic->city }}</td>
            </tr>
        </table>
    </div>


    <div class="row">
        <table class="w100 float-left border">
            <tr>
                <td colspan="5" class="border-bottom uppercase bold">{{ __('translate.examination') }}</td>
            </tr>
            <tr>
                <td colspan="5" class="border-bottom">id: {{ $examination->id }} {!! $generator->getBarcode($examination->id, $generator::TYPE_CODE_128) !!}</td>
            </tr>
            <tr>
                <td class="border bold">{{ __('translate.examination') }}</td>
                <td class="border bold">{{ __('translate.result') }}</td>
                <td class="border bold">{{ __('translate.medical_report') }}</td>
                <td class="border bold">{{ __('translate.is_pathologic') }}</td>
                <td class="border bold">{{ __('translate.in_evidence') }}</td>
            </tr>
            <tr>
                <td class="border">{{ $examination->diagnosticTest->term_name }}</td>
                <td class="border">{{ $examination->result }}</td>
                <td class="border">{{ $examination->medical_report }}</td>
                <td class="border">{{ $examination->is_pathologic==true ? __('translate.yes') : __('translate.no') }}</td>
                <td class="border">{{ $examination->in_evidence==true ? __('translate.yes') : __('translate.no')  }}</td>
            </tr>
        </table>
    </div>

    <div class="row">
        @if ($examination->print_notes == true)
        <table class="w100 float-left border">
            <tr>
                <td class="border bold">{{ __('translate.notes') }}</td>
            </tr>
            <tr>
                <td class="border">{{ $examination->notes }}</td>
            </tr>
        </table>
        @endif
    </div>
</body>
</html>