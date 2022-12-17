
{{-- dropbox JS e CSS --}}
<script src="{{ asset('/js/dropzone.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/css/dropzone.min.css') }}" type="text/css" />

<div class="row">
    <div class="col-12">
        <!-- owner -->
        <div class="row">
            <div class="col-md-12">
                {{-- dropbox form --}}
                <div class="container">
                    <form method="post" action="{{ route('attachments.store') }}" enctype="multipart/form-data"
                        class="dropzone" id="dropzone">
                        <div class="dz-message" data-dz-message><span>Trascina qui i files da caricare</span></div>
                        @csrf
                        <input name="strumento_id" type="hidden" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 vertical-scroll">
        <table id="attachments" class="display" style="width:100%">
            <thead style="display: none">
                <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>#</th>
                    <th>#</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    Dropzone.options.dropzone =
    {
        accepteduploads: "application/zip,image/jpeg,image/jpg,image/png",
        addRemoveLinks: false,
        timeout: 60000,
        uploadMultiple: false,
        removedfile: function(file) 
        {
            console.log(file);
        },
        success: function (file, response) {
            console.log(response);
            location.reload();
            return;
        },
        error: function (file, response) {
            console.log(response);
            return false;
        }
    };
</script>

@include('attachments.partials.delete')
@include('attachments.partials.js')

@push('scripts')
@endpush