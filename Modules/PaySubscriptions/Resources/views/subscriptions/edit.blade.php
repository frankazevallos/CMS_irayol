@extends('layouts.app')
@push('title', __('paysubscriptions::global.pay_subscriptions'))
@section('content')
<div class="card">
    <div class="card-header clearfix">
        <div class="float-left">
            {{ __('paysubscriptions::global.subscription') . ' '. $subscription->name}}
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
                    
                    <button type="submit" class="btn btn-danger" title="{{__('paysubscriptions::global.delete')}}" onclick="return confirm(&quot;{{__('paysubscriptions::global.confirm_delete')}}&quot;)">
                        <i class="fas fa-trash"></i> {{__('paysubscriptions::global.delete')}}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('subscriptions.update', $subscription->id) }}" id="edit_subscription_form" name="edit_subscription_form" accept-charset="UTF-8" class="form-horizontal">
            @method('PUT')
            @csrf
            @include ('paysubscriptions::subscriptions.form', ['subscription' => $subscription,])
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Update">
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="{{asset('modules/paysubscriptions/js/main.js')}}"></script>
@endpush