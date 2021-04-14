<div class="dropdown">
    <a class="btn btn-info" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>
  
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        <form method="POST" action="{{ route('page.destroy', $id) }}" accept-charset="UTF-8">
            @method('DELETE')
            @csrf
                <a href="{{ route('page.show', $slug) }}" target="_blank" class="dropdown-item" title="{{__('global.view')}}">
                    <i class="far fa-eye" aria-hidden="true"></i> {{__('global.view')}}
                </a>
                <a href="{{ route('page.edit', $id) }}" class="dropdown-item" title="{{__('global.edit')}}">
                    <i class="fas fa-pencil-alt"></i> {{__('global.edit')}}
                </a>
                <button type="submit" class="dropdown-item" title="{{__('global.delete')}}" onclick="return confirm(&quot; {{__('paysubscriptions::global.confirm_delete')}} &quot;)">
                    <i class="fas fa-trash"></i> {{__('global.delete')}}
                </button>
        </form>
    </div>
</div>