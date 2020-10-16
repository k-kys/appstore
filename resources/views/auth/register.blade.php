@extends('layouts.master')

@section('meta')
	<title>Register</title>
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
        {{-- kiem tra loi - validate --}}
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

		<form action="{{ route('postRegister') }}" method="POST" role="form">
			<legend>Register</legend>
		@csrf
			<div class="form-group">
				<label for="">Email</label>
				<input type="text" class="form-control" name="email" id="" value="{{ old('email') }}" placeholder="example@email.com">
			</div>

			<div class="form-group">
				<label for="">Name</label>
				<input type="text" class="form-control" name="name" id="" value="{{ old('name') }}" placeholder="Name">
			</div>

			<div class="form-group">
				<label for="">Password</label>
				<input type="password" class="form-control" name="password" id="" placeholder="Password">
			</div>



			<button type="submit" class="btn btn-primary">Register</button>
		</form>
		<div>
			Do you already have an account ? <a href="#">Login</a>
		</div>
	</div>
@endsection
