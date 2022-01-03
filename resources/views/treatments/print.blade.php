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
            <td>{!! $generator->getBarcode($treatment->id, $generator::TYPE_CODE_128) !!}</td>
            <td>{{ route('clinics.visits.show', ['clinic' => $clinic->id, 'pet' => $pet->id]) }}</td>
            <td>
                <img class="backdrop" src="data:image/svg+xml;base64,{{ $qrCurrentUrl }}" width="71px">
            </td>
        </tr>
    </table>



    <div class="row">
        <table class="w50 float-left">
            <tr>
                <td class="border-bottom uppercase bold">{{ __('translate.prescription') }}</td>
                <td class="border-bottom bold">{{ $treatment->id }} </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.date') }}</td>
                <td>{{ $treatment->created_at }}</td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.note') }}</td>
                <td>{{ $treatment->print_notes?$prescription->notes:"" }}</td>
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
                <td colspan="7" class="border-bottom uppercase bold">{{ __('translate.treatment') }}</td>
            </tr>
            <tr>
                <td colspan="7" class="border-bottom">id: {{ $treatment->id }} {!! $generator->getBarcode($treatment->id, $generator::TYPE_CODE_128) !!}</td>
            </tr>
            <tr>
                <td class="border bold">{{ __('translate.procedure') }}</td>
                <td class="border bold">{{ __('translate.executed_at') }}</td>
                <td class="border bold">{{ __('translate.recall_at') }}</td>
                <td class="border bold">{{ __('translate.drug_batch') }}</td>
                <td class="border bold">{{ __('translate.expires_at') }}</td>
                <td class="border bold">{{ __('translate.notes') }}</td>
            </tr>
            <tr>
                <td class="border">{{ $treatment->procedure->term_name }}</td>
                <td class="border">{{ $treatment->executed_at }}</td>
                <td class="border">{{ $treatment->recall_at }}</td>
                <td class="border">{{ $treatment->drug_batch }}</td>
                <td class="border">{{ $treatment->drug_batch_expires_at }}</td>
                <td class="border">{{ $treatment->notes }}</td>
            </tr>
        </table>
    </div>

</body>
</html>