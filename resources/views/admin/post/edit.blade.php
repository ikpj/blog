@extends('adminlte::page')

@section('title', 'Edit Post')

@section('content_header')
    <h1>Edit Post</h1>
@stop

@section('content')
    @component('components.flash')
    @endcomponent
    <form action="{{ route('admin.post.update', ['id' => $data->{\App\Models\Post::ID}]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="{{ \App\Models\Post::TITLE }}" class="form-control" placeholder="Title" value="{{ old(\App\Models\Post::TITLE, $data->{\App\Models\Post::TITLE}) }}">
                    <label>Content</label>
                    <textarea name="{{ \App\Models\Post::CONTENT }}" class="form-control" rows="3" placeholder="Content">{{ old(\App\Models\Post::CONTENT, $data->{\App\Models\Post::CONTENT}) }}</textarea>
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
