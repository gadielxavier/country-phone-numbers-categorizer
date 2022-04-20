<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Country Phone Numbers Categorizer</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">

        <div class="pb-2 mt-4 mb-2 border-bottom">
            <p class="h2">Phone Numbers</p>
        </div>

        <div class="row pb-2 mt-4 mb-2">
            <div class="col d-flex justify-content-center">
                <div class="card" style="width: 42rem;">
                    <div class="card-header">
                        <form action="/filter" method="get">
                            <div class="row mt-2 mb-2">
                                <div class="col-sm">
                                    <select class="form-select" name="country">
                                        <option selected value="0">Select country</option>
                                        <option value="0">All</option>
                                        <option value="(237)" @if($country === '(237)') selected @endif>Cameroon</option>
                                        <option value="(251)" @if($country === '(251)') selected @endif>Ethiopia</option>
                                        <option value="(212)" @if($country === '(212)') selected @endif>Morocco</option>
                                        <option value="(258)" @if($country === '(258)') selected @endif>Mozambique</option>
                                        <option value="(256)" @if($country === '(256)') selected @endif>Uganda</option>
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <select class="form-select" name="state">
                                        <option selected value="0">Valid phone numbers</option>
                                        <option value="0">All</option>
                                        <option value="OK" @if($state === 'OK') selected @endif>OK</option>
                                        <option value="NOK" @if($state === 'NOK') selected @endif>NOK</option>
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <div class="float-end">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        {{ $customers->appends(request()->except(['page','_token']))->links('pagination::bootstrap-4') }}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Country</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Country Code</th>
                                    <th scope="col">Phone Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->getPhoneNumber()->getCountry() }}</td>
                                    <td>{{ $customer->getPhoneNumber()->getState() }}</td>
                                    <td>{{ $customer->getPhoneNumber()->getCountryCode() }}</td>
                                    <td>{{ $customer->getPhoneNumber()->getNumber() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $customers->appends(request()->except(['page','_token']))->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>