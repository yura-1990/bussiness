@extends('layouts.layout')

@section('content')
    <div>
        <a class="" href="{{ url('/admin') }}">home</a>
        <span>/product</span>
    </div>
    <div class="row">
        <section class="col-12 connectedSortable">

            <div class="card">
                <div class="card-header d-flex align-items-center ">
                    <h3 class="card-title mr-3">Product Table</h3>
                    <a href="{{ url('/admin/product/create') }}" class="btn col-md-1 btn-block btn-primary">Add <i class="nav-icon fas fa-inbox"></i></a>
                </div>
                <!-- ./card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Existence</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name ?? '' }}</td>
                                <td>{{ $product->price ?? '' }}</td>
                                <td><img width="90" src="{{ env('APP_URL') . '/storage/' . $product->image ?? '' }}"></td>
                                <td>{{ $product->description ?? '' }}</td>
                                <td>{{ $product->exist ?? 0 }}</td>
                                <td>{{ $product->category->name ?? '' }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ url("/admin/product/show/$product->id") }}">Show</a>
                                    <a class="btn btn-warning" href="{{ url("admin/product/edit/$product->id") }}">Edit</a>
                                    <form action="{{ url("admin/product/delete/$product->id") }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $products->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
        <!-- right col -->
    </div>
@endsection
