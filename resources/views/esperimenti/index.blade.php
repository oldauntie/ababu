@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            Esperimenti
                            <br>
                            <small>das ist untervallen</small>
                        </div>
                        <div class="float-end">
                            <a href="{{ route('home') }}" class="btn btn-sm btn-primary">{{ __('home') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        here are some experiments [body]


                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Some data here</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-id="1" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Another data here</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-id="2" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>More data here</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-id="3" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <p id="io" class="recentNote">io...</p>





                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="module">
        $(function() {
            $('#exampleModal').on('show.bs.modal', function(e) {
                $('.modalTextInput').val('');
                let btn = $(e
                    .relatedTarget
                    ); // e.related here is the element that opened the modal, specifically the row button
                let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
                console.log('raised show.bs.modal event from button with data-id=' + id);

                // nanna(id);

                $.ajax({
                    url: "http://localhost/clinics/68e8ffd5-7dc6-4c8a-a9b7-d7e78df8e3bb/prescriptions/f841c6a2-ecf9-4a96-aa5d-e8b46285c54f/get",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        console.log(res);
                        alert(res);
                    }
                });

                let text = $('.modalTextInput').val(id);
                $('.saveEdit').data('id', id); // then pass it to the button inside the modal
            })

            $('.saveEdit').on('click', function() {
                let id = $(this).data('id'); // the rest is just the same
                saveNote(id);
                // $('#exampleModal').modal('toggle'); // this is to close the modal after clicking the modal button
            })
        })

        function saveNote(id) {
            let text = $('.modalTextInput').val();
            $('.recentNote').data('note', text);
            console.log($('.recentNote').data('note'));
            console.log(text + ' --> ' + id);
        }
    </script>

@include('esperimenti.modal')

@endsection
