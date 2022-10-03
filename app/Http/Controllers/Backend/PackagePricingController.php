<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackagePricing;
use Illuminate\Http\Request;

class PackagePricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $package_pricing = PackagePricing::all();

        return view('backend.package_pricing.index', compact('package_pricing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $packages = Package::all();

        return view('backend.package_pricing.create', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        PackagePricing::create($request->all());

        return to_route('admin.package_pricings.index')->withToastSuccess('Package price added');
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
    public function edit(PackagePricing $package_pricing) {
        $packages = Package::all();

        return view('backend.package_pricing.edit', compact('package_pricing', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackagePricing $package_pricing) {
        $package_pricing->update($request->all());

        return to_route('admin.package_pricings.index')->withToastSuccess('Package pricing updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(PackageDetail $package_detail) {
    //     $package_detail->delete();

    //     return to_route('admin.package_details.index')->withToastSuccess('Package details deleted');
    // }
}
