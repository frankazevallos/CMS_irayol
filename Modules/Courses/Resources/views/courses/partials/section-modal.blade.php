<!-- Add Section modal -->
<div class="modal fade" id="sectionModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="sectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sectionModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="sectionForm" id="sectionForm">
                    <input type="hidden" id="idCourseCreate" name="course_id" value="{{$course->id}}">

                    <div class="form-group">
                        <label for="title">{{__('courses::global.title')}}</label>
                        <input type="text" class="form-control" id="titleSectionCreate" name="title" required>
                    </div>

                    <div class="form-group float-right">
                        <a href="javascript:void(0)" class="btn btn-primary insertButtonSection" data-id="" id="btnCreateSection">{{__('courses::global.save')}}</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('courses::global.close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
