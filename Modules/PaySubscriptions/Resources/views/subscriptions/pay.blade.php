@extends('layouts.frontend')
@push('title', __('paysubscriptions::global.pay_subscriptions'))
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <strong>{{__('paysubscriptions::global.package')}}</strong>
                        <h4>{{ $package->name}}</h4>
                        <hr>
                        
                        <strong>{{__('paysubscriptions::global.interval.interval_count')}}</strong>
                        <h4>{{ __('paysubscriptions::global.interval.'.$package->interval) }}</h4>
                        <hr>
                        
                        <strong>{{__('paysubscriptions::global.trial_days')}}</strong>
                        <h4>{{ $package->trial_days }}</h4>
                        <hr>
                        
                        <strong>{{__('paysubscriptions::global.price')}}</strong>
                        <h4>{{ '$' . number_format($package->price, 2) }}</h4>
                        <hr>
                        
                        <strong>{{__('paysubscriptions::global.description')}}</strong>
                        <p>{!! $package->description !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form action="{{route('pay.subscription', $package->id)}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            {{__('paysubscriptions::global.payment_platform')}}
                        </div>
                        <div class="card-body">
                            <div class="form-group" id="toggler">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    @foreach (setting('paymentPlatforms') as $paymentPlatform)
                                    <label class="btn btn-outline-secondary rounded m-2 p-1" data-target="#{{ $paymentPlatform }}Collapse" data-toggle="collapse">
                                        <input type="radio" name="payment_platform" value="{{ $paymentPlatform }}" required>
                                        <img class="img-fluid" src="{{ asset('modules/paysubscriptions/img/' . $paymentPlatform . '.jpg') }}">
                                    </label>
                                    @endforeach
                                </div>
                                @foreach (setting('paymentPlatforms') as $paymentPlatform)
                                    <div id="{{ $paymentPlatform }}Collapse" class="collapse" data-parent="#toggler">
                                        @includeIf('paysubscriptions::components.' . strtolower($paymentPlatform) . '-collapse')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" id="payButton" class="btn btn-primary btn-lg btn-block">{{__('paysubscriptions::global.pay')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection