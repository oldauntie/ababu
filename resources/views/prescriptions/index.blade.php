<style>
    #prescriptions tbody tr.selected {
        color: white;
        background-color: lightseagreen;
    }

    #prescriptions td {
        border-left: none;
        border-right: none;
    }

    td.details-control {
        background: url('{{url('/images/icons/add.png')}}') no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('{{url('/images/icons/delete.png')}}') no-repeat center center;
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
        <table id="prescriptions" class="display" style="width:100%">
            <thead style="display: none">
                <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>{{__('translate.created_at')}}</th>
                    <th>{{__('translate.name')}}</th>
                    <th>{{__('translate.quantity')}}</th>
                    <th>{{__('translate.dosage')}}</th>
                    <th>{{__('translate.in_evidence')}}</th>
                </tr>
            </thead>
            <tbody>
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
        
        // define main prescriptions table
        prescriptions_table = $('#prescriptions').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            paging:   false,
            ordering: false,
            info:     false,
            ajax: "{{ route('clinics.prescriptions.list', [$clinic->id, $pet->id, 0, 'datatable']) }}",
            rowCallback: function (row, data) {
                $(row).addClass('master-row');
            },
            columns: [
                {
                    className: "details-control",
                    orderable:      false,
                    data:           null,
                    defaultContent: ""
                },
                {data: "id", name: "id"},
                {data: "created_at", name: "created_at", render: function(data){
                    var updated = moment.utc(data);
                    return updated.format( updated.locale('{{auth()->user()->locale->short_code}}').localeData().longDateFormat('L') );
                }},
                {data: "name", name: "name", render: function(data, type, full, meta){
                    if(type === 'display'){
                        data = strtrunc(data, 19);
                    }
                    return data;
                }},
                {data: "quantity", name: "quantity", visible: false},
                {data: "dosage", name: "dosage", visible: false},
                {data: "in_evidence", name: "in_evidence", render: function(data){
                    if(data == 1){
                        return '<img src="{{url('/images/icons/prescription_in_evindence.png')}}">';
                    }else{
                        return "";
                    }
                }}
            ],
        });

        // used to create datatable teaser
        function strtrunc(str, max, add){
            add = add || '...';
            return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
        };

        /* Formatting function for row details - modify as you need */
        function format ( d ) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<td colspan="4">' + d.name + '</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>q.ty:</td>'+
                    '<td>'+d.quantity+'</td>'+
                    '<td>dosage:</td>'+
                    '<td>'+d.dosage+'</td>'+
                '</tr>'+
            '</table>';
        }

        // Add event listener for opening and closing details
        $('#prescriptions tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = prescriptions_table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        } );


        $('#prescriptions tbody').on('click', 'tr.master-row', function() {
            if (!$(this).hasClass('selected')) {
                prescriptions_table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


        // prescrprion table double click
        $('#prescriptions tbody').on('dblclick', 'tr.master-row', function(){
            var selData = prescriptions_table.rows(".selected").data();
            var id = selData[0].id;

            alert(id);
        });


        // Select2 component for medicine selection 
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

        $("#medicine_id").on("select2:select", function(e) { 
            var id = e.params.data.id;
            openPrescriptionEditModal(id);
            // clear selection
            $('#medicine_id').val(null).trigger('change');
        });
    
    })


    function openPrescriptionEditModal(medicine_id)
    {
        alert(medicine_id)
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