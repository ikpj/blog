@extends('layouts._main')

@section('title', 'Register')

@section('css')
@endsection

@section('content')
    @component('components.banner', ['title' => 'register', 'subTitle' => '', 'image' => asset('/assets/img/home-bg.jpg')])
    @endcomponent

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 mb-5">
                @component('components.validationErrors')
                @endcomponent
                <form action="{{ route('auth.register.register') }}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="name">Name</label>
                        <input name="{{ \App\Models\User::NAME }}" type="name" class="form-control" id="name" placeholder="Name" value="{{ old(\App\Models\User::NAME) }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="email">Email address</label>
                        <input name="{{ \App\Models\User::EMAIL }}" type="email" class="form-control" id="email" aria-describedby="email" placeholder="Enter email" value="{{ old(\App\Models\User::EMAIL) }}">
                        <small id="email-info" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password</label>
                        <input name="{{ \App\Models\User::PASSWORD }}" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password_confirm">Confirm Password</label>
                        <input name="{{ \App\Models\User::PASSWORD }}_confirmation" type="password" class="form-control" id="password_confirm" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
