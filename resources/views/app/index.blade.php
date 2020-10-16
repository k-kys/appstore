@extends('layouts.master')

@section('meta')
	<title>AppStore</title>
@endsection

@section('content')
    <div class="container">
        @if ($alert = Session::get('success'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $alert }}
            </div>
        @elseif ($alert = Session::get('alert-success'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $alert }}
            </div>
        @endif
    </div>

    <div class="container-fluid">
        <table>
            @foreach ($apps as $app)
            <tr>
                <td>
                    <a href="">
                        <img src="<?= $app->image ?>" alt=""> <br/>
                        Name: <?= $app->name ?> <br/>
                    </a>
                      Cost: <?= $app->cost ?> <br/>
                      <p class="btn-holder"><a href="{{ url('add-to-cart/' . $app->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a></p>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

@endsection
