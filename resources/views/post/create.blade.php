@extends('layouts._main')

@section('title', 'Create post')

@section('css')
@endsection

@section('content')
    @component('components.banner', ['title' => 'Create post', 'subTitle' => '', 'image' => asset('/assets/img/home-bg.jpg')])
    @endcomponent

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 mb-5">
                @component('components.validationErrors')
                @endcomponent

                <form action="{{ route('post.store') }}" method="post">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control" placeholder="Title" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="content">Content</label>
                        <textarea name="content" class="form-control" placeholder="Enter content here..." rows="10" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
