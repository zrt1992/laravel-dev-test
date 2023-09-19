@extends('layouts.app')

@section('content')
<div class="container d-flex flex-wrap bg-light p-2 ">
    @foreach ($products as $product)
        <div class="col-3 d-flex justify-items-center flex-column me-2 mb-2 border rounded p-2">
            <img src="{{Vite::asset('resources/images/p_1.png')}}" alt="" class="rounded" style="width: 100%; height: 200px !important"/>
            <h5 class="mt-2">
                <span class="text-primary">Product Name : </span> {{$product->name}}
            </h5>
            <div class="d-flex justify-content-between align-items-center">
                <h5>
                    <span class="text-primary">Price :</span> {{$product->price}} {{$product->currency}}
                </h5>
                
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h5>
                        <span class="text-primary">Type :</span> {{$product->type}}
                    </h5>
                
                <a class="btn btn-success" href="{{route('verify-card',$product->id)}}">Buy</a>
            </div>
        </div>
    @endforeach
</div>
@endsection