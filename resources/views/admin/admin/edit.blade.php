@extends('adminlte::page')

@section('title', 'Edit Admin')

@section('content_header')
    <h1>Edit Admin</h1>
@stop

@section('content')
    @component('components.flash')
    @endcomponent
    <form action="{{ route('admin.admin.update', ['id' => $data->{\App\Models\Admin::ID}]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="{{ \App\Models\Admin::NAME }}" class="form-control" placeholder="Name" value="{{ old(\App\Models\Admin::NAME, $data->{\App\Models\Admin::NAME}) }}">
                    <label>e-mail</label>
                    <input type="text" name="{{ \App\Models\Admin::EMAIL }}" class="form-control" placeholder="e-mail" value="{{ old(\App\Models\Admin::EMAIL, $data->{\App\Models\Admin::EMAIL}) }}">
                    <label>New password <small>If needed to change</small></label>
                    <input type="password" name="{{ \App\Models\Admin::PASSWORD }}" class="form-control" placeholder="New Password">
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
