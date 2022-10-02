<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageDetail;
use Illuminate\Http\Request;

class PackageDetailsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $package_details = PackageDetail::all();

        return view('backend.package_details.index', compact('package_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $packages = Package::all();

        return view('backend.package_details.create', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        PackageDetail::create($request->all());

        return to_route('admin.package_details.index')->withToastSuccess('Package details added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageDetail $package_detail) {
        $packages = Package::all();

        return view('backend.package_details.edit', compact('package_detail', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackageDetail $package_detail) {
        $package_detail->update($request->all());

        return to_route('admin.package_details.index')->withToastSuccess('Package details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageDetail $package_detail) {
        $package_detail->delete();

        return to_route('admin.package_details.index')->withToastSuccess('Package details deleted');
    }
}
