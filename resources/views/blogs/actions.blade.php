<div class="dropdown">
    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        <form name="editPageForm" id="editBlogForm-{{$id}}">
                <a href="{{ route('blog.show', $slug) }}" target="_blank" class="dropdown-item" title="{{__('global.view')}}">
                    <i class="far fa-eye" aria-hidden="true"></i> {{__('global.view')}}
                </a>
                <a href="{{ route('blogs.edit', $id) }}" class="dropdown-item" title="{{__('global.edit')}}">
                    <i class="fas fa-pencil-alt"></i> {{__('global.edit')}}
                </a>
                <a class="dropdown-item" href="javascript:void(0)" id="deleteBlog" data-id="{{$id}}"><i class="fas fa-trash"></i> {{__('global.delete')}}</a>
        </form>
    </div>
</div>
