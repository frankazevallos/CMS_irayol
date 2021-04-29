<!-- Add and Edit classes modal -->
<div class="modal fade" id="classes-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="classesModal"></h5>
            </div>
            <div class="modal-body">
                <form name="classForm" id="classForm">

                    <input type="hidden" name="class_id" id="class_id">

                    <div class="form-group">
                        <label for="title_class">{{__('courses::global.title')}}</label>
                        <input type="text" class="form-control" id="title_class" name="title_class">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="section_class_id">{{__('courses::global.select_section')}}</label>
                                <select class="form-control" id="section_class_id" name="section_class_id">
                                    <option selected="" disabled>{{__('courses::global.choose_an_option')}}</option>
                                    @foreach ($sections as $section)
                                    <option value="{{$section->id}}">{{$section->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_active">{{__('courses::global.is_active')}}</label>
                                <select class="form-control" id="is_active" name="is_active">
                                    <option selected="" disabled>{{__('courses::global.choose_an_option')}}</option>
                                    @foreach ($data = array( 1 => __('courses::global.yes'), 0 =>
                                    __('courses::global.no')) as $key => $is_active)
                                    <option value="{{$key}}">{{$is_active}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="media_type">{{__('courses::global.media_type')}}</label>
                                <select class="form-control" id="media_type" name="media_type">
                                    <option selected="" disabled>{{__('courses::global.choose_an_option')}}</option>
                                    @foreach ($data = array('vimeo' => __('courses::global.video_src.vimeo'), 'youtube'
                                    => __('courses::global.video_src.youtube')) as $key => $media_type)
                                    <option value="{{$key}}">{{$media_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="url">{{__('courses::global.url')}}</label>
                                <input type="text" class="form-control" id="url" name="url">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration">{{__('courses::global.duration')}}</label>
                                <input type="text" class="form-control" id="duration" name="duration">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="access">{{__('courses::global.access')}}</label>
                                <select class="form-control" id="access" name="access">
                                    <option selected="" disabled>{{__('courses::global.choose_an_option')}}</option>
                                    @foreach ($data = array('pay' => __('courses::global.pay'), 'free' =>
                                    __('courses::global.free')) as $key => $access)
                                    <option value="{{$key}}">{{$access}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="note">Nota</label>
                        <textarea class="form-control summernote" name="note" id="note" cols="30" rows="5"></textarea>
                    </div>

                    <div class="form-group float-right">
                        <button type="submit" id="btn_save" value="create_class"
                            class="btn btn-primary">{{__('courses::global.save')}}</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{__('courses::global.close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
