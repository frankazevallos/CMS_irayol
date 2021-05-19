<!--Post Image Modal-->
<div class="modal fade" id="insertMediaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <form method='post' id="mediaForm" class="form-inline" action="javascript:void(0)" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="files"><span class="btn btn-info btn-sm"><i class="fas fa-plus-circle"></i> <span id="file_count">0</span></span></label>
                            <input type="file" id='files' name="files[]" hidden multiple required><br>
                            <button type="submit" id="submit" class="btn btn-primary btn-sm ml-2" disabled><i class="fas fa-file-upload"></i></button>
                        </div>
                    </form>
                </div>

                <h5>{{__('global.select_file')}}</h5>
                
                <div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div id="insertFiles"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary insertButtonFile" data-dismiss="modal" data-file="" id="insertFileSrc" type="button">{{__('global.insert')}}</button>
                <button class="btn btn-primary" data-dismiss="modal" type="button">{{__('global.cancel')}}</button>
            </div>
        </div>
    </div>
</div>
<!--Post Image Modal-->