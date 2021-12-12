@extends('adminlte::page')

@section('title', 'Password')

@section('content_header')
    <h1>Edit Password</h1>
@stop

@section('content')
    @component('components.flash')
    @endcomponent
    <form action="{{ route('admin.profile.updatePassword') }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Current password</label>
                    <input type="password" name="currentPassword" class="form-control" placeholder="Current password">
                    <label>New password</label>
                    <input type="password" name="{{ \App\Models\Admin::PASSWORD }}" class="form-control" placeholder="New password">
                    <label>Confirm new password</label>
                    <input type="password" name="{{ \App\Models\Admin::PASSWORD }}_confirmation" class="form-control" placeholder="Confirm new password">
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
