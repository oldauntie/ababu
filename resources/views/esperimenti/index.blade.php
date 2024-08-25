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



    

@include('esperimenti.modal')

@endsection
