@extends('layouts.layout')

@section('content')
    <div>
        <a class="" href="{{ url('/admin') }}">home</a>
        <a class="" href="{{ url('/admin/category') }}">/category</a>
        <span class="" >/create</span>
    </div>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('/admin/category/store') }}" id="quickForm" novalidate="novalidate" method="post" >
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Category name" autocomplete="off">
                        </div>

                        <div class="input-group">
                            <select class="form-control" name="parent_id" >
                                <option value=""> {{ count($categories) > 0 ? 'Choose category' : 'No date' }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ url('/admin/category') }}" class="btn btn-secondary">Back</a>
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
