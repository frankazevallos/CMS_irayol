<div class="row">
  	<div class="col-md-6">
		<div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
            <label for="user_id">{{__('paysubscriptions::global.user')}}</label>
            <select class="form-control" name="user_id" id="user_id" data-id="">
                  <option value="{{optional($subscription)->user_id}}">{{ old('user_id', optional($subscription)->user->name)}}</option>
            </select>
            {{ $errors->first('user_id', '<p class="help-block">:message</p>') }}
        </div>
  	</div>
  	<div class="col-md-6">
		<div class="form-group {{ $errors->has('package_id') ? 'has-error' : '' }}">
            <label for="package_id">{{__('paysubscriptions::global.package')}}</label>
            <select class="form-control" name="package_id" id="package_id" data-id="">
                  <option value="{{optional($subscription)->package_id}}">{{ old('package_id', optional($subscription)->package->name)}}</option>
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
                              <option value="{{$key}}" {{ old('status', optional($subscription)->status) == $key ? 'selected' : '' }}>{{$status}}</option>
                        @endforeach
                  </select>
                  {{ $errors->first('status', '<p class="help-block">:message</p>') }}
            </div>
      </div>
      <div class="col-md-6">
            <div class="form-group">
                  <label for="start_date">{{__('paysubscriptions::global.start_date')}}</label>
                  <input type="text" class="form-control datetimepicker-input" id="start_date" name="start_date" value="{{ old('start_date', optional($subscription)->start_date)}}" data-toggle="datetimepicker" data-target="#start_date"/>
            </div>
      </div>
</div>