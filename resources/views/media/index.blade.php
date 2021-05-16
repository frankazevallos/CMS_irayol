@extends('layouts.app')
@push('title', __('global.media'))
@section('content')
    <div class="card">
        <div class="card-header container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="float-left">
                        <form method='post' id="mediaForm" class="form-inline" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="files"><span class="btn btn-info"><i class="fas fa-plus-circle"></i> <span id="file_count">0</span></span></label>
                                <input type="file" id='files' name="files[]" hidden  multiple required><br>
                                <button type="submit" id="submit" class="btn btn-primary ml-2" disabled><i class="fas fa-file-upload"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="float-right form-inline">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input class="form-control" id="searchFiles" type="text" placeholder="{{__('global.search')}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary my-2 my-sm-0" id="clearSearchFiles" disabled><i class="fas fa-times-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Show media.items.blade.php --}}
        <div id="medias"></div>
    </div>
    @include('media.edit')
@endsection