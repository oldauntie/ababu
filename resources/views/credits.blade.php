@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('translate.credits') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12 panel-warning">
                            <div class="content-box-header panel-heading">
                                <div class="panel-title ">Thanks & Credits</div>

                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                                </div>
                            </div>
                            <div class="content-box-large box-with-header">
                                <b>First of all I would like to thank my family, Dani, Elio and Ozzy</b><br />
                                for their patience and knowledge on how to manage my madness.<br />
                                <br />
                                <b>I would like also to thank my friends</b><br />
                                including all the musicians and bands I loved and love for their presence in my
                                life.<br />
                                <br />
                                <b>Venom Coding Group</b><br />
                                for the fundamental database information about Veterinary Nomenclature<br />
                                see more at: <a href="http://www.venomcoding.org"
                                    target="_BLANK">http://www.venomcoding.org</a><br />
                                <br />
                                <b>Bootstrap framework</b><br />
                                is distribuited under MIT Licence<br />
                                see more at: <a href="http://www.getbootstrap.com"
                                    target="_BLANK">www.getbootstrap.com</a><br />
                                <br />
                                    <b>Special thanks to Debian, Elementary OS & Kali Linux for their great distributions.</b><br />
                                    <a href="https://www.debian.org" target="_BLANK">debian.org</a><br />
                                    <a href="https://elementary.io" target="_BLANK">elementary.io</a><br />
                                    <a href="https://www.kali.org" target="_BLANK">kali.org</a><br />
                                    <br />

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection