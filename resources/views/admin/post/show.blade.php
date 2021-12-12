@extends('adminlte::page')

@section('title', 'Post Details')

@section('content_header')
    <h1>Post Details</h1>
@stop

@section('content')
    @component('components.flash')
    @endcomponent
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th class="col-2">ID</th>
                <td>{{ $data->{\App\Models\Post::ID} }}</td>
            </tr>
            <tr>
                <th>Title</th>
                <td>{{ $data->{\App\Models\Post::TITLE} }}</td>
            </tr>
            <tr>
                <th>Author</th>
                <td>{{ $data->user->{\App\Models\User::NAME} }}</td>
            </tr>
            <tr>
                <th>Created at</th>
                <td>{{ $data->{\App\Models\Post::CREATED_AT} }}</td>
            </tr>
            <tr>
                <th>Updated at</th>
                <td>{{ $data->{\App\Models\Post::UPDATED_AT} }}</td>
            </tr>
            <tr>
                <th>Delete at</th>
                <td>{{ $data->{\App\Models\Post::DELETED_AT} }}</td>
            </tr>
            <tr>
                <th>Content</th>
                <td>{!! nl2br(e($data->{\App\Models\Post::CONTENT})) !!}</td>
            </tr>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
