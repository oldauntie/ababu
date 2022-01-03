@push('scripts')
<script type="text/javascript">
/* *********************************************** *
Treatments
* ************************************************ */

$(function() {
    // define main treatmentss table
    treatments_table = $('#treatments').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        paging:   false,
        ordering: false,
        info:     false,
        language : {
            zeroRecords: "{{__('translate.treatments_zero_records')}}"             
        },
        ajax: "{{ route('clinics.treatments.list', [$clinic->id, $pet->id, 0, 'datatable']) }}",
        rowCallback: function (row, data) {
            $(row).addClass('master-row');
        },
        columns: [
            {data: "id", name: "id", visible: true},
            {data: "created_at", name: "created_at", render: function(data){
                var created_at = moment.utc(data);
                return created_at.format( created_at.locale('{{auth()->user()->locale->short_code}}').localeData().longDateFormat('L') );
            }},
            {data: "term_name", name: "term_name", render: function(data, type, full, meta){
                if(type === 'display'){
                    data = strtrunc(data, 19);
                }
                return data;
            }},
            {data: "recall_at", name: "recall_at", render: function(data){
                if(data != null){
                    var recall_at = moment.utc(data);
                    return recall_at.format( recall_at.locale('{{auth()->user()->locale->short_code}}').localeData().longDateFormat('L') );
                }else{
                    return "no recall set";
                }
            }},
        ],
    });

    
    // used to create datatable teaser        
    function strtrunc(str, max, add){
        add = add || '...';
        return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
    };
    

    $('#treatments tbody').on('click', 'tr.master-row', function() {
        if (!$(this).hasClass('selected')) {
            treatments_table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });


    // treatments table double click
    $('#treatments tbody').on('dblclick', 'tr.master-row', function(){
        var selData = treatments_table.rows(".selected").data();
        var id = selData[0].id;

        editTreatment(id);
    });


    // Select2 procedure selection (search) 
    $("#procedure_id").select2({
        ajax: { 
            placeholder: "Choose a procedure...",
            minimumInputLength: 3,
            url: "/clinics/{{$clinic->id}}/procedures/search/",
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

    
    $("#procedure_id").on("select2:select", function(e) { 
        var id = e.params.data.id;            
        createTreatment(id);
        // clear selection
        $('#procedure_id').val(null).trigger('change');
    });


    // lock / unlock problem button on Examination modal form
    $('#examination-edit-button-lock').click(function(){
        
        // change icon
        $(this).toggleClass( 'lock unlock' );
        // unlock problem_id control
        var status = $('#examination-edit-problem').prop('disabled');
        $('#examination-edit-problem').prop('disabled', !status);
    })

    // on problem change set problem_id hidden input value 
    $('#examination-edit-problem').on('change', function(){
        $('#examination-edit-problem_id').val($(this).val());
    });

});


</script>
@endpush