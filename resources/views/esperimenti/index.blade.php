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






                        <div class="container-fluid">
                            <div class="row no-gutters flex-lg-nowrap">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="examinations-edit-attachment-description"
                                                    class="form-label">{{ __('translate.description') }}</label>
                                        <input class="search-form-amount form-control" name="amount" placeholder="Amount"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-lg-2 pl-lg-1">
                                    <div class="form-group">
                                        <select class="search-form-currency form-control">
                                            <option value="AED">AED</option>
                                            <option value="AFN">AFN</option>
                                            <option value="ALL">ALL</option>
                                            <option value="AMD">AMD</option>
                                            <option value="ANG">ANG</option>
                                            <option value="AOA">AOA</option>
                                            <option value="ARS">ARS</option>
                                            <option value="AUD">AUD</option>
                                            <option value="AWG">AWG</option>
                                            <option value="AZN">AZN</option>
                                            <option value="BAM">BAM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 pl-lg-1">
                                    <div class="form-group">
                                        <select class="search-form-currency form-control">
                                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AS">American Samoa</option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">Antarctica</option>
                                            <option value="AG">Antigua and Barbuda</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg pl-lg-1">
                                    <div class="form-group">
                                        <select class="search-form-currency form-control">
                                            <optgroup label="All payment methods">
                                                <option value="ALL_ONLINE">All online offers</option>
                                                <option value="NATIONAL_BANK">National bank transfer</option>
                                                <option value="SEPA">SEPA (EU) bank transfer</option>
                                                <option value="SPECIFIC_BANK">Transfers with specific bank</option>
                                                <option value="INTERNATIONAL_WIRE_SWIFT">International Wire (SWIFT)</option>
                                                <option value="OTHER">Other online payment</option>
                                                <option value="CASH_DEPOSIT">Cash deposit</option>
                                                <option value="ECOCASH">EcoCash</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-auto pl-lg-1">
                                    <div class="form-group">
                                        <input type="submit" name="find-offers" value="Search" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>










                    </div>
                </div>
            </div>
        </div>
    </div>





    @include('esperimenti.modal')


    <script type="module">
        $(function() {});
    </script>

@endsection
