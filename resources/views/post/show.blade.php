@extends('layouts._main')

@section('title', $data->{\App\Models\Post::TITLE})

@section('css')
@endsection

@section('content')
    @component('components.banner', ['title' => $data->{\App\Models\Post::TITLE}, 'subTitle' => $data->user->{\App\Models\User::NAME} ?? 'Deleted user' . ' @' . $data->{\App\Models\Post::CREATED_AT}, 'image' => asset('/assets/img/home-bg.jpg')])
    @endcomponent

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 mb-5">
                @component('components.validationErrors')
                @endcomponent
            </div>
        </div>
        @if ($data->isOwner())
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7 mb-5 d-flex">
                    <a href="{{ route('post.edit', ['id' => $data->{\App\Models\Post::ID}]) }}" class="btn btn-info btn-sm me-3">Edit</a>

                    <form action="{{ route('post.destroy', ['id' => $data->{\App\Models\Post::ID}]) }}" method="post">
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
                        {!! nl2br(e($data->{\App\Models\Post::CONTENT})) !!}
                    </p>
                    @if($data->{\App\Models\Post::CREATED_AT}->ne($data->{\App\Models\Post::UPDATED_AT}))
                    <p>
                        <small>
                            Updated at {{ $data->{\App\Models\Post::UPDATED_AT} }}
                        </small>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </article>
@endsection

@section('js')
@endsection
