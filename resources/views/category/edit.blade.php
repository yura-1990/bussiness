@extends('layouts.layout')

@section('content')
    <div>
        <a class="" href="{{ url('/admin') }}">home</a>
        <a class="" href="{{ url('/admin/category') }}">/category</a>
        <span class="" >/edit</span>
        <span class="" >/{{ $category->id }}</span>
    </div>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Category</h3>
                </div>
                <form action="{{ url("/admin/category/update/$category->id") }}" id="quickForm" novalidate="novalidate" method="post" >
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $category->name }}" placeholder="Category name" autocomplete="off">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group">
                            <select class="form-control @error('parent_id') is-invalid @enderror"   name="parent_id" >
                                @error('parent_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <option value="{{ $category->parent_id ?? '' }}"> {{ $categories[$category->parent_id]->name ?? 'No date' }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ url('/admin/category') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
