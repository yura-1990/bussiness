@extends('layouts.layout')

@section('content')
    <div>
        <a class="" href="{{ url('/admin') }}">home</a>
        <a class="" href="{{ url('/admin/product') }}">/product</a>
        <span class="" >/{{ $product->id }}</span>
    </div>

    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="float-right d-flex">
                        <a href="{{ url('/admin/product') }}" class="btn btn-secondary mr-1">Back</a>
                        <a class="btn btn-warning mr-1" href="{{ url("/admin/product/edit/$product->id") }}">Edit</a>
                        <form action="{{ url("admin/product/delete/$product->id") }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </div>

                </div>
                <div class="col-12 col-sm-6">
                    <div class="col-12">
                        @if($product->image)
                            <img src="{{ env('APP_URL') . '/storage/' . $product->image }}" class="product-image" alt="Product Image">
                        @else
                            <p>No image </p>
                        @endif
                    </div>
                    <div class="col-12 product-image-thumbs">
                        {{--<div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div>--}}
                    </div>
                </div>
                <div class="col-12 col-sm-6">

                    <h3 class="my-3">{{ $product->name ?? 'no name'  }}</h3>
                    <hr>

                    <p>{{ $product->category->name ?? 'no category' }}</p>
                    <hr>

                    <div class="bg-white-30 py-2 px-3 mt-4">
                        <h2 class="mb-0">
                            ${{ $product->price ?? 'no price' }}
                        </h2>
                    </div>
                    <hr>

                    <p>{{ $product->description ?? 'no description' }}</p>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
@endsection
