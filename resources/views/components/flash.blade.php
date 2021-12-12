@if ($infos = \Illuminate\Support\Facades\Session::get('infos'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Success!</h5>
        @foreach ($infos as $info)
            <li>{{ $info }}</li>
        @endforeach
    </div>
@endif
@if ($successes = \Illuminate\Support\Facades\Session::get('successes'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    @foreach ($successes as $success)
        <li>{{ $success }}</li>
    @endforeach
</div>
@endif
@if ($warnings = \Illuminate\Support\Facades\Session::get('warnings'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Success!</h5>
        @foreach ($warnings as $warning)
            <li>{{ $warning }}</li>
        @endforeach
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Error!</h5>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif
