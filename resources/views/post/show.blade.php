@extends('layouts._main')

@section('title', $post->{\App\Models\Post::TITLE})

@section('css')
@endsection

@section('content')
    @component('components.banner', ['title' => $post->{\App\Models\Post::TITLE}, 'subTitle' => $post->{\App\Models\Post::CREATED_AT}, 'image' => asset('/assets/img/home-bg.jpg')])
    @endcomponent

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 mb-5">
                @component('components.validationErrors')
                @endcomponent
            </div>
        </div>
        @if ($post->isOwner())
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7 mb-5 d-flex">
                    <a href="{{ route('post.edit', ['id' => $post->{\App\Models\Post::ID}]) }}" class="btn btn-info btn-sm me-3">Edit</a>

                    <form action="{{ route('post.destroy', ['id' => $post->{\App\Models\Post::ID}]) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>
                        {!! nl2br(e($post->{\App\Models\Post::CONTENT})) !!}
                    </p>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('js')
@endsection
