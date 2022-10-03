@extends('backend.layouts.master')
@section('title', 'Create Package Pricing')
@section('backend')
    <!-- Content Header (Package Pricing header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Package Pricing</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Package Pricing</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.package_pricings.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Package*</label>
                                            <select name="package_id" class="form-control" required>
                                                <option value="">Select Package</option>
                                                @foreach($packages as $package)
                                                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Service limit implice:*</label>
                                            <select name="service_implice" class="form-control" required>
                                                <option value="">Select Package</option>
                                                <option value="1">Coin</option>
                                                <option value="2">Month</option>
                                                <option value="3">Year</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Package*</label>
                                    <select name="package_id" class="form-control" required>
                                        <option value="">Select Package</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="service_limit">Service Limit:<span class="text-danger">*</span></label>
                                            <input type="number" name="service_limit" class="form-control" id="service_limit"
                                                placeholder="Service Limit" value="{{ old('service_limit') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="price">Price:<span class="text-danger">*</span></label>
                                            <input type="number" name="price" class="form-control" id="price"
                                                placeholder="Price" value="{{ old('price') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="discount">Discount:</label>
                                            <input type="number" name="discount" class="form-control" id="discount"
                                                placeholder="Discount" value="{{ old('discount') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="discount">Discount price:</label>
                                            <input type="number" readonly name="discount_price" class="form-control"
                                                id="discount_price" placeholder="Discount price" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="badge">Badge:</label>
                                            <input type="text" name="badge" class="form-control" id="badge"
                                                placeholder="badge" value="{{ old('badge') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('jsScript')
    {{-- for discount price --}}
    <script type="text/javascript">
        $(function() {
            $("#price, #discount").on("keydown keyup", sum);

            function sum() {
                var price = Number($("#price").val());
                var discount = Number($("#discount").val());
                var discount_price = Number((price * discount) / 100);
                if (discount > 0) {
                    $("#discount_price").val(parseInt(price - discount_price));
                } else {
                    $("#discount_price").val(null);
                }
            }
        });
    </script>
@endsection