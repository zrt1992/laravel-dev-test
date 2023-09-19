@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Card</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <th scope="row">{{$order->id}}</th>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->product->name}}</td>
                                <td>{{$order->card_number}}</td>
                                <td>{{$order->total}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{route('payment.refund',$order->id)}}" role="button">REFUND</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-8 text-center">
                <a class="btn btn-success" href="{{route('products')}}" role="button">See Products</a>
            </div>
        </div>
    </div>
@endsection
