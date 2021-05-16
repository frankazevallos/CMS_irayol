<div class="dropdown">
    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        <form method="POST" action="{{ route('subscriptions.destroy', $id) }}" accept-charset="UTF-8">
            @method('DELETE')
            @csrf
            <a href="{{ route('subscriptions.show', $id) }}" class="dropdown-item" title="{{__('paysubscriptions::global.view')}}">
                <i class="far fa-eye" aria-hidden="true"></i> {{__('paysubscriptions::global.view')}}
            </a>
            <a href="{{ route('subscriptions.edit', $id) }}" class="dropdown-item" title="{{__('paysubscriptions::global.edit')}}">
                <i class="fas fa-pencil-alt"></i> {{__('paysubscriptions::global.edit')}}
            </a>
            <button type="submit" title="{{__('paysubscriptions::global.delete')}}" class="dropdown-item"
                onclick="return confirm(&quot; {{__('paysubscriptions::global.confirm_delete')}} &quot;)">
                <i class="fas fa-trash"></i> {{__('paysubscriptions::global.delete')}}
            </button>
        </form>
    </div>
</div>