<form action="{{route('clinics.notes.store', [$clinic, $pet])}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-11">
            <input type="text" name="note_text" value="" id="note_text"
                class="form-control form-control-sm @error('note_text') is-invalid @enderror" required>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <input type="image" name="" src="{{url('/images/icons/accept.png')}}" border="0" alt="" style="" />
        </div>
    </div>
</form>
<div class="row">
    <div class="col-12 vertical-scroll">
        @foreach ($notes as $note)

        <form action="/clinics/{{$clinic->id}}/pets/{{$pet->id}}/notes/{{$note->id}}" method="POST">
            @csrf
            {{ method_field('PUT') }}

            <div class="row justify-content-left">
                <div class="col-md-3">
                    <input type="text" name="created_at"
                        value="{{$note->created_at->format(auth()->user()->locale->date_short_format)}}"
                        class="form-control form-control-sm">
                </div>
                <div class="col-md-8">
                    <textarea name="note_text" rows="2" style="min-width: 100%" class="form-control form-control-sml"
                        required>{{$note->note_text}}</textarea>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <input type="image" name="" src="{{url('/images/icons/accept.png')}}" border="0" alt="" style="" />
                    <a href="#" onclick="deleteNote({{$note->id}})"><img src="{{url('/images/icons/delete.png')}}"></a>
                </div>
            </div>
        </form>
        @endforeach
    </div>
</div>
<form id="note-edit-delete-form" method="POST" action="">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>

@push('scripts')
<script>
    function deleteNote(id)
    {
        bootbox.confirm({
        title: "{{__('translate.note')}} {{__('translate.delete')}}",
        message: "<div>{{ __('message.are_you_sure') }}</div><small> {{__('help.note_delete')}} </small>",
        className: 'rubberBand animated',
            callback: function(result) {
                if (result) {
                    // get button value
                    $('#note-edit-delete-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/notes/' + id);
                    $('#note-edit-delete-form').submit();
                }
            }
        });
    }
</script>
@endpush