<div class="dropdown">
    <a class="btn btn-info" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>
  
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        <form method="POST" action="{{ route('subscriptions.destroy', $id) }}" accept-charset="UTF-8">
            @method('DELETE')
            @csrf
                <a href="{{ route('subscriptions.show', $id) }}" title="{{__('paysubscriptions::global.view')}}">
                    <i class="far fa-eye" aria-hidden="true"></i>
                </a>
                <a href="{{ route('subscriptions.edit', $id) }}" title="{{__('paysubscriptions::global.edit')}}">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <button type="submit" title="{{__('paysubscriptions::global.delete')}}" onclick="return confirm(&quot; {{__('paysubscriptions::global.confirm_delete')}} &quot;)">
                    <i class="fas fa-trash"></i>
                </button>
        </form>
    </div>
</div>