@extends('app')

@section('content')

    <div class="container">
        <h3>Pedido #{{ $order->id }} - R$ {{ $order->total }}</h3>
        <h4>Cliente: {{ $order->client->user->name }}</h4>
        <h4 class="small">Data: {{ $order->created_at }}</h4>

        @include('errors._check')

        <p>
            <strong>Entregar em:</strong> <br>
            {{ $order->client->address }} - {{ $order->client->city }} - {{ $order->client->state }}
        </p>
        <br>

        {!! Form::model($order, ['route' => ['admin.orders.update', $order->id]]) !!}

        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('status', $list_status, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('entregador', 'Entregador:') !!}
            {!! Form::select('user_deliveryman_id', $deliveryman, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}


    </div>

@endsection