@extends('layouts.main')
@push('title')
    <title>Show</title>
@endpush
@section('main')
@include('products.navbar')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-sm-8">
            <div class="card p-3 my-5">
                <p><b>Name : </b>{{ $product->name }}</p>
                <p><b>Description : </b>{{ $product->description }}</p>
                <img src="/products/{{ $product->image }}" class="rounded img-fluid ">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection