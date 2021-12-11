@extends('layouts._main')

@section('title', 'Posts')

@section('css')
@endsection

@section('content')
    @component('components.banner', ['title' => 'My Posts', 'subTitle' => '', 'image' => asset('/assets/img/home-bg.jpg')])
    @endcomponent

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 mb-5">
                @component('components.validationErrors')
                @endcomponent

                @foreach($posts as $post)
                    <div class="post-preview">
                        <a href="{{ route('post.show', ['id' => $post->{\App\Models\Post::ID}]) }}">
                            <h2 class="post-title">{{ $post->{\App\Models\Post::TITLE} }}</h2>
                            <h3 class="post-subtitle">{{ \Illuminate\Support\Str::limit($post->{\App\Models\Post::CONTENT}, 50) }}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">{{ $post->user->{\App\Models\User::NAME} }}</a>
                            on {{ $post->{\App\Models\Post::CREATED_AT} }}
                        </p>
                    </div>
                    <hr class="my-4"/>
                @endforeach

                @if ($posts->nextPageUrl())
                    <div class="d-flex justify-content-end mb-4">
                        <a class="btn btn-primary text-uppercase" href="{{ $posts->nextPageUrl() }}">Older Posts →</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
