@extends('adminlte::page')

@section('title', 'User List')

@section('content_header')
    <h1>User List</h1>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td>
                                @if($row->{\App\Models\User::DELETED_AT})
                                    <del>
                                        @endif
                                        {{ $row->{\App\Models\User::ID} }}
                                        @if($row->{\App\Models\User::DELETED_AT})
                                    </del>
                                @endif
                            </td>
                            <td>
                                @if($row->{\App\Models\User::DELETED_AT})
                                    <del>
                                        @endif
                                        {{ $row->{\App\Models\User::NAME} }}
                                        @if($row->{\App\Models\User::DELETED_AT})
                                    </del>
                                @endif
                            </td>
                            <td>
                                @if($row->{\App\Models\User::DELETED_AT})
                                    <del>
                                        @endif
                                        {{ $row->{\App\Models\User::EMAIL} }}
                                        @if($row->{\App\Models\User::DELETED_AT})
                                    </del>
                                @endif
                            </td>
                            <td>
                                <nobr>
                                    <a href="{{ route('admin.user.edit', ['id' => $row->{\App\Models\User::ID}]) }}">
                                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                            <i class="fa fa-lg fa-fw fa-pen"></i>
                                        </button>
                                    </a>
                                @if ($row->{\App\Models\User::DELETED_AT})
                                        <form action="{{ route('admin.user.restore', ['id' => $row->{\App\Models\User::ID}]) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Restore">
                                                <i class="fa fa-lg fa-fw fa-trash-restore"></i>
                                            </button>
                                        </form>
                                @else
                                        <form action="{{ route('admin.user.destroy', ['id' => $row->{\App\Models\User::ID}]) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                                <i class="fa fa-lg fa-fw fa-trash"></i>
                                            </button>
                                        </form>
                                @endif
                                    <form action="{{ route('admin.user.destroyAllPost', ['id' => $row->{\App\Models\User::ID}]) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete all post">
                                            <i class="fa fa-lg fa-fw fa-eye-slash"></i>
                                        </button>
                                    </form>
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
