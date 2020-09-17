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
            language : {
                zeroRecords: "{{__('translate.prescriptions_zero_records')}}"             
            },
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
                        return '<img src="{{url('/images/icons/prescription_in_evidence.png')}}">';
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

            editPrescription(id);
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
            createPrescription(id);
            // clear selection
            $('#medicine_id').val(null).trigger('change');
        });
    
    });


    function createPrescription(medicine_id){
        create_url = '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions/create/' + medicine_id;

        // add problem to creation if selected any
        if(problem_id > 0){
            create_url += '/' + problem_id
        }
        
        $.ajax({
            url: create_url,
            type: 'get',
            success: function(prescription)
            {
                openPrescriptionEditModal(prescription);
            }
        });
    }


    function editPrescription(id){
        $.ajax({
            url: '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions/edit/' + id,
            type: 'get',
            success: function(prescription)
            {
                openPrescriptionEditModal(prescription);
            }
        });
    }

    function openPrescriptionEditModal(prescription){
        $('#prescription-edit-medicine_id').val(prescription.medicine.id);
        $('#prescription-edit-problem').val(prescription.problem_id);
        $('#prescription-edit-problem_id').val(prescription.problem_id);
        $('#prescription-edit-medicine').val(prescription.medicine.name);
        $('#prescription-edit-date_of_prescription').val(prescription.created_at);
        $('#prescription-edit-quantity').val(prescription.quantity);
        $('#prescription-edit-dosage').val(prescription.dosage);

        $('#prescription-edit-in_evidence').prop("checked", !! + prescription.in_evidence);
        $('#prescription-edit-notes').val(prescription.notes);
        $('#prescription-edit-print_notes').prop("checked", !! + prescription.print_notes);

        // Set action and method
        if(prescription.id > 0){
            $('#prescription-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pet/{{$pet->id}}/prescriptions/' + prescription.id);
            $('[name="_method"]').val('PUT');
        }else{
            $('#prescription-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pet/{{$pet->id}}/prescriptions');
            $('[name="_method"]').val('POST');
        }

        $('#prescription-edit-modal').modal('show');
    }

</script>
@endpush