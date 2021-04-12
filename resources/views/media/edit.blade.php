<!-- Add and Edit section modal -->
<div class="modal fade" id="editMediaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMediaModalTitle">{{__('global.edit')}}</h5>
            </div>
            <form name="editMediaModalForm" id="editMediaModalForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="mediaModalImage" class="img-fluid rounded">
                        </div>
                        <div class="col-md-4">
                            <strong>{{__('global.created_at')}}</strong>
                            <p class="text-muted" id="mediaCcreatedAt"></p>
                            <hr>
                            <strong>{{__('global.route')}}</strong>
                            <p class="text-muted" id="mediaPath"></p>
                            <hr>
                            <div class="form-group">
                                <label for="titleFile">{{__('global.title')}}</label>
                                <input type="text" class="form-control" id="titleFile">
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-save" value="create" class="btn btn-info">{{__('global.save')}}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('global.close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>