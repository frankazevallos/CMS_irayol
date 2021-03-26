<?php

namespace Modules\PaySubscriptions\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PaySubscriptions\Entities\Package;
use Modules\PaySubscriptions\Http\Requests\PackageRequest;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $packages = Package::paginate();
        return view('paysubscriptions::index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('paysubscriptions::packages.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PackageRequest $request)
    {        
        try {
            $package = new Package($request->all());
            $package->user_id = auth()->user()->id;
            $package->save();

            return redirect()->back()->with('success', __('paysubscriptions::global.successfully_added'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $package = Package::where('id', $id)->first();
            return view('paysubscriptions::packages.show', compact('package'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $package = Package::where('id', $id)->first();
            return view('paysubscriptions::packages.edit', compact('package'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(PackageRequest $request, $id)
    {
        try {
            $package = Package::findOrFail($id);

            $package->update([
                'name' => $request->name,
                'description' => $request->description,
                'interval' => $request->interval,
                'interval_count' => $request->interval_count,
                'trial_days' => $request->trial_days,
                'price' => $request->price,
                'is_active' => $request->is_active,
                'is_private' => $request->is_private,
                'is_one_time' => $request->is_one_time,
                'enable_custom_link' => $request->enable_custom_link,
                'custom_link' => $request->custom_link,
                'custom_link_text' => $request->custom_link_text,
            ]);

            return redirect()->back()->with('success', __('paysubscriptions::global.successfully_updated'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            Package::where('id', $id)->delete();
            return redirect()->back()->with('warning', __('paysubscriptions::global.successfully_destroy'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }
}
