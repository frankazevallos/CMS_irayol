<div class="modal fade" id="editMediaModal" tabindex="-1" aria-labelledby="editMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="editMediaModalLabel">{{__('global.edit')}}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="title">{{__('global.title')}}</label>
					<input type="text" class="form-control" name="title" id="titleMenuEdit" value="{{old('title')}}" required />
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="btnUpdateMenu" data-id="" class="btn btn-primary">{{__('global.save')}}</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">{{__('global.close')}}</button>
			</div>
      	</div>
    </div>
</div>
