@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
    @component('components.flash')
    @endcomponent
    <form action="{{ route('admin.user.update', ['id' => $data->{\App\Models\User::ID}]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="{{ \App\Models\User::NAME }}" class="form-control" placeholder="Name" value="{{ old($data->{\App\Models\User::NAME}) ?? $data->{\App\Models\User::NAME} }}">
                    <label>e-mail</label>
                    <input type="text" name="{{ \App\Models\User::EMAIL }}" class="form-control" placeholder="e-mail" value="{{ old($data->{\App\Models\User::EMAIL}) ?? $data->{\App\Models\User::EMAIL} }}">
                    <label>New password <small>If needed to change</small></label>
                    <input type="password" name="{{ \App\Models\User::PASSWORD }}" class="form-control" placeholder="New Password">
                    <label>Confirm new password</label>
                    <input type="password" name="{{ \App\Models\User::PASSWORD }}_confirmation" class="form-control" placeholder="Confirm new password">
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
