@extends('adminlte::page')

@section('title', 'New User')

@section('content_header')
    <h1>New User</h1>
@stop

@section('content')
    @component('components.flash')
    @endcomponent
    <form action="{{ route('admin.user.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="{{ \App\Models\User::NAME }}" value="{{ old(\App\Models\User::NAME) }}" class="form-control" placeholder="Name">
                    <label>e-mail</label>
                    <input type="text" name="{{ \App\Models\User::EMAIL }}" value="{{ old(\App\Models\User::EMAIL) }}" class="form-control" placeholder="e-mail">
                    <label>Password</label>
                    <input type="password" name="{{ \App\Models\User::PASSWORD }}" class="form-control" placeholder="Password">
                    <label>Confirm password</label>
                    <input type="password" name="{{ \App\Models\User::PASSWORD }}_confirmation" class="form-control" placeholder="Confirm password">
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
