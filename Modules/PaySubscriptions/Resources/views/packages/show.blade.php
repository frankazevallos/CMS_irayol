@extends('layouts.app')

@push('title', __('paysubscriptions::global.pay_subscriptions'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-left">
                {{ __('paysubscriptions::global.package') . ' '. $package->name}}
            </div>
            <div class="btn-group-sm float-right" role="group">
                <form method="POST" action="{!! route('packages.destroy', $package->id) !!}" accept-charset="UTF-8">
                    <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}
                    <div class="btn-group-sm" role="group">
                        <a href="{{ route('paysubscriptions.index') }}" class="btn btn-primary" title="{{__('paysubscriptions::global.return_back')}}">
                            <i class="fa fa-undo" aria-hidden="true"></i> {{__('paysubscriptions::global.return_back')}}
                        </a>
    
                        <a href="{{ route('packages.create') }}" class="btn btn-success" title="{{__('paysubscriptions::global.create')}}">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('paysubscriptions::global.create')}}
                        </a>
                        
                        <a href="{{ route('packages.edit', $package->id ) }}" class="btn btn-primary" title="{{__('paysubscriptions::global.edit')}}">
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
            <strong>{{__('paysubscriptions::global.title')}}</strong>
            <p class="text-muted">{{ $package->name}}</p>
            <hr>

            <strong>{{__('paysubscriptions::global.interval.title')}}</strong>
            <p class="text-muted">{{ __('paysubscriptions::global.interval.'.$package->interval) }}</p>
            <hr>

            <strong>{{__('paysubscriptions::global.interval.interval_count')}}</strong>
            <p class="text-muted">{{ $package->interval_count }}</p>
            <hr>

            <strong>{{__('paysubscriptions::global.trial_days')}}</strong>
            <p class="text-muted">{{ $package->trial_days }}</p>
            <hr>

            <strong>{{__('paysubscriptions::global.price')}}</strong>
            <p class="text-muted">{{ '$' . number_format($package->price, 2) }}</p>
            <hr>

            <strong>{{__('paysubscriptions::global.description')}}</strong>
            <p class="text-muted">{{ $package->description }}</p>
            <hr>

            <strong>{{__('paysubscriptions::global.is_active')}}</strong>
            <p class="text-muted">{{ $package->is_active == 1 ? __('paysubscriptions::global.yes') : __('paysubscriptions::global.no') }}</p>
            <hr>

            <strong>{{__('paysubscriptions::global.is_one_time')}}</strong>
            <p class="text-muted">{{ $package->is_one_time == 1 ? __('paysubscriptions::global.yes') : __('paysubscriptions::global.no') }}</p>
            <hr>

            <strong>{{__('paysubscriptions::global.is_private')}}</strong>
            <p class="text-muted">{{ $package->is_private == 1 ? __('paysubscriptions::global.yes') : __('paysubscriptions::global.no') }}</p>
            <hr>

            <strong>{{__('paysubscriptions::global.enable_custom_link')}}</strong>
            <p class="text-muted">{{ $package->enable_custom_link == 1 ? __('paysubscriptions::global.yes') : __('paysubscriptions::global.no') }}</p>
            <hr>

            <strong>{{__('paysubscriptions::global.custom_link')}}</strong>
            <p class="text-muted">{{ $package->custom_link }}</p>
            <hr>

            <strong>{{__('paysubscriptions::global.custom_link_text')}}</strong>
            <p class="text-muted">{{ $package->custom_link_text }}</p>
            <hr>
        </div>
    </div>
@endsection