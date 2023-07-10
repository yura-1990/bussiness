@extends('layouts.layout')

@section('content')
    <div>
        <a class="" href="{{ url('/admin') }}">home</a>
        <a class="" href="{{ url('/admin/category') }}">/category</a>
        <span class="" >/show</span>
        <span class="" >/{{ $category->id }}</span>
    </div>

    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1>Category Info</h1>
                        <div class="d-flex">
                            <a href="{{ url('/admin/category') }}" class="btn btn-secondary mr-1">Back</a>
                            <a class="btn btn-warning mr-1" href="{{ url("/admin/category/edit/$category->id") }}">Edit</a>
                            <form action="{{ url("/admin/category/delete/$category->id") }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>

                    </div>
                    <hr>
                </div>
                <div class="col-12 ">
                    <h4>Category name: </h4>
                    <h3 class="my-3">{{ $category->name ?? 'no name'  }}</h3>
                    <hr>

                    @if(count($parentCategories) > 0)
                        <h4>Subcategories:</h4>
                        @foreach($parentCategories as $category)
                            <p><a href="{{ url("/admin/category/show/$category->id") }}">{{ $category->name }} </a>
                                </p>
                            <hr>
                        @endforeach
                    @else
                        <p>{{ 'no subcategory' }}</p>
                    @endif


                </div>




            </div>

        </div>
        <!-- /.card-body -->
    </div>
@endsection
