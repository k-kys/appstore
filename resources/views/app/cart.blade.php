@extends('layouts.master')
@section('meta')
    <title>Cart</title>
@endsection

@section('content')
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th>App name</th>
            <th>Description</th>
            <th>Cost</th>
            <th>Category</th>
            <th>OS</th>
            <th class="text-center">Subtotal</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @if (session('cart'))
                @foreach (session('cart') as $id => $details)
                    @php
                        $total += $details['cost']; /* *$details['quantity'] */
                    @endphp
        <tr>
            <td data-th="App">
                <div class="row">
                    <div class="col-sm-3 hidden-xs">
                        <img src="{{ $details['image'] }}" alt="" class="img-responsive">
                    </div>
                    <div class="col-sm-9">
                        {{ $details['name'] }}
                    </div>
                </div>
            </td>
            <td data-th="Desctiption">{{ $details['description'] }}</td>
            <td data-th="Cost">{{ $details['cost'] }}</td>
            <td data-th="Category">{{ $details['category'] }}</td>
            <td data-th="OS">{{ $details['os'] }}</td>
        <td data-th="Subtotal" class="text-center">{{ $details['cost'] /* nhan quantity */ }} </td>

            <td class="actions" data-th="">
                <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>
            @endforeach
        @endif
        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Total: {{ $total }}</strong></td>
        </tr>
        <tr>
            <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total: ${{ $total }}</strong></td>
        </tr>
        </tfoot>
    </table>

    <script type="text/javascript">
        // $(".update-cart").click(function (e) {
        //     e.preventDefault();
        //     var ele = $(this);
        //     $.ajax({
        //         url: "{{ url('update-cart') }}",
        //         method: "patch",
        //         data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
        //         success: function (response) {
        //             window.location.reload();
        //         }
        //     });
        // });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if (confirm("Are you sure ?")) {
                $.ajax({
                    type: "method",
                    url: "{{ url('remove-from-cart') }}",
                    method: "delete",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection
