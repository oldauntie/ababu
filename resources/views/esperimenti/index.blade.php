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



                        <div class="form-floating mb-3">
                            <select id="medicine_id2" class="js-data-example-ajax" width="300">
                                <option>test</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="module">
        $(function() {
            $('#medicine_id2').select2({
                width: '100%',
                ajax: {
                    url: 'http://localhost/clinics/01ff0f8a-7b4a-4f30-b03c-e1fbce7bfdc1/medicines/search',
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
                    /*
                    processResults: function(data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        console.log(data);
                        return {
                            results: data
                        };
                    }
                    */
                }
            });
        });
    </script>





@endsection
