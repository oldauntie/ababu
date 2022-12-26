@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('translate.links') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="http://www.ababu.cloud" target="_BLANK">Ababu.cloud</a><br />
                    <a href="http://www.oldauntie.org" target="_BLANK">Old Auntie</a><br />
                    <a href="http://www.oldauntie.org/forum" target="_BLANK">Ababu Forum</a><br />

                </div>
            </div>
        </div>
    </div>
</div>
@endsection