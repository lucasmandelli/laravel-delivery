@extends('app')

@section('content')

    <div class="container">
        <h3>Novo Pedido</h3>

        @include('errors._check')

        <div class="container">
            {!! Form::open(['route' => 'customer.orders.store', 'class' => 'form']) !!}

            <div class="form-group">
                <label>Total:</label> <span id="total"></span>
                <br>
                <a href="#" id="btn-new-item" class="btn btn-default">Novo Item</a>
                <br><br>
                <input type="hidden" id="amount-products-row" value="0" >

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="items[0][product_id]" class="form-control">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} - R$ {{ $product->price }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                {!! Form::text('items[0][amount]', 1, ['class' => 'form-control']) !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                {!! Form::submit('Criar pedido', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>

    </div>

@endsection

@section('post-script')

    <script type="text/javascript">
        $("#btn-new-item").on('click', function(){
            var row = $('table tbody > tr:last');
            var newRow = row.clone();
            var line = parseInt($('#amount-products-row').val());
            var newLine = line + 1;
            $('#amount-products-row').val(newLine);

            $.each(newRow.find('td'), function() {
                var td = $(this);
                var input = td.find('input,select');
                var name = input.prop('name');

                input.prop('name', name.replace(line + "", newLine + ""));
            });

            newRow.find('input').val(1);
            row.after(newRow);
            calculateTotal();
        });

        $(document.body).on('change', 'select, input[name*=amount]', function() {
            calculateTotal();
        });

        function calculateTotal() {
            var total = 0;
            var price = 0;
            var amount = 0;

            $.each($('table tbody tr'), function() {
                price = $(this).find(':selected').data('price');
                amount = $(this).find('input').val();
                total += price * amount;
            });

            $('#total').html(total);
        }

        calculateTotal();
    </script>

@endsection