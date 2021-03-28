@extends('layouts.app')
@push('title', __('paysubscriptions::global.pay_subscriptions'))
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{route('paysubscriptions.index')}}" class="list-group-item list-group-item-action ">{{__('paysubscriptions::global.packages')}}</a>
            <a href="{{route('subscriptions.index')}}" class="list-group-item list-group-item-action active">{{__('paysubscriptions::global.subscriptions')}}</a>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header clearfix">
                <div class="float-left">
                    {{__('paysubscriptions::global.subscriptions')}}
                </div>
                <div class="btn-group-sm float-right" role="group">
                    <a href="{{ route('subscriptions.create') }}" class="btn btn-success" title="{{__('paysubscriptions::global.new')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('paysubscriptions::global.create')}}</a>
                </div>
            </div>
            <div class="card-body p-0">
                @if (count($subscriptions) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{__('paysubscriptions::global.name')}}</th>
                                <th>{{__('paysubscriptions::global.package')}}</th>
                                <th>{{__('paysubscriptions::global.status')}}</th>
                                <th>{{__('paysubscriptions::global.start_date')}}</th>
                                <th>{{__('paysubscriptions::global.end_date')}}</th>
                                <th>{{__('paysubscriptions::global.trial_end_date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscriptions as $subscription)
                            <tr>
                                <td><a href="{{ route('users.show', $subscription->user->id ) }}">{{$subscription->user->name}}</a></td>
                                <td><a href="{{ route('packages.show', $subscription->package->id) }}">{{$subscription->package->name}}</td>
                                <th>{{__('paysubscriptions::global.' . $subscription->status) }}</th>
                                <th>{{$subscription->start_date}}</th>
                                <th>{{$subscription->end_date}}</th>
                                <th>{{$subscription->trial_end_date}}</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="alert alert-warning m-3" role="alert">{{__('paysubscriptions::global.did_not_find_any_record')}}</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection