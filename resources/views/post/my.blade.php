@extends('layouts._main')

@section('title', 'My posts')

@section('css')
@endsection

@section('content')
    @component('components.banner', ['title' => 'My posts', 'subTitle' => '', 'image' => asset('/assets/img/home-bg.jpg')])
    @endcomponent

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 mb-5">
                @component('components.validationErrors')
                @endcomponent
            </div>
        </div>
        <article>
        <div>
            {{$data->links('pagination::bootstrap-4')}}
            <table class="table col-12">
                <thead>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </thead>
                <tbody>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->{\App\Models\Post::ID} }}</td>
                    <td>{{ $row->{\App\Models\Post::TITLE} }}</td>
                    <td>{{ $row->{\App\Models\Post::CREATED_AT} }}</td>
                    <td>{{ $row->{\App\Models\Post::UPDATED_AT} }}</td>
                    <td>
                        <form method="get" action="{{ route('post.edit', ['id' => $row->{\App\Models\Post::ID}]) }}">
                            @csrf
                            <button type="submit" class="btn btn-link">Edit</button>
                        </form>
                        <form method="post" action="{{ route('post.destroy', ['id' => $row->{\App\Models\Post::ID}]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{$data->links('pagination::bootstrap-4')}}
        </div>
    </article>
    </div>
@endsection

@section('js')
@endsection
