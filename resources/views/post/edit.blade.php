@extends('layouts._main')

@section('title', 'Edit post')

@section('css')
@endsection

@section('content')
    @component('components.banner', ['title' => 'Edit post', 'subTitle' => '', 'image' => asset('/assets/img/home-bg.jpg')])
    @endcomponent

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 mb-5">
                @component('components.validationErrors')
                @endcomponent

                <form action="{{ route('post.update', ['id' => $data->{\App\Models\Post::ID}]) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-4">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control" placeholder="Title" required
                               value="{{ old(\App\Models\Post::TITLE, $data->{\App\Models\Post::TITLE}) }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="content">Content</label>
                        <textarea name="content" class="form-control" placeholder="Enter content here..." rows="10"
                                  required>{{ old(\App\Models\Post::CONTENT, $data->{\App\Models\Post::CONTENT}) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
