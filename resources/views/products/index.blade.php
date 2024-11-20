@extends('layouts.main')
@push('title')
    <title>Home</title>
@endpush
@section('main')
@include('products.navbar')
<div class="container">
    <div class="mt-4 text-right">
        <a href="{{ route('products.create') }}" class="btn btn-dark">Add Product</a>
    </div>
    <div class="table-responsive table-bordered my-3 p-3">
        <table class="table table-hover text-center ">
            <thead>
              <tr>
                <th>no</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td><a href="products/{{ $product->id }}/show" class="text-dark">{{ $product->name }}</a></td>
                <td>
                    <img src="products/{{ $product->image }}" class="rounded-circle" width="30" height="30">
                </td>
                <td>
                    <a href="products/{{ $product->id }}/edit" class="btn btn-success">Edit/Update</a>
                    <form action="products/{{ $product->id }}/delete" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>    
        <div class="row justify-content-center ">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
