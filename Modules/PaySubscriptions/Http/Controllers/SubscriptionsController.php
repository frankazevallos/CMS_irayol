<?php

namespace Modules\PaySubscriptions\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PaySubscriptions\Entities\Package;
use Modules\PaySubscriptions\Entities\Subscription;
use Modules\PaySubscriptions\Http\Requests\SubscriptionRequest;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $subscriptions = Subscription::paginate();
        return view('paysubscriptions::subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        return view('paysubscriptions::subscriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(SubscriptionRequest $request)
    {
        try {
            $package = Package::where('id', $request->package_id)->first();
            $dt = Carbon::create($request->start_date);
            $trial_end_date = $package->trial_days > 0 ? $dt->addDays($package->trial_days) : null;
            
            if ($package->interval == 'days') {
                $end_date = $dt->addDays($package->interval_count);
            } elseif ($package->interval == 'months') {
                $end_date = $dt->addMonths($package->interval_count);
            } else {
                $end_date = $dt->addYears($package->interval_count);
            }
            
            Subscription::create([
                'user_id' => $request->user_id,
                'package_id' => $request->package_id,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'trial_end_date' => $trial_end_date,
                'end_date' => $end_date,
                'created_id' => auth()->user()->id,
                'package_price' => $package->price,
                'package_details' => $package->description,
                'paid_via' => 'offline',
                'payment_transaction_id' => null,
            ]);
            
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
        return view('paysubscriptions::subscriptions.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('paysubscriptions::subscriptions.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUser(Request $request) {        
        $search = $request->search;
        $users = [];
        
        if($search == ''){
            $users = User::orderby('name','asc')->select('id','name')->limit(5)->get();
        }else{
            $users = User::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(10)->get();
        }
        
        return response()->json($users);
    }

    public function getPackage(Request $request) {        
        $search = $request->search;
        $packages = [];
        
        if($search == ''){
            $packages = Package::orderby('name','asc')->select('id','name')->where('is_active', 1)->limit(5)->get();
        }else{
            $packages = Package::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->where('is_active', 1)->limit(10)->get();
        }
        return response()->json($packages);
    }
}
