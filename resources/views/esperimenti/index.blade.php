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



                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input class="modalTextInput form-control" placeholder="Text Here" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="saveEdit btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

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
            var io = $('#io').html();
            console.log(io);
            
            $('#exampleModal').on('show.bs.modal', function(e) {
                $('.modalTextInput').val('');
                let btn = $(e.relatedTarget); // e.related here is the element that opened the modal, specifically the row button
                let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
                console.log('hi ...');
                console.log(id);

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




    <!-- Modal -->
    <div class="modal fade" id="exampleModalOriginal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ... mah...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
