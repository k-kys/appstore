<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('app.search') }}" method="GET" class="form-inline" role="form">

        <div class="form-group">
            <label class="sr-only" for="">Keyword</label>
            <input type="text" class="form-control" name="keyword" id="" placeholder="Keyword">
        </div>



        <button type="submit" class="btn btn-primary">Search</button>
@php
    if($apps) :
@endphp
        <div class="container">
            <table>
                <tr>
                    <td>
                        <a href="">
                            <img src="" alt=""> $apps->image <br/>
                             <?= $apps->name ?>  <br/>
                        </a>
                         <?= $apps->cost ?>  <br/>
                    </td>
                </tr>
            </table>
        </div>
        @php
            else :
        @endphp
        <div class="container">
            Error.
        </div>
        @php
            endif
        @endphp
    </form>
</body>
</html>
