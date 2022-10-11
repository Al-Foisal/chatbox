@extends('backend.layouts.master')
@section('title', 'Package Details ')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Package Details </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Package Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.package_details.create') }}" class="btn btn-outline-primary">Add Package Details</a>
                            <br>
                            <br>
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Package Name</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Details</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($package_details as $detail)
                                        <tr>
                                            <td class="d-flex justify-content-around">
                                                <a href="{{ route('admin.package_details.edit', $detail) }}"
                                                    class="btn btn-info btn-xs"> <i class="fas fa-edit"></i> Edit</a>
                                                
                                                <form action="{{ route('admin.package_details.destroy', $detail) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        onclick="return(confirm('Are you sure want to delete this item?'))"
                                                        class="btn btn-danger btn-xs"> <i class="fas fa-trash-alt"> Delete</i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $detail->package->name }}</td>
                                            <td>
                                                <img src="{{ asset($detail->image) }}" style="height:50px;width:50px">
                                            </td>
                                            <td>{{ $detail->title }}</td>
                                            <td>
                                                {{ $detail->details }}
                                            </td>
                                            <td>{{ $detail->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('jsLink')
@endsection
@section('jsScript')
@endsection
