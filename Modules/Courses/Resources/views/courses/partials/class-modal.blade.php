<!-- Add and Edit classes modal -->
<div class="modal fade" id="classesModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="classModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="classForm" id="classForm">
                    <input type="hidden" name="class_id" id="class_id">
                    <div class="form-group">
                        <label for="title_class">{{__('courses::global.title')}}</label>
                        <input type="text" class="form-control" id="title_class" name="title_class" required>
                        <span class="text-danger error-text title_class_err"></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="section_class_id">{{__('courses::global.select_section')}}</label>
                                <select class="form-control select2" id="section_class_id" name="section_class_id" required>
                                    @foreach ($sections as $section)
                                        <option value="{{$section->id}}">{{$section->title}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text section_class_id_err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_active">{{__('courses::global.is_active')}}</label>
                                <select class="form-control select2" id="is_active" name="is_active" required>
                                    @foreach ($data = array( 1 => __('courses::global.yes'), 0 => __('courses::global.no')) as $key => $is_active)
                                        <option value="{{$key}}">{{$is_active}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text is_active_err"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="media_type">{{__('courses::global.media_type')}}</label>
                                <select class="form-control select2" id="media_type" name="media_type" required>
                                    @foreach ($data = array('vimeo' => __('courses::global.video_src.vimeo'), 'youtube' => __('courses::global.video_src.youtube')) as $key => $media_type)
                                        <option value="{{$key}}">{{$media_type}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text media_type_err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="url">{{__('courses::global.url')}}</label>
                                <input type="text" class="form-control" id="url" name="url" required>
                                <span class="text-danger error-text url_err"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration">{{__('courses::global.duration')}}</label>
                                <input type="text" class="form-control" id="duration" name="duration" required>
                                <span class="text-danger error-text duration_err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="access">{{__('courses::global.access')}}</label>
                                <select class="form-control select2" id="access" name="access" required>
                                    @foreach ($data = array('pay' => __('courses::global.pay'), 'free' => __('courses::global.free')) as $key => $access)
                                        <option value="{{$key}}">{{$access}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text access_err"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="note">{{__('courses::global.note')}}</label>
                        <textarea class="form-control summernote" name="note" id="note" cols="10" rows="5" required></textarea>
                        <span class="text-danger error-text note_err"></span>
                    </div>

                    <div class="form-group float-right">
                        <a href="javascript:void(0)" class="btn btn-primary insertButtonClass" data-id="" id="btnCreateClass">{{__('courses::global.save')}}</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('courses::global.close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
