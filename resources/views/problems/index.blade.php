<style>
    .anyClass {
        height: 150px;
        overflow-y: scroll;
    }

    td {
        border: 1px #DDD solid;
        padding: 5px;
        cursor: pointer;
    }

    .selected {
        background-color: brown;
        color: #FFF;
    }

/*
    #problems tr>*:nth-child(1) {
        display: none;
    }
*/
</style>
<div class="row">
    <div class="col-12">
        <!-- owner -->
        <div class="row">
            <div class="col-md-12">
                <label for="diagnosis_id">{{__('translate.owner')}}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <select id="diagnosis_id" name="diagnosis_id"></select>
                @error('problem_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 anyClass">
        <table id="problems" border="1" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>{{__('translate.description')}}</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($problems as $problem)
                <tr>
                    <td><img src="{{url('/icons/problem_status_') . $problem->status . '.png'}}"></td>
                    <td>{{ $problem->diagnosis_id }}</td>
                    <td>{{ $problem->diagnosis_id }}</td>
                    <td>{{ $problem->key_problem }}</td>
                </tr>
                @endforeach
            </tbody>
            <button id="ok" name="ok" class="ok">ok</button>
        </table>
    </div>
</div>

@include('problems.modal.edit')
@push('scripts')
<!-- select2 -->
<script type="text/javascript" src="{{url('/lib/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('/lib/select2-4.1.0-beta.1/dist/css/select2.min.css')}}" />


<script type="text/javascript">
    $(function() {
        $("#problems tr").click(function(){
            $(this).addClass('selected').siblings().removeClass('selected');    
            /*
            var value=$(this).find('td:first').html();
            alert(value);
            */    
            problem_id = $(this).find('td:first').html();
            diagnosis_id = $(this).find('td:eq(1)').html();
        });

        $("#diagnosis_id").select2({
            ajax: { 
                placeholder: "Choose owner...",
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

        $("#diagnosis_id").on("change", function(e) { 
            // what you would like to happen
            console.log(e);
            console.log($("#diagnosis_id").val());


            openPetEditModal(1);

        });
    
    })


    function openPetEditModal(id)
    {
        $.ajax({
            url: '/clinics/{{$clinic->id}}/pets/' + id +'/get',
            type: 'get',
            success: function(pet){ 
                // fill Modal with owner details                    
                $('#pet-edit-name').val(pet.name);


                // setAge('edit');
                
                // Display Modal
                $('#pet-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pets/' + id);
                $('#pet-edit-modal').modal('show');
            }
        });
    }

    
    // var io = 'nanna';
    
</script>
@endpush