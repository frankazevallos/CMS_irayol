<!-- Add and Edit section modal -->
<div class="modal fade" id="editMediaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMediaModalTitle">{{__('global.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <img src="" id="mediaModalImage" class="img-fluid rounded">
                    </div>
                    <div class="col-md-4">
                        <form name="editMediaModalForm" id="editMediaModalForm">
                            <div class="form-group">
                                <label for="titleFile">{{__('global.title')}}</label>
                                <input type="text" class="form-control" id="titleFile" required>
                            </div>
                            <hr>

                            <strong>{{__('global.created_at')}}</strong>
                            <p class="text-muted" id="mediaCreatedAt"></p>
                            <hr>

                            <strong>{{__('global.route')}}</strong>
                            <p class="text-muted" id="mediaPath"></p>
                            <hr>

                            <strong>{{__('global.size')}}</strong>
                            <p class="text-muted" id="mediaSize"></p>
                            <hr>
                            
                            <strong>{{__('global.options')}}</strong>
                            <p>
                                <a class="text-danger" href="javascript:void(0)" id="deleteMedia">{{__('global.delete')}}</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnUpdateMedia" class="btn btn-primary">{{__('global.save')}}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('global.close')}}</button>
            </div>
            
        </div>
    </div>
</div>