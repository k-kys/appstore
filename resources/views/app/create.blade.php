@extends('layouts.master')

@section('meta')
    <title>Create New App</title>
@endsection

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

        <form action="{{ route('app.store') }}" method="POST" role="form" enctype="multipart/form-data">
            <legend>Create new App</legend>
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <input type="textarea" class="form-control" name="description" value="{{ old('description') }}" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="">Cost</label>
                <input type="number" class="form-control" name="cost" value="{{ old('cost') }}" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="">Category</label>
                <select name="category" id="" class="form-control" required="required">
                    <option>-- Chọn danh mục --</option>
                    @foreach ($categories as $category)
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">OS</label>
                <select name="os" id="" class="form-control" required>
                    <option>-- Chọn hệ điều hành --</option>
                    @foreach ($os as $item_os)
                        <option value="<?= $item_os->id ?>"><?= $item_os->name ?></option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Image</label>
                <input type="file" class="form-control" name="image" id="" placeholder="Input field">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
