@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="POST" role="form">
                    <legend>Change password</legend>

                    <div class="form-group">
                        <label for="">Current password</label>
                        <input type="password" class="form-control" name="currentPassword" id="" placeholder="Current Password">
                    </div>

                    <div class="form-group">
                        <label for="">New password</label>
                        <input type="password" class="form-control" name="newPassword" id="" placeholder="New Password">
                    </div>

                    <div class="form-group">
                        <label for="">Retype new password</label>
                        <input type="password" class="form-control" name="rePassword" id="" placeholder="Retype New Password">
                    </div>

                    <button type="submit" class="btn btn-primary">Change</button>
                    <button type="reset" class="btn btn-primary">Cancel</button>
                </form>

            </div>
        </div>
    </div>
@endsection
