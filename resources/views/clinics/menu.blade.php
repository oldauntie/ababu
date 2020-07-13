@isset($clinic)

@if(Auth::user()->hasAnyRoles(['root', 'admin', 'veterinarian']) )
<li class="nav-item">
    <a class="nav-link" href="{{route('clinics.show', $clinic)}}">{{__('translate.dashboard')}}</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('clinics.pets.index', $clinic)}}">{{__('translate.pets')}}</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">{{__('translate.owners')}}</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">{{__('translate.calendar')}}</a>
</li>
<li class="nav-item">
    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        {{__('translate.clinic')}}
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('clinics.show', $clinic->id)}}">{{__('translate.dashboard')}}</a>
        <a class="dropdown-item" href="{{route('clinics.create')}}">{{__('translate.create')}}</a>

        @if(Auth::user()->hasAnyRoles(['admin']) )
            <a class="dropdown-item" href="{{route('clinics.users.list', $clinic)}}">{{__('translate.users')}}</a>
            <a class="dropdown-item" href="{{route('clinics.species.index', $clinic)}}">{{__('translate.species')}}</a>
            <a class="dropdown-item" href="#">{{__('translate.preferences')}}</a>
        @endif

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{route('home')}}">Exit</a>
    </div>
</li>
@endif

@endisset
