@extends('layouts.main')
@push('title')
    <title>Edit</title>
@endpush
@section('main')
@include('products.navbar')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-sm-8">
            <div class="card my-5 p-3">
                <h2 class="text-muted">Product Update: {{ $product->name }}</h2>
                <form action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name',$product->name) }}"/>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea rows="5" name="description" class="form-control">{{ old('description',$product->description) }}
                        </textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control" value="{{ old('image',$product->image )}}"/>
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('products.index') }}" class="btn btn-danger">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection

