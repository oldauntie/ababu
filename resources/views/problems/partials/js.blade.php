@push('scripts')
<script type="text/javascript">
    // add event listener
    $(document).on("change_problem", changeProblem);

    // change_problem event handler
    function changeProblem(e) {
        problem_id = e.problem_id;
        initPrescriptionsTable(e.problem_id);
        initExaminationsTable(e.problem_id);
    }


    $(function() {
        $("#problems tr").click(function(){
            $(this).addClass('selected').siblings().removeClass('selected');    
            problem_id = $(this).find('td:first').html();
            diagnosis_id = $(this).find('td:eq(1)').html();

            // delegated to custom event
            // initPrescriptionsTable(problem_id);

            $.event.trigger({
                type: "change_problem",
                problem_id: problem_id,
            });
        });

        // problem table double click
        $("#problems tr").dblclick(function(){
            diagnosis_id = $(this).find('td:eq(2)').html();
            openProblemEditModal(diagnosis_id);
        });

        $("#diagnosis_id").select2({
            ajax: { 
                placeholder: "Choose problem...",
                minimumInputLength: 3,
                url: "/diagnoses/search/",
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
            openProblemEditModal(id);
            // clear selection
            $('#diagnosis_id').val(null).trigger('change');
        });
    
        // init prescriptions table loading all results
        // loadPrescriptionsTable(0);
    })


    function openProblemEditModal(diagnosis_id)
    {
        if(diagnosis_id == 0){
            return;
        }

        $.ajax({
            url: '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/problem/diagnosis/' + diagnosis_id,
            type: 'get',
            success: function(problem)
            {
                // fill Modal with pet details
                $('#problem-edit-active_from').val(problem.active_from);
                $('#problem-edit-active_from').datepicker('update');

                $('#problem-edit-diagnosis_id').val(problem.diagnosis_id);
                $('#problem-edit-diagnosis_term_name').val(problem.diagnosis.term_name);
                $('#problem-edit-subjective_analysis').val(problem.subjective_analysis);
                $('#problem-edit-objective_analysis').val(problem.objective_analysis);
                $('#problem-edit-notes').val(problem.notes);

                // if status_id is not set, set it to 'active' 
                if(problem.status_id > 0){
                    $('#problem-edit-status_id_' + problem.status_id).prop("checked", true);
                }else{
                    $('#problem-edit-status_id_1').prop("checked", true);
                }
                $('#problem-edit-key_problem').prop("checked", problem.key_problem == 1 ? true : false);
                

                // calculate "At Age"
                setAtAge();

                // Set action and method
                if(problem.id > 0){
                    $('#problem-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/problems/' + problem.id);
                    $('#problem-edit-modal-form input[name="_method"]').val('PUT');
                }else{
                    $('#problem-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/problems');
                    $('#problem-edit-modal-form input[name="_method"]').val('POST');
                }

                // Display Modal
                $('#problem-edit-modal').modal('show');
            }
        });
    }
</script>
@endpush