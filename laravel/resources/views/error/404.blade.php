@extends('template.basicStructTemplate')
@section('title')
    <title>404 Page Not Found!</title>
@endsection
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@endpush
@section('container')
    <div class="container-fluid">
        <div class="d-flex position-absolute start-50 top-50 translate-middle">
            <div class="text-center fw-semibold" style="font-size:5vh;color:gray">
                <p class="text-danger" style="font-size:7vh;">Error: 404</p>
                The Page You're Looking For Is Not Found!
            </div>
        </div>
    </div>
@endsection
