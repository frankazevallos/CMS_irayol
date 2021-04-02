<form method="POST" action="{{ route('packages.destroy', $id) }}" accept-charset="UTF-8">
    @method('DELETE')
    @csrf
    <div class="btn-group-xs float-right" role="group">
        <a href="{{ route('packages.show', $id) }}" class="btn btn-info btn-sm" title="{{__('paysubscriptions::global.view')}}">
            <i class="far fa-eye" aria-hidden="true"></i>
        </a>
        <a href="{{ route('packages.edit', $id) }}" class="btn btn-primary btn-sm" title="{{__('paysubscriptions::global.edit')}}">
            <i class="fas fa-pencil-alt"></i>
        </a>
        <button type="submit" class="btn btn-danger btn-sm" title="{{__('paysubscriptions::global.delete')}}" onclick="return confirm(&quot; {{__('paysubscriptions::global.confirm_delete')}} &quot;)">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</form>