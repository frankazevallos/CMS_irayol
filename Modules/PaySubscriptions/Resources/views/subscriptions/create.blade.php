@extends('layouts.app')

@push('title', __('paysubscriptions::global.pay_subscriptions'))

@section('content')
<div class="card">
    <div class="card-header clearfix">        
        <span class="float-left">
            {{__('paysubscriptions::global.new')}}
        </span>
        <div class="btn-group-sm float-right" role="group">
            <a href="{{ route('subscriptions.index') }}" class="btn btn-primary" title="{{__('global.return_back')}}">
                <i class="fa fa-undo" aria-hidden="true"></i> {{__('paysubscriptions::global.return_back')}}
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('subscriptions.store') }}" accept-charset="UTF-8" id="create_package_form" name="create_package_form" class="form-horizontal">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                        <label for="user_id">{{__('paysubscriptions::global.user')}}</label>
                        <select class="form-control" name="user_id" id="user_id" data-id="">
                                
                        </select>
                        {{ $errors->first('user_id', '<p class="help-block">:message</p>') }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('package_id') ? 'has-error' : '' }}">
                        <label for="package_id">{{__('paysubscriptions::global.package')}}</label>
                        <select class="form-control" name="package_id" id="package_id" data-id="">
                                
                        </select>
                        {!! $errors->first('package_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label for="status">{{__('paysubscriptions::global.status')}}</label>
                                <select class="form-control select2" name="status" id="status" >
                                    <option selected="" disabled>{{__('paysubscriptions::global.select_option')}}</option>
                                    @foreach ($data = array('approved' => __('paysubscriptions::global.approved'), 'waiting' => __('paysubscriptions::global.waiting'), 'declined' => __('paysubscriptions::global.declined')); as $key => $status)
                                            <option value="{{$key}}" {{ old('status')}}>{{$status}}</option>
                                    @endforeach
                                </select>
                                {{ $errors->first('status', '<p class="help-block">:message</p>') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="start_date">{{__('paysubscriptions::global.start_date')}}</label>
                                <input type="text" class="form-control datetimepicker-input" id="start_date" name="start_date" value="{{  date('Y-m-d h:m') }}" data-toggle="datetimepicker" data-target="#start_date"/>
                        </div>
                    </div>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="{{__('paysubscriptions::global.save')}}">
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="{{asset('modules/paysubscriptions/js/main.js')}}"></script>
@endpush