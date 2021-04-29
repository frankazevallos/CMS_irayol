<!-- Add and Edit Section modal -->
<div class="modal fade" id="section-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sectionModal"></h5>
            </div>
            <div class="modal-body">
                <form name="sectionForm" id="sectionForm">
                    <input type="hidden" id="course_id" name="course_id" value="{{$course->id}}">

                    <input type="hidden" name="section_id" id="section_id">

                    <div class="form-group">
                        <label for="title">{{__('courses::global.title')}}</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="form-group float-right">
                        <button type="submit" id="btn-save" value="create" class="btn btn-primary">{{__('courses::global.save')}}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('courses::global.close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
