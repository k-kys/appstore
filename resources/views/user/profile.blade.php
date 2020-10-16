@extends('layouts.master')
@section('content')
    <div class="container">
        @if ($alert = Session::get('alert-success'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $alert }}
            </div>
        @endif
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10">

                <form action="{{ route('postProfile', ['id' => $user->id]) }}" method="POST" role="form" enctype="multipart/form-data">
                    <legend>Profile</legend>
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" id="" value="<?= $user->name ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Avatar</label>
                        <input type="file" class="form-control" name="avatar" id="">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
@endsection
