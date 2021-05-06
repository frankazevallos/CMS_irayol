@extends('layouts.app')
@push('title', __('paysubscriptions::global.pay_subscriptions'))
@section('content')
<div class="card">
    <div class="card-header clearfix">
        <div class="float-left">
            {{ __('paysubscriptions::global.subscription')}}
        </div>
        <div class="btn-group-sm float-right" role="group">
            <form method="POST" action="{!! route('subscriptions.destroy', $subscription->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group-sm" role="group">
                    <a href="{{ route('subscriptions.index') }}" class="btn btn-primary" title="{{__('paysubscriptions::global.return_back')}}">
                        <i class="fa fa-undo" aria-hidden="true"></i> {{__('paysubscriptions::global.return_back')}}
                    </a>

                    <a href="{{ route('subscriptions.create') }}" class="btn btn-success" title="{{__('paysubscriptions::global.create')}}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('paysubscriptions::global.create')}}
                    </a>

                    <a href="{{ route('subscriptions.edit', $subscription->id ) }}" class="btn btn-primary" title="{{__('paysubscriptions::global.edit')}}">
                        <i class="fas fa-pencil-alt"></i> {{__('paysubscriptions::global.edit')}}
                    </a>
                    
                    <button type="submit" class="btn btn-danger" title="{{__('paysubscriptions::global.delete')}}" onclick="return confirm(&quot;{{__('paysubscriptions::global.confirm_delete')}}&quot;)">
                        <i class="fas fa-trash"></i> {{__('paysubscriptions::global.delete')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <strong>{{__('paysubscriptions::global.name')}}</strong>
        <p class="text-muted"><a href="{{ route('users.show', $subscription->user->id ) }}">{{$subscription->user->name}}</a></p>
        <hr>

        <strong>{{__('paysubscriptions::global.package')}}</strong>
        <p class="text-muted"><a href="{{ route('packages.show', $subscription->package->id) }}">{{$subscription->package->name}}</a></p>
        <hr>

        <strong>{{__('paysubscriptions::global.paid_via')}}</strong>
        <p class="text-muted">{{ $subscription->paid_via }}</p>
        <hr>

        <strong>{{__('paysubscriptions::global.status')}}</strong>
        <p class="text-muted">{{__('paysubscriptions::global.' . $subscription->status) }}</p>
        <hr>

        <strong>{{__('paysubscriptions::global.start_date')}}</strong>
        <p class="text-muted">{{$subscription->start_date}}</p>
        <hr>

        <strong>{{__('paysubscriptions::global.trial_end_date')}}</strong>
        <p class="text-muted">{{$subscription->trial_end_date ? $subscription->trial_end_date : __('paysubscriptions::global.no_trial_period')}}</p>
        <hr>

        <strong>{{__('paysubscriptions::global.end_date')}}</strong>
        <p class="text-muted">{{$subscription->end_date }}</p>
        <hr>

        <strong>{{__('paysubscriptions::global.price')}}</strong>
        <p class="text-muted">{{ '$' . number_format($subscription->package_price, 2)  }}</p>
        <hr>

        <strong>{{__('paysubscriptions::global.description')}}</strong>
        <p class="text-muted">{{ $subscription->package_details }}</p>
        <hr>

        
    </div>
</div>
@endsection