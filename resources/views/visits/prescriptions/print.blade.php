@php
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
@endphp

<!DOCTYPE html>
<html>

<head>
    <link href="{{ public_path('css/pdf.css') }}" rel="stylesheet">
</head>

<body>

    <table border="0" width="100%">
        <tr class="border-bottom">
            <td>
                {{-- 
                {!! $generator->getBarcode($prescription->id, $generator::TYPE_CODE_128) !!}
                <img class="backdrop" src="data:image/svg+xml;base64,{{ $qrCurrentUrl }}" width="71px">
                --}}
            </td>
            <td>
                {{ route('clinics.owners.pets.visit', ['clinic' => $clinic->id, 'owner' => $prescription->pet->owner, 'pet' => $prescription->pet]) }}
            </td>
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
                <td>{{ $prescription->print_notes ? $prescription->notes : '' }}</td>
            </tr>
        </table>

        <table class="w50 float-left">
            <tr>
                <td class="border-bottom uppercase bold">{{ __('translate.veterinary') }}</td>
                <td class="border-bottom"></td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.lastname') . ', ' . __('translate.firstname') }}</td>
                <td class="uppercase">{{ Auth::user()->name . ', ' . Auth::user()->name }}</td>
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
                <td class="capitalize bold">{{ __('translate.lastname') . ', ' . __('translate.firstname') }}</td>
                <td>
                    {{ $prescription->pet->owner->lastname . ', ' . $prescription->pet->owner->firstname }}
                </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.address') . ', ' . __('translate.firstname') }}</td>
                <td>
                    {{ $prescription->pet->owner->address . ', ' . $prescription->pet->owner->postcode . ', ' . $prescription->pet->owner->city }}
                </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.ssn') }}</td>
                <td>
                    {{ $prescription->pet->owner->ssn }}
                </td>
            </tr>
        </table>

        <table class="w50 float-left">
            <tr>
                <td class="border-bottom uppercase bold">{{ __('translate.clinic') }}</td>
                <td class="border-bottom"></td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.name') }}</td>
                <td class="uppercase">
                    {{ $clinic->name }}
                </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.manager') }}</td>
                <td class="uppercase">
                    {{ $clinic->manager }}
                </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.phone') }}</td>
                <td class="uppercase">
                    {{ $clinic->phone }}
                </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.code') }}</td>
                <td class="uppercase">
                    {{ $clinic->code }}
                </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.address') }}</td>
                <td class="uppercase">
                    {{ $clinic->address }}
                </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.city') }}</td>
                <td class="uppercase">
                    {{ $clinic->city }}
                </td>
            </tr>
        </table>
    </div>

    <div class="row">
        <table class="w100 float-left border">
            <tr>
                <td colspan="7" class="border-bottom uppercase bold">{{ __('translate.medicine') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="border-bottom">
                    id: {{ $prescription->medicine->id }} {!! $generator->getBarcode($prescription->medicine->id, $generator::TYPE_CODE_128) !!}
                </td>
                <td colspan="4" class="border-bottom">external id: {{ $prescription->medicine->external_id }}
                    {!! $generator->getBarcode($prescription->medicine->external_id, $generator::TYPE_CODE_128) !!}</td>
            </tr>
            <tr>
                <td class="border bold">{{ __('translate.medicine_external_id') }}</td>
                <td class="border bold">{{ __('translate.name') }}</td>
                <td class="border bold">{{ __('translate.medicine_pharmaceutical_form') }}</td>
                <td class="border bold">{{ __('translate.quantity') }}</td>
                <td class="border bold">{{ __('translate.dosage') }}</td>
                <td class="border bold">{{ __('translate.duration') }}</td>
                <td class="border bold">{{ __('translate.target_species') }}</td>
            </tr>
            <tr>
                <td class="border">{{ $prescription->medicine->external_id }}</td>
                <td class="border">{{ $prescription->medicine->name }}</td>
                <td class="border">{{ $prescription->medicine->pharmaceutical_form }}</td>
                <td class="border">{{ $prescription->quantity }}</td>
                <td class="border">{{ $prescription->dosage }}</td>
                <td class="border">{{ $prescription->duration }}</td>
                <td class="border">{{ $prescription->medicine->target_species }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
