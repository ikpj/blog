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
                <form method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="name">Name</label>
                        <input name="name" type="name" class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="form-group mb-4">
                        <label for="email">Email address</label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="email" placeholder="Enter email">
                        <small id="email-info" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password_confirm">Confirm Password</label>
                        <input name="password_confirmation" type="password" class="form-control" id="password_confirm" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
