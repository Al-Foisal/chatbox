@extends('backend.layouts.master')
@section('title', 'Package Pricing ')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Package Pricing </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Package Pricing</li>
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
                            <a href="{{ route('admin.package_pricings.create') }}" class="btn btn-outline-primary">Add
                                Package Pricing</a>
                            <br>
                            <br>
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Package Name</th>
                                        <th>Service Limit</th>
                                        <th>Service Implice</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Discount Price</th>
                                        <th>Badge</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($package_pricing as $pricing)
                                        <tr>
                                            <td class="d-flex justify-content-around">
                                                <a href="{{ route('admin.package_pricings.edit', $pricing) }}"
                                                    class="btn btn-info btn-xs"> <i class="fas fa-edit"></i> Edit</a>
                                            </td>
                                            <td>{{ $pricing->package->name }}</td>
                                            <td>{{ $pricing->service_limit }}</td>
                                            <td>{{ $pricing->service_implice }}</td>
                                            <td> {{ $pricing->price }} </td>
                                            <td> {{ $pricing->discount }} </td>
                                            <td> {{ $pricing->discount_price }} </td>
                                            <td> {{ $pricing->badge }} </td>
                                            <td>{{ $pricing->created_at }}</td>
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
