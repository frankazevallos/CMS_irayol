<?php

namespace Modules\PaySubscriptions\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
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

            $start_date_one = Carbon::create($request->start_date);
            
            $trial_date = $package->trial_days > 0 ? $start_date_one->addDays($package->trial_days) : null;

            $start_date_two = new Carbon($trial_date);

            if ($package->interval == 'days') {
                $end_date = $start_date_two->addDays($package->interval_count);
            } elseif ($package->interval == 'months') {
                $end_date = $start_date_two->addMonths($package->interval_count);
            } elseif ($package->interval == 'years') {
                $end_date = $start_date_two->addYears($package->interval_count);
            }
            
            Subscription::create([
                'user_id' => $request->user_id,
                'package_id' => $request->package_id,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'trial_end_date' => $trial_date,
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
    public function edit(Subscription $subscription)
    {
        return view('paysubscriptions::subscriptions.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(SubscriptionRequest $request, $id)
    {
        try {
            $package = Package::where('id', $request->package_id)->first();

            $start_date_one = Carbon::create($request->start_date);
            
            $trial_date = $package->trial_days > 0 ? $start_date_one->addDays($package->trial_days) : null;

            $start_date_two = new Carbon($trial_date);

            if ($package->interval == 'days') {
                $end_date = $start_date_two->addDays($package->interval_count);
            } elseif ($package->interval == 'months') {
                $end_date = $start_date_two->addMonths($package->interval_count);
            } elseif ($package->interval == 'years') {
                $end_date = $start_date_two->addYears($package->interval_count);
            }

            $subscription = Subscription::findOrFail($id);

            $subscription->update([
                'user_id' => $request->user_id,
                'package_id' => $request->package_id,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'trial_end_date' => $trial_date,
                'end_date' => $end_date,
            ]);

            return redirect()->route('subscriptions.index')->with('success', __('paysubscriptions::global.successfully_updated'));
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
            Subscription::where('id', $id)->delete();
            return redirect()->back()->with('warning', __('paysubscriptions::global.successfully_destroy'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }

    public function ajaxIndex(Request $request){
        $data = Subscription::select('id', 'user_id', 'package_id', 'status', 'start_date', 'end_date', 'trial_end_date');

        return Datatables::of($data)
        ->addColumn('user', function($data){
            $user = '<a href=" '. route('users.show', $data->user->id) . ' ">' .$data->user->name . '</a>';
            return $user;
        })
        ->addColumn('package', function($data){
            $package = '<a href=" '. route('packages.show', $data->package->id) . ' ">' .$data->package->name . '</a>';
            return $package;
        })
        ->addColumn('trial_end_date', function($data){
            $trial_end_date = $data->trial_end_date ? $data->trial_end_date : __('paysubscriptions::global.no_trial_period');
            return $trial_end_date;
        })
        ->addColumn('status', function($data){
            $status = __('paysubscriptions::global.' . $data->status);
            return $status;
        })
        ->addColumn('action', 'paysubscriptions::subscriptions.actions' ) //add view actions
        ->rawColumns(['user', 'package', 'status', 'trial_end_date', 'action'])->make(true);
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
