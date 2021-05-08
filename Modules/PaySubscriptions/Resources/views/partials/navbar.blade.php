<div class="list-group">
    <a href="{{route('paysubscriptions.index')}}" class="list-group-item list-group-item-action {{ request()->routeIs('paysubscriptions.index') ? 'active' : ''  }}">
        {{__('paysubscriptions::global.packages')}}
    </a>
    <a href="{{route('subscriptions.index')}}" class="list-group-item list-group-item-action {{ request()->routeIs('subscriptions.index') ? 'active' : ''  }}">
        {{__('paysubscriptions::global.subscriptions')}}
    </a>
    <a href="{{route('pay-settings.index')}}" class="list-group-item list-group-item-action {{ request()->routeIs('pay-settings.index') ? 'active' : ''  }}">
        {{__('paysubscriptions::global.pay_setting')}}
    </a>
</div>