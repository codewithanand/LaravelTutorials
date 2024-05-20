@extends('layouts.admin.master')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1>Category</h1>
        <a href="{{ url('/admin/categories/create') }}" class="btn btn-primary"><i class="fas fa-edit"></i> Add new</a>
    </div>

    <div class="row">
        <div class="col-md-12">

            @if (session("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session("error"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td><img src="{{ asset("uploads/categories/".$category->image) }}" alt="" height="40"></td>
                                    <td>
                                        <a class="btn btn-danger" href="#" onclick="document.getElementById('deleteForm').submit()"><i class="fas fa-trash"></i></a>
                                        <form action="{{route('categories.destroy', $category)}}" method="post" id="deleteForm">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
