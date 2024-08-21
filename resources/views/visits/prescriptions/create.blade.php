<div class="modal modal-xl fade" id="newPrescriptionModal" tabindex="-1" aria-labelledby="newPrescriptionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newPrescriptionModalLabel">{{ __('translate.prescription_new') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('clinics.owners.pets.prescriptions.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select class="form-control" id="problem" name="problem" aria-label="problem"
                            aria-describedby="basic-addon" required>
                            <option value="0"> -- {{ __('translate.problem_indipendent') }} -- </option>
                            @foreach ($pet->problems as $problem)
                                <option value="{{ $problem->id }}">
                                    {{ $problem->diagnosis->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <select id="medicine_id2" class="js-data-example-ajax" required></select>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="prescription_date" type="date"
                            class="form-control @error('prescription_date') is-invalid @enderror" name="prescription_date"
                            value="{{ date('Y-m-d') }}" placeholder = '{{ __('translate.prescription_date') }}'
                            required>
                        <label for="prescription_date">{{ __('translate.prescription_date') }}</label>
                    </div>


                    


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                        data-bs-dismiss="modal">{{ __('translate.close') }}</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary">{{ __('translate.save') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script type="module">
    $(function() {
        $("#problem").select2({
            // dropDownParent: $('#newPrescriptionModal3')
            dropdownParent: $('#newPrescriptionModal'),
            width: '100%',
            tags: true,
            placeholder: "{{ __('translate.problem_filter_by') }}",
            tokenSeparators: [','],
            width: '100%',
        });


        $('#medicine_id2').select2({
            dropdownParent: $('#newPrescriptionModal'),
            width: '100%',
            ajax: {
                url: '{{ route('clinics.medicines.search', ['clinic' => $clinic]) }}',
                type: "GET",
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
            }
        });
    });
</script>
