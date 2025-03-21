<div class="modal modal-xl fade" id="examinations-edit-modal" tabindex="-1" aria-labelledby="examinations-edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- Modal Header --}}
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="examinations-edit-modal-label">{{ __('translate.examination_edit') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- Modal Header --}}

            {{-- Nav Bar --}}
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-examination-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-examination" type="button" role="tab"
                        aria-controls="pills-examination"
                        aria-selected="true">{{ __('translate.examination') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-attachments-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-attachments" type="button" role="tab"
                        aria-controls="pills-attachments"
                        aria-selected="false">{{ __('translate.attachments') }}</button>
                </li>
            </ul>
            {{-- Nav Bar --}}

            {{-- Panela --}}
            <div class="tab-content" id="pills-tabContent">

                {{-- Examination Form Begins --}}
                <div class="tab-pane fade" id="pills-examination" role="tabpanel"
                    aria-labelledby="pills-examination-tab">
                    <form method="POST" id="examinations-edit-form" action="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">

                            {{-- 
                            <div class="form-floating mb-3">
                                <input type="text" id="examinations-edit-diagnostic_test" name=""
                                value="" class="form-control"
                                placeholder = "{{ __('translate.diagnostic_test') }}" aria-label="" readonly
                                disabled>
                                <label
                                for="examinations-edit-diagnostic_test">{{ __('translate.diagnostic_test') }}</label>
                            </div>
                            --}}

                            <div class="form-floating mb-3">
                                <select id="examinations-edit-problem_id" name="problem_id" class="form-control"
                                    aria-label="">
                                    <option value>{{ __('translate.problem_indipendent') }}</option>
                                    @foreach ($pet->problems as $problem)
                                        <option value="{{ $problem->id }}">
                                            {{ $problem->diagnosis->term_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-check form-switch">
                                <input type="checkbox" id="examinations-edit-is_pathologic" name="is_pathologic"
                                    class="form-check-input" role="switch">
                                <label class="form-check-label"
                                    for="examinations-edit-is_pathologic">{{ __('translate.is_pathologic') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="datetime-local" id="examinations-edit-examination_date"
                                    name="examination_date" value="{{ date('Y-m-d\TH:i') }}"
                                    class="form-control @error('examination_date') is-invalid @enderror"
                                    placeholder = "{{ __('translate.examination_date') }}" aria-label="" required>
                                <label
                                    for="examinations-edit-examination_date">{{ __('translate.examination_date') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" id="examinations-edit-result" name="result"
                                    value="{{ old('result') }}"
                                    class="form-control @error('result') is-invalid @enderror"
                                    placeholder = "{{ __('translate.result') }}" aria-label="">
                                <label for="examinations-edit-result">{{ __('translate.result') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea id="examinations-edit-medical_report" name="medical_report"
                                    class="form-control @error('medical_report') is-invalid @enderror"
                                    placeholder="{{ __('translate.medical_report') }}" style="height: 100px">{{ old('medical_report') }}</textarea>
                                <label
                                    for="examinations-edit-medical_report">{{ __('translate.medical_report') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea id="examinations-edit-notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                                    placeholder="{{ __('translate.notes') }}" style="height: 100px">{{ old('notes') }}</textarea>
                                <label for="examinations-edit-notes">{{ __('translate.notes') }}</label>
                            </div>

                            <div class="form-check form-switch">
                                <input type="checkbox" id="examinations-edit-print_notes" name="print_notes"
                                    class="form-check-input" role="switch">
                                <label class="form-check-label"
                                    for="examinations-edit-print_notes">{{ __('translate.print_notes') }}</label>
                            </div>

                            <div class="form-check form-switch">
                                <input type="checkbox" id="examinations-edit-in_evidence" name="in_evidence"
                                    class="form-check-input" role="switch">
                                <label class="form-check-label"
                                    for="examinations-edit-in_evidence">{{ __('translate.in_evidence') }}</label>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                data-bs-dismiss="modal">{{ __('translate.close') }}</button>
                            <button type="submit"
                                class="btn btn-sm btn-outline-primary">{{ __('translate.save') }}</button>
                        </div>
                    </form>




                </div>
                {{-- Examination Form Ends --}}


                {{-- Attachments Begins --}}
                <div class="tab-pane fade show active" id="pills-attachments" role="tabpanel"
                    aria-labelledby="pills-attachments-tab">


                    <div class="modal-body">

                        {{-- Attachments List Begins --}}
                        <div class="container overflow-scroll" style="max-height: 180px;">

                            @foreach ($examination->attachments as $attachment)
                                <form method="GET" action="" id="{{ $attachment->id }}">
                                    <div class="row align-baseline">
                                        <div class="col-5">{{ $attachment->name }}</div>
                                        <div class="col-5">
                                            <input type="text" id="examinations-edit-attachment-description"
                                                name="description" value="{{ $attachment->description }}"
                                                class="form-control @error('result') is-invalid @enderror"
                                                placeholder = "{{ __('translate.optional') }}" aria-label="">
                                        </div>
                                        <div class="col-2">
                                            <a class="btn btn-sm btn-outline-secondary" href="#"
                                                role="button">
                                                <i class="bi-floppy"></i>
                                            </a>
                                            <a class="btn btn-sm btn-outline-danger" href="#" role="button">
                                                <i class="bi-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            @endforeach

                        </div>
                        {{-- Attachments List Ends --}}

                        {{-- Add Attachment Form Begins --}}
                        <form method="POST" id="examinations-edit-attachments"
                            action="{{ route('clinics.examinations.attach', ['clinic' => $clinic, 'examination' => $examination]) }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-5">
                                    <label for="attachment" class="form-label">{{ __('translate.attachment') }}
                                        ({{ __('help.examination_attachments_accepted_files') }} )</label>
                                </div>
                                <div class="col-lg-5">
                                    <label for="examinations-edit-attachment-description"
                                        class="form-label">{{ __('translate.description') }}</label>
                                </div>
                                <div class="col-auto">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5">
                                    <input type="file" class="form-control" name="attachment" id="attachment"
                                        accept=".pdf, .doc, .docx, .png, .jpg, .svg, .txt">
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" id="examinations-edit-attachment-description"
                                        name="description" value="{{ old('description') }}"
                                        class="form-control @error('result') is-invalid @enderror"
                                        placeholder = "{{ __('translate.optional') }}" aria-label="">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" id="examinations-edit-attachment-upload"
                                        class="btn btn-outline-primary">{{ __('translate.upload') }}</button>
                                </div>
                            </div>
                        </form>
                        {{-- Add Attachment Form Ends --}}

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">{{ __('translate.close') }}
                        </button>
                    </div>








                </div>
                {{-- Attachments Ends --}}
            </div>
            {{-- Panela --}}


        </div>
    </div>
</div>


<script type="module">
    $(function() {
        var id;
        $('#examinations-edit-modal').on('show.bs.modal', function(e) {
            let btn = $(e
                .relatedTarget
            ); // e.related here is the element that opened the modal, specifically the row button

            // let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
            id = btn.data('id'); // this is how you get the of any `data` attribute of an element

            $.ajax({
                url: "/clinics/{{ $clinic->id }}/examinations/" + id + "/get",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(examination) {
                    let url =
                        '/clinics/{{ $clinic->id }}/owners/{{ $owner->id }}/pets/{{ $pet->id }}/examinations/' +
                        examination.id;

                    $('#examinations-edit-form').attr('action', url);
                    $('#examinations-edit-diagnostic_test').val(examination.diagnostic_test
                        .term_name); // this input is disabled

                    $('#examinations-edit-problem_id').val(examination
                        .problem_id); // Select the option with the problem_id value
                    $('#examinations-edit-problem_id').trigger(
                        'change'); // Notify any JS components that the value changed

                    $('#examinations-edit-is_pathologic').prop('checked', examination
                        .is_pathologic);
                    $('#examinations-edit-examination_date').val(examination
                        .examination_date.substring(0, 16));
                    $('#examinations-edit-result').val(examination.result);
                    $('#examinations-edit-medical_report').val(examination.medical_report);
                    $('#examinations-edit-notes').val(examination.notes);
                    $('#examinations-edit-print_notes').prop('checked', examination
                        .print_notes);
                    $('#examinations-edit-in_evidence').prop('checked', examination
                        .in_evidence);
                }
            });
        });


        $('#examinations-edit-attachments').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            console.log(e);

            $.ajax({
                type: 'POST',
                url: "{{ route('clinics.examinations.attach', [$clinic, $examination]) }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        this.reset();
                        alert('Image has been uploaded successfully');
                    }
                },
                error: function(response) {
                    console.log('errore');
                }
            });
        });




        // transform standard select input into select2
        $("#examinations-edit-problem_id").select2({
            dropdownParent: $('#examinations-edit-modal'),
            width: '100%',
            placeholder: "{{ __('translate.problem_indipendent') }}",
            allowClear: true,
            width: '100%',
        });




    });
</script>
