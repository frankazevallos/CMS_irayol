<div class="modal fade" id="editSettingModal" tabindex="-1" aria-labelledby="editSettingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="editSettingModalLabel">{{__('global.edit')}}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
				<div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
                    <label for="key" class="control-label">Key</label>
                    <input class="form-control" name="key" type="text" id="key"  minlength="1" maxlength="191" required readonly>
                </div>

                <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                    <label for="value" class="control-label">Value</label>
                    <input class="form-control" name="value" type="text" id="value"  minlength="1" maxlength="191" required>
                </div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="btnUpdateSetting" data-id="" class="btn btn-primary">{{__('global.save')}}</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">{{__('global.close')}}</button>
			</div>
      	</div>
    </div>
</div>
