@extends('template.basicStructTemplate')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.10/dist/full.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('container')
{{-- Navbar --}}
    <div class="navbar bg-green-primary">
        <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-lg btn-ghost btn-square">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
            </div>
                <ul class="menu menu-lg dropdown-content mt-3 z-[1] shadow bg-green-light rounded-box w-52 flex justify-center">

                    @if(Session::has('role'))
                    @php
                        $role = Session::get('role')
                        @endphp
                    @if($role == "A")
                        {{-- Kalau Rolenya itu admin --}}
                        <li class="px-5 my-3"><a href="" class="btn btn bg-green-primary rounded-lg text-white pt-2 pb-1">Dashboard</a></li>
                        <li class="px-5 my-3"><a href="#" class="btn btn bg-green-primary rounded-lg text-white pt-2 pb-1">Products</a></li>
                    @elseif($role == "M")
                        {{-- Kalau Rolenya itu master / owner --}}
                        <li class="px-5 my-3"><a href="" class="btn btn bg-green-primary rounded-lg text-white pt-2 pb-1 px-2">Dashboard</a></li>
                        <li class="px-5 my-3"><a href="#" class="btn btn bg-green-primary rounded-lg text-white pt-2 pb-1 px-2">Products Report</a></li>
                        <li class="px-5 my-3"><a href="#" class="btn btn bg-green-primary rounded-lg text-white pt-2 pb-1 px-2">Wisata Report</a></li>
                        <li class="px-5 my-3"><a href="#" class="btn btn bg-green-primary rounded-lg text-white pt-2 pb-1 px-2">Admins</a></li>
                    @endif
                @endif



                <li class="px-5 my-3"><a href="{{url('logout')}}" class="btn btn bg-green-primary rounded-lg text-white pt-2 pb-1 px-2">Logout</a></li>

                </ul>
        </div>
        </div>
        <div class="navbar-center">
            <img class="navbar-brand" src="{{asset('assets/admin/navbar/Logo Slumbung.png')}}" style="max-width:8vw; max-height:auto;">
        </div>
        <div class="navbar-end">

        </div>
    </div>

{{-- Content --}}

@yield('content')

{{--  --}}
@endsection


@push('script')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush
