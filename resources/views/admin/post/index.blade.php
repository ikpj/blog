@extends('adminlte::page')

@section('title', 'Post List')

@section('content_header')
    <h1>Post List</h1>
@stop

@section('content')
    @component('components.flash')
    @endcomponent
    <div class="col-md-12">
        <div class="card">
            @if($data->hasPages())
            <div class="card-header">
                <div class="float-right">
                    {{$data->links('pagination::bootstrap-4')}}
                </div>
            </div>
            @endif
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th>User</th>
                        <th>Updated At</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $row->{\App\Models\Post::ID} }}</td>
                            <td>
                            @if($row->{\App\Models\Post::DELETED_AT})
                                <del>
                            @endif
                                    {{ $row->{\App\Models\Post::TITLE} }}
                            @if($row->{\App\Models\Post::DELETED_AT})
                                </del>
                            @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.user.edit', ['id' => $row->{\App\Models\Post::USER_ID}]) }}">

                                    @if($row->user->{\App\Models\User::DELETED_AT})
                                        <del>
                                    @endif
                                            {{ $row->user->{\App\Models\User::NAME} }}
                                    @if($row->user->{\App\Models\User::DELETED_AT})
                                        </del>
                                    @endif
                                </a>
                            </td>
                            <td>{{ $row->{\App\Models\Post::UPDATED_AT} }}</td>
                            <td>
                                <nobr>
                                    <a href="{{ route('admin.post.show', ['id' => $row->{\App\Models\Post::ID}]) }}">
                                        <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                            <i class="fa fa-lg fa-fw fa-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('admin.post.edit', ['id' => $row->{\App\Models\Post::ID}]) }}">
                                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                            <i class="fa fa-lg fa-fw fa-pen"></i>
                                        </button>
                                    </a>
                                    @if ($row->{\App\Models\Post::DELETED_AT})
                                        <form action="{{ route('admin.post.restore', ['id' => $row->{\App\Models\Post::ID}]) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Restore">
                                                <i class="fa fa-lg fa-fw fa-trash-restore"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.post.destroy', ['id' => $row->{\App\Models\Post::ID}]) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                                <i class="fa fa-lg fa-fw fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </nobr>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{$data->links("pagination::bootstrap-4")}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
