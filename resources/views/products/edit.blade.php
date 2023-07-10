@extends('layouts.layout')

@section('content')
    <div>
        <a class="" href="{{ url('/admin') }}">home</a>
        <a class="" href="{{ url('/admin/product') }}">/product</a>
        <span class="" >/edit</span><span class="" >/{{ $product->id }}</span>
    </div>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url("/admin/product/update/$product->id") }}" id="quickForm" novalidate="novalidate" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body row">
                            <div class="input-group col-12">
                                <input type="text" name="name" class="form-control" id="name" value="{{ $product->name ?? '' }}"  placeholder="Product name" autocomplete="off">
                            </div>
                            <div class="input-group col-6 mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="price" value="{{ $product->price ?? '' }}" class="form-control" id="price" placeholder="Price" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <div class="input-group col-6 mt-3">
                                <input type="number" name="exist" value="{{ $product->exist ?? '' }}" class="form-control" id="exist" placeholder="Exist" autocomplete="off">
                            </div>


                            <div class="form-group mt-3 col-12">
                                @if($product->image)
                                    <img width="150" class="m-3 rounded" src="{{ env('APP_URL') . '/storage/' . $product->image }}" alt="">
                                @endif
                                <label for="file" class="btn btn-success col fileinput-button dz-clickable">
                                    <i class="fas fa-plus"></i>
                                    <input hidden="true"  type="file" class="" name="image" id="file">
                                    <span>Add Image</span>
                                </label>
                            </div>

                            <div class="form-group col-12">
                                <textarea class="form-control" rows="3" name="description" placeholder="Description ... ">{{ $product->description ?? "" }}</textarea>
                            </div>

                            <div class="input-group col-12">
                                <select class="form-control" name="category_id">
                                    <option value="{{ $product->category->id ?? '' }}">{{ $product->category->name ?? "No category" }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ url('/admin/product') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
    </div>
@endsection
