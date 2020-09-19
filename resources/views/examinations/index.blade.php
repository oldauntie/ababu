
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
        <table id="examinations" class="display" style="width:100%">
            <thead style="display: none">
                <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>{{__('translate.created_at')}}</th>
                    <th>{{__('translate.name')}}</th>
                    <th>{{__('translate.in_evidence')}}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@include('examinations.partial.delete')
@include('examinations.modal.edit')

@push('scripts')

<script type="text/javascript">
    $(function() {
        // define main examinations table
        examinations_table = $('#examinations').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            paging:   false,
            ordering: false,
            info:     false,
            language : {
                zeroRecords: "{{__('translate.examinations_zero_records')}}"             
            },
            ajax: "{{ route('clinics.examinations.list', [$clinic->id, $pet->id, 0, 'datatable']) }}",
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
                {data: "result", name: "result", render: function(data, type, full, meta){
                    if(type === 'display'){
                        data = strtrunc(data, 19);
                    }
                    return data;
                }},
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
                    '<td colspan="4">' + d.result + '</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>q.ty:</td>'+
                    '<td>'+d.is_pathologic+'</td>'+
                    '<td>dosage:</td>'+
                    '<td>'+d.in_evidence+'</td>'+
                '</tr>'+
            '</table>';
        }


        // Add event listener for opening and closing details
        $('#examinations tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = examinations_table.row( tr );

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


        $('#examinations tbody').on('click', 'tr.master-row', function() {
            if (!$(this).hasClass('selected')) {
                examinations_table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


        // examination table double click
        $('#examinations tbody').on('dblclick', 'tr.master-row', function(){
            var selData = examinations_table.rows(".selected").data();
            var id = selData[0].id;

            editExamination(id);
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
            createExamination(id);
            // clear selection
            $('#medicine_id').val(null).trigger('change');
        });


        // delete button
        $(document).on('click', '#examination-edit-delete-button', function(e){
            e.preventDefault();
            bootbox.confirm({
                title: "{{__('translate.examination')}} {{__('translate.delete')}}",
                message: "<div>{{ __('message.are_you_sure') }}</div><small> {{__('help.pet_delete')}} </small>",
                className: 'rubberBand animated',
                callback: function(result) {
                    if (result) {
                        // get button value
                        var id = e.target.value;
                        $('#examination-edit-delete-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/examinations/' + id);
                        $('#examination-edit-delete-form').submit();
                    }
                }
            });
        });
    
    });

    // retrieve an empty examination and pass it to 
    function createExamination(medicine_id){
        create_url = '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/examinations/create/' + medicine_id;

        // if selected, it add a problem_id to creation url
        if(problem_id > 0){
            create_url += '/' + problem_id
        }
        
        $.ajax({
            url: create_url,
            type: 'get',
            success: function(examination)
            {
                openExaminationEditModal(examination);
            }
        });
    }

    // retrieve a examination given an id
    function editExamination(id){
        $.ajax({
            url: '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/examinations/edit/' + id,
            type: 'get',
            success: function(examination)
            {
                openExaminationEditModal(examination);
            }
        });
    }

    // open examination form for edit
    function openExaminationEditModal(examination){
        examination = examination;
        $('#examination-edit-examination_id').val(examination.id);
        $('#examination-edit-medicine_id').val(examination.medicine.id);
        $('#examination-edit-problem').val(examination.problem_id);
        $('#examination-edit-problem_id').val(examination.problem_id);
        $('#examination-edit-medicine').val(examination.medicine.name);
        $('#examination-edit-date_of_examination').val(examination.created_at);
        $('#examination-edit-quantity').val(examination.quantity);
        $('#examination-edit-dosage').val(examination.dosage);

        $('#examination-edit-in_evidence').prop("checked", !! + examination.in_evidence);
        $('#examination-edit-notes').val(examination.notes);
        $('#examination-edit-print_notes').prop("checked", !! + examination.print_notes);

        // Set action and method
        if(examination.id > 0)
        {
            $('#examination-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pet/{{$pet->id}}/examinations/' + examination.id);
            $('#examination-edit-modal-form input[name="_method"]').val('PUT');

            $('#examination-edit-delete-button').attr('disabled', false);
            $('#examination-edit-delete-button').val(examination.id);
            $('#examination-edit-print-button').attr('disabled', false);
        }else{
            $('#examination-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pet/{{$pet->id}}/examinations');
            $('#examination-edit-modal-form input[name="_method"]').val('POST');
            
            $('#examination-edit-delete-button').attr('disabled', true);
            $('#examination-edit-print-button').attr('disabled', true);
        }

        $('#examination-edit-modal').modal('show');
    }

</script>
@endpush