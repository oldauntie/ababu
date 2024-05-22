@isset($clinic)

@if(Auth::user()->hasAnyRoles(['root', 'admin', 'veterinarian'], $clinic) )
<li class="nav-item">
    <a class="nav-link" href="{{route('home')}}">{{__('translate.home')}}</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('clinics.show', $clinic)}}">{{__('translate.dashboard')}}</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('clinics.owners.index', $clinic)}}">{{__('translate.owners')}}</a>
</li>
@endif

@endisset