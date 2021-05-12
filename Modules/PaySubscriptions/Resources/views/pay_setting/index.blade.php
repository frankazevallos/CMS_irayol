@extends('layouts.app')
@push('title', __('paysubscriptions::global.pay_subscriptions'))
@section('content')
<div class="row">
    <div class="col-md-3 mb-3">
        @include('paysubscriptions::partials.navbar')
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                {{__('paysubscriptions::global.pay_setting')}}
            </div>
        </div>
        <form action="{{route('pay-settings.store')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-header font-weight-bold text-uppercase">Stripe</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stripe_key">Stripe Key</label>
                                <input type="text" class="form-control" name="stripe_key" id="stripe_key" value="{{ setting('stripe_key') }}"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stripe_secret">Stripe Secret</label>
                                <input type="text" class="form-control" name="stripe_secret" id="stripe_secret" value="{{ setting('stripe_secret') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stripe_sandbox">Stripe Sandbox</label>
                                <select class="form-control" name="stripe_sandbox" id="stripe_sandbox">
                                    <option selected="" disabled>{{__('paysubscriptions::global.select_option')}}</option>
                                    @foreach ($data = array(true => __('paysubscriptions::global.live'), false => __('paysubscriptions::global.test')) as $key => $sandbox)
                                        <option value="{{$key}}" {{ old('stripe_sandbox', setting('stripe_sandbox')) == $key ? 'selected' : '' }}>{{$sandbox}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header font-weight-bold text-uppercase">Paypal</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="paypal_key">PayPal Key</label>
                                <input type="text" class="form-control" name="paypal_key" id="paypal_key" value="{{ setting('paypal_key') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="paypal_secret">PayPal Secret</label>
                                <input type="text" class="form-control" name="paypal_secret" id="paypal_secret" value="{{ setting('paypal_secret') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="paypal_sandbox">PayPal Sandbox</label>
                                <select class="form-control" name="paypal_sandbox" id="paypal_sandbox">
                                    <option selected="" disabled>{{__('paysubscriptions::global.select_option')}}</option>
                                    @foreach ($data = array(true => __('paysubscriptions::global.live'), false => __('paysubscriptions::global.test')) as $key => $sandbox)
                                        <option value="{{$key}}" {{ old('paypal_sandbox', setting('paypal_sandbox')) == $key ? 'selected' : '' }}>{{$sandbox}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header font-weight-bold text-uppercase">Wompi</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="wompi_key">Wompi Key</label>
                                <input type="text" class="form-control" name="wompi_key" id="wompi_key" value="{{ setting('wompi_key') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="wompi_secret">Wompi Secret</label>
                                <input type="text" class="form-control" name="wompi_secret" id="wompi_secret" value="{{ setting('wompi_secret') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="wompi_sandbox">Wompi Sandbox</label>
                                <select class="form-control" name="wompi_sandbox" id="wompi_sandbox">
                                    <option selected="" disabled>{{__('paysubscriptions::global.select_option')}}</option>
                                    @foreach ($data = array(true => __('paysubscriptions::global.live'), false => __('paysubscriptions::global.test')) as $key => $sandbox)
                                        <option value="{{$key}}" {{ old('wompi_sandbox', setting('wompi_sandbox')) == $key ? 'selected' : '' }}>{{$sandbox}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-footer">
                    <input class="btn btn-primary float-right" type="submit" value="{{__('global.save')}}">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')
    <script src="{{asset('modules/paysubscriptions/js/main.js')}}"></script>
@endpush
