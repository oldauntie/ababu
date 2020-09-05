<style>
    .vertical-scroll {
        height: 150px;
        overflow-y: scroll;
    }

    td {
        border: 1px #DDD solid;
        padding: 5px;
        cursor: pointer;
    }

    .selected {
        background-color: lightseagreen;
        color: #FFF;
    }


    #prescription tr>*:nth-child(1) {
        display: none;
    }

    #prescription td {
        border-left: none;
        border-right: none;
    }
</style>
<div class="row">
    <div class="col-12">
        <!-- owner -->
        <div class="row">
            <div class="col-md-12">
                <select id="medicine_id" name="medicine_id"></select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 vertical-scroll">
        <table id="prescription" border="0" style="width:100%">
            <tbody>
                @foreach ($prescriptions as $prescription)

                <tr>
                    <td>{{ $prescription->id }}</td>
                    <td>{{ $prescription->created_at->format( auth()->user()->locale->date_short_format ) }}</td>
                    <td>{{ $prescription->medicine->name }}</td>
                    <td>{{ $prescription->quantity }}</td>
                    <td>{{ $prescription->dosage }}</td>
                    <td>
                        @if( $prescription->in_evidence == true )
                        <img title="{{ __('translate.prescription_in_evidence') }}"
                            src="{{url('/images/icons/prescription_in_evindence.png')}}">
                        @else
                            &nbsp;
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('prescriptions.modal.edit')
@push('scripts')
<!-- select2 -->
<script type="text/javascript" src="{{url('/lib/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('/lib/select2-4.1.0-beta.1/dist/css/select2.min.css')}}" />


<script type="text/javascript">
    $(function() {
        $("#prescription tr").click(function(){
            $(this).addClass('selected').siblings().removeClass('selected');    
            prescrprion_id = $(this).find('td:first').html();
            diagnosis_id = $(this).find('td:eq(1)').html();
        });

        // prescrprion table double click
        $("#prescription tr").dblclick(function(){
            // todo: delete me ?
            // prescrprion_id = $(this).find('td:first').html();
            diagnosis_id = $(this).find('td:eq(2)').html();
            openPrescriptionEditModal(diagnosis_id);
        });

        $("#medicine_id").select2({
            ajax: { 
                placeholder: "Choose a medicine...",
                minimumInputLength: 3,
                url: "/clinics/{{$clinic->id}}/medicines/search/",
                dataType: "json",
                dropdownAutoWidth : true,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $("#diagnosis_id").on("select2:select", function(e) { 
            var id = e.params.data.id;
            openPrescriptionEditModal(id);
            // clear selection
            $('#diagnosis_id').val(null).trigger('change');
        });
    
    })


    function openPrescriptionEditModal(diagnosis_id)
    {
        $.ajax({
            url: '/clinics/{{$clinic->id}}/prescription/diagnosis/' + diagnosis_id + '/pet/{{$pet->id}}',
            type: 'get',
            success: function(prescription)
            {
                // console.log("prescription: " + prescription);
                // fill Modal with owner details                    

                $('#prescription-edit-active_from').val(prescription.active_from);
                $('#prescription-edit-active_from').datepicker('update');


                // $('#prescription-edit-id').val(prescription.id);
                $('#prescription-edit-diagnosis_id').val(prescription.diagnosis_id);
                $('#prescription-edit-diagnosis_term_name').val(prescription.diagnosis.term_name);
                $('#prescription-edit-subjective_analysis').val(prescription.subjective_analysis);
                $('#prescription-edit-objective_analysis').val(prescription.objective_analysis);
                $('#prescription-edit-notes').val(prescription.notes);

                // if status_id is not set, set it to 'active' 
                if(prescription.status_id > 0){
                    $('#prescription-edit-status_id_' + prescription.status_id).prop("checked", true);
                }else{
                    $('#prescription-edit-status_id_1').prop("checked", true);
                }
                $('#prescription-edit-key_prescription').prop("checked", prescription.key_prescription == 1 ? true : false);
                

                // calculate "At Age"
                setAtAge();

                // Set action and method
                if(prescription.id > 0){
                    $('#prescription-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pet/{{$pet->id}}/prescriptions/' + prescription.id);
                    $('[name="_method"]').val('PUT');
                }else{
                    $('#prescription-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pet/{{$pet->id}}/prescriptions');
                    $('[name="_method"]').val('POST');
                }
                console.log( $('[name="_method"]').val() );

                // Display Modal
                $('#prescription-edit-modal').modal('show');
            }
        });
    }
</script>
@endpush