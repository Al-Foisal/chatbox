<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/package/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        PackageDetail::create([
            'package_id' => $request->package_id,
            'image'      => $final_name1,
            'title'      => $request->title,
            'details'    => $request->details,
        ]);

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

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($package_detail->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/package/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $package_detail->image = $final_name1;
                $package_detail->save();
            }

        }

        $package_detail->package_id = $request->package_id;
        $package_detail->title      = $request->title;
        $package_detail->details    = $request->details;
        $package_detail->save();

        return to_route('admin.package_details.index')->withToastSuccess('Package details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageDetail $package_detail) {
        $image_path = public_path($package_detail->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $package_detail->delete();

        return to_route('admin.package_details.index')->withToastSuccess('Package details deleted');
    }

}
