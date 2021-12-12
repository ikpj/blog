@extends('adminlte::page')

@section('title', 'New Admin')

@section('content_header')
    <h1>New Admin</h1>
@stop

@section('content')
    @component('components.flash')
    @endcomponent
    <form action="{{ route('admin.admin.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="{{ \App\Models\Admin::NAME }}" value="{{ old(\App\Models\Admin::NAME) }}" class="form-control" placeholder="Name">
                    <label>e-mail</label>
                    <input type="text" name="{{ \App\Models\Admin::EMAIL }}" value="{{ old(\App\Models\Admin::EMAIL) }}" class="form-control" placeholder="e-mail">
                    <label>Password</label>
                    <input type="password" name="{{ \App\Models\Admin::PASSWORD }}" class="form-control" placeholder="Password">
                    <label>Confirm password</label>
                    <input type="password" name="{{ \App\Models\Admin::PASSWORD }}_confirmation" class="form-control" placeholder="Confirm password">
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
