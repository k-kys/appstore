@extends('layouts.master')

@section('meta')
    <title>Login</title>
@endsection

@push('css')
    <style>
        body {
            text-align: center;
        }
        form {
            display: inline-block;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        {{-- Kiem tra loi - validate --}}
        @if ($errors->any())
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
            </div>
        @endif

            {{-- form dang nhap --}}
        <form action="{{ route('postLogin') }}" method="POST" role="form">
            <legend>Login</legend>
            @csrf
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" id="" value="{{ old('email') }}" placeholder="example@email.com">
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" id="" placeholder="Password">
            </div>

            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>

        <div>
            Do not have an account ? <a href="#">Register</a>
        </div>
    </div>
@endsection
