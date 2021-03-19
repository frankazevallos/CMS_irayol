<div class="row">
    <div class="col-md-5">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="control-label">{{__('paysubscriptions::global.title')}}</label>
            <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($package)->name) }}" minlength="1" required>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('interval') ? 'has-error' : '' }}">
            <label for="interval">{{__('paysubscriptions::global.interval.title')}}</label>
            <select class="form-control" name="interval" id="interval" >
                <option selected="" disabled>{{__('paysubscriptions::global.select_option')}}</option>
                @foreach ($data = array('days' => __('paysubscriptions::global.interval.days'), 'months' => __('paysubscriptions::global.interval.months'), 'years' => __('paysubscriptions::global.interval.years')); as $key => $interval)                                    
                    <option value="{{$key}}" {{ old('interval', optional($package)->interval) == $key ? 'selected' : '' }}>{{$interval}}</option>
                @endforeach
            </select>
            {!! $errors->first('interval', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('interval_count') ? 'has-error' : '' }}">
            <label for="interval_count" class="control-label">{{__('paysubscriptions::global.interval.interval_count')}}</label>
            <input class="form-control" name="interval_count" type="number" id="interval_count" value="{{ old('interval_count', optional($package)->interval_count) }}" min="0" required>
            {!! $errors->first('interval_count', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('trial_days') ? 'has-error' : '' }}">
            <label for="trial_days" class="control-label">{{__('paysubscriptions::global.trial_days')}}</label>
            <input class="form-control" name="trial_days" type="number" id="trial_days" value="{{ old('trial_days', optional($package)->trial_days) }}" min="0" required>
            {!! $errors->first('trial_days', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
            <label for="price" class="control-label">{{__('paysubscriptions::global.price')}}</label>
            <input class="form-control" name="price" type="number" id="price" value="{{ old('price', optional($package)->price) }}" min="0" step="any" required>
            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="control-label">{{__('paysubscriptions::global.description')}}</label>
    <textarea class="form-control" name="description" id="description" cols="30" rows="3" required>{{ old('description', optional($package)->description) }}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <div class="checkbox">
                <label for="is_active_1">
                    <input id="is_active_1" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($package)->is_active) == '1' ? 'checked' : '' }}>
                    {{__('paysubscriptions::global.is_active')}}
                </label>
            </div>
            {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('is_one_time') ? 'has-error' : '' }}">
            <div class="checkbox">
                <label for="is_one_time">
                    <input id="is_one_time" name="is_one_time" type="checkbox" value="1" {{ old('is_one_time', optional($package)->is_one_time) == '1' ? 'checked' : '' }}>
                    {{__('paysubscriptions::global.is_one_time')}}
                </label>
            </div>
            {!! $errors->first('is_one_time', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('is_private') ? 'has-error' : '' }}">
            <div class="checkbox">
                <label for="is_private">
                    <input id="is_private" name="is_private" type="checkbox" value="1" {{ old('is_private', optional($package)->is_private) == '1' ? 'checked' : '' }}>
                    {{__('paysubscriptions::global.is_private')}}
                </label>
            </div>
            {!! $errors->first('is_private', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('enable_custom_link') ? 'has-error' : '' }}">
            <div class="checkbox">
                <label for="enable_custom_link">
                    <input id="enable_custom_link" name="enable_custom_link" type="checkbox" value="1" {{ old('enable_custom_link', optional($package)->enable_custom_link) == '1' ? 'checked' : '' }}>
                    {{__('paysubscriptions::global.enable_custom_link')}}
                </label>
            </div>
            {!! $errors->first('enable_custom_link', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row" id="show_enable_custom_link">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('custom_link') ? 'has-error' : '' }}">
            <label for="custom_link" class="control-label">{{__('paysubscriptions::global.custom_link')}}</label>
            <input class="form-control" name="custom_link" type="text" id="custom_link" value="{{ old('custom_link', optional($package)->custom_link) }}">
            {!! $errors->first('custom_link', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('custom_link_text') ? 'has-error' : '' }}">
            <label for="custom_link_text" class="control-label">{{__('paysubscriptions::global.custom_link_text')}}</label>
            <input class="form-control" name="custom_link_text" type="text" id="custom_link_text" value="{{ old('custom_link_text', optional($package)->custom_link_text) }}">
            {!! $errors->first('custom_link_text', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>