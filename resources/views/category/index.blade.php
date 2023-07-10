@extends('layouts.layout')

@section('content')
    <div>
        <a class="" href="{{ url('/admin') }}">home</a>
        <span>/category</span>
    </div>
    <div class="row">
        <section class="col-12 connectedSortable">

            <div class="card">
                <div class="card-header d-flex align-items-center ">
                    <h3 class="card-title mr-3">Category Table</h3>
                    <a href="{{ url('/admin/category/create') }}" class="btn col-md-1 btn-block btn-primary">Add <i class="nav-icon fas fa-inbox"></i></a>
                </div>
                <!-- ./card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td class="d-flex">
                                    <a href="{{ url("/admin/category/show/$category->id") }}" class="btn btn-primary">Show</a>
                                    <a class="btn btn-warning" href="{{ url("admin/category/edit/$category->id") }}">Edit</a>
                                    <form action="{{ url("/admin/category/delete/$category->id") }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
        <!-- right col -->
    </div>
@endsection
