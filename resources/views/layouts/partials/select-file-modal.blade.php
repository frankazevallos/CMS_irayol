<!--Post Image Modal-->
<div class="modal fade" id="insertMediaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('global.select_file')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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