
@extends('layouts.master')
@section('meta')
    <title>My Apps</title>
@endsection
@section('content')
    <div class="container-fuid">
        <a href="#" class="btn btn-primary">Create new App</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>Download count</th>
                    <th>Category</th>
                    <th>Operating system</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apps as $app)

                <tr>
                    <td><?= $app->image ?></td>
                    <td><?= $app->name ?></td>
                    <td><?= $app->description ?></td>
                    <td><?= $app->cost ?></td>
                    <td><?= $app->download_count ?></td>
                    <td><?= $app->category_id ?></td>
                    <td><?= $app->operating_system_id ?></td>
                    <td><?= $app->created_at ?></td>
                    <td><?= $app->updated_at ?></td>
                    <td>
                        <a href="#" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-primary">Delete</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
