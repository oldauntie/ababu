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
                {!! $generator->getBarcode($examination->id, $generator::TYPE_CODE_128) !!}
                <img class="backdrop" src="data:image/svg+xml;base64,{{ $qrCurrentUrl }}" width="71px">
                --}}
            </td>
            <td>
                {{ route('clinics.owners.pets.visit', ['clinic' => $clinic->id, 'owner' => $examination->pet->owner, 'pet' => $examination->pet]) }}
            </td>
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
                <td>{{ $examination->print_notes ? $examination->notes : '' }}</td>
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
                    {{ $examination->pet->owner->lastname . ', ' . $examination->pet->owner->firstname }}
                </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.address') . ', ' . __('translate.firstname') }}</td>
                <td>
                    {{ $examination->pet->owner->address . ', ' . $examination->pet->owner->postcode . ', ' . $examination->pet->owner->city }}
                </td>
            </tr>
            <tr>
                <td class="capitalize bold">{{ __('translate.ssn') }}</td>
                <td>
                    {{ $examination->pet->owner->ssn }}
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
                <td colspan="7" class="border-bottom uppercase bold">{{ __('translate.examination') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="border-bottom">
                    id: {{ $examination->diagnostic_test->id }} {!! $generator->getBarcode($examination->diagnostic_test->id, $generator::TYPE_CODE_128) !!}
                </td>
                <td colspan="4" class="border-bottom">external id: {{ $examination->diagnostic_test->external_id }}
                    {!! $generator->getBarcode($examination->diagnostic_test->external_id, $generator::TYPE_CODE_128) !!}</td>
            </tr>
            <tr>
                <td class="border bold">{{ __('translate.examination') }}</td>
                <td class="border bold">{{ __('translate.result') }}</td>
                <td class="border bold">{{ __('translate.medical_report') }}</td>
                <td class="border bold">{{ __('translate.is_pathologic') }}</td>
                <td class="border bold">{{ __('translate.in_evidence') }}</td>
            </tr>
            <tr>
                <td class="border">{{ $examination->diagnostic_test->term_name }}</td>
                <td class="border">{{ $examination->result }}</td>
                <td class="border">{{ $examination->medical_report }}</td>                
                <td class="border">{{ $examination->is_pathologic==true ? __('translate.yes') : __('translate.no') }}</td>
                <td class="border">{{ $examination->in_evidence==true ? __('translate.yes') : __('translate.no')  }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
