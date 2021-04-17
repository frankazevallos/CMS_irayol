<!--Main Image Modal-->
<div class="modal fade" id="insertImageModal" tabindex="-1" role="dialog" aria-labelledby="insertImageModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('global.select_img')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="insertFiles"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" data-id="" id="MainPhoto" type="button">{{__('global.insert')}}</button>
                <button class="btn btn-primary" data-dismiss="modal" type="button">{{__('global.cancel')}}</button>
            </div>
        </div>
    </div>
</div>
<!--Main Image Modal-->