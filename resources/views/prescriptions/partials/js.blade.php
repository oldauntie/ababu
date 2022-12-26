@push('scripts')
<script type="text/javascript">


    /* *********************************************** *
    Prescription
    * ************************************************ */
    // init Prescriptions Table
    function initPrescriptionsTable(problem_id){
        prescriptions_table.ajax.url( '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions/list/' + problem_id + '/datatable' ).load();
    }



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
                {data: "id", name: "id", visible: false},
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
                        return '<img src="{{url('/images/icons/in_evidence.png')}}">';
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
                    '<td>{{ __('translate.qty') }}:</td>'+
                    '<td>'+d.quantity+'</td>'+
                    '<td>{{ __('translate.dosage') }}:</td>'+
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


        // prescription table double click
        $('#prescriptions tbody').on('dblclick', 'tr.master-row', function(){
            var selData = prescriptions_table.rows(".selected").data();
            var id = selData[0].id;

            editPrescription(id);
        });


        // Select2 medicine selection (search) 
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


        // delete button
        $(document).on('click', '#prescription-edit-delete-button', function(e){
            e.preventDefault();
            bootbox.confirm({
                title: "{{__('translate.prescription')}} {{__('translate.delete')}}",
                message: "<div>{{ __('message.are_you_sure') }}</div><small> {{__('help.prescription_delete')}} </small>",
                className: 'rubberBand animated',
                callback: function(result) {
                    if (result) {
                        // get button value
                        var id = e.target.value;
                        $('#prescription-edit-delete-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions/' + id);
                        $('#prescription-edit-delete-form').submit();
                    }
                }
            });
        });
    
        // lock / unlock button
        $('#prescription-edit-button-lock').click(function(){
            // change icon
            $(this).toggleClass( 'lock unlock' );
            // unlock problem_id control
            var status = $('#prescription-edit-problem').prop('disabled');
            $('#prescription-edit-problem').prop('disabled', !status);
        })

        // on problem change set problem_id hidden input value 
        $('#prescription-edit-problem').on('change', function(){
            $('#prescription-edit-problem_id').val($(this).val());
        });
    });

    // retrieve an empty prescription and pass it to 
    function createPrescription(medicine_id){
        create_url = '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions/create/' + medicine_id;

        // if selected, it add a problem_id to creation url
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

    // retrieve a prescription given an id
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

    // open prescription form for edit
    function openPrescriptionEditModal(prescription){
        prescription = prescription;

        $('#prescription-edit-prescription_id').val(prescription.id);
        $('#prescription-edit-medicine_id').val(prescription.medicine.id);
        $('#prescription-edit-problem').val(prescription.problem_id);
        $('#prescription-edit-problem_id').val(prescription.problem_id);
        $('#prescription-edit-medicine').val(prescription.medicine.name);
        $('#prescription-edit-date_of_prescription').val(prescription.date_of_prescription);
        $('#prescription-edit-quantity').val(prescription.quantity);
        $('#prescription-edit-dosage').val(prescription.dosage);
        $('#prescription-edit-duration').val(prescription.duration);

        $('#prescription-edit-in_evidence').prop("checked", !! + prescription.in_evidence);
        $('#prescription-edit-notes').val(prescription.notes);
        $('#prescription-edit-print_notes').prop("checked", !! + prescription.print_notes);
        $('#prescription-edit-created_at').html(prescription.created_at);
        $('#prescription-edit-updated_at').html(prescription.updated_at);

        // Set action and method
        if(prescription.id > 0)
        {
            $('#prescription-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions/' + prescription.id);
            $('#prescription-edit-modal-form input[name="_method"]').val('PUT');

            $('#prescription-edit-delete-button').attr('disabled', false);
            $('#prescription-edit-delete-button').val(prescription.id);
            $('#prescription-edit-print-button').attr('disabled', false);
            $('#prescription-edit-print-button').val(prescription.id);
        }else{
            $('#prescription-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions');
            $('#prescription-edit-modal-form input[name="_method"]').val('POST');
            
            $('#prescription-edit-delete-button').attr('disabled', true);
            $('#prescription-edit-print-button').attr('disabled', true);
        }

        $('#prescription-edit-modal').modal('show');
    }






</script>
@endpush