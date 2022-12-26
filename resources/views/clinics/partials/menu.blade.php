@isset($clinic)

@if(Auth::user()->hasAnyRoles(['root', 'admin', 'veterinarian']) )
<li class="nav-item">
    <a class="nav-link" href="{{route('clinics.show', $clinic)}}">{{__('translate.dashboard')}}</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('clinics.owners.index', $clinic)}}">{{__('translate.owners')}}</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('clinics.pets.index', $clinic)}}">{{__('translate.pets')}}</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('clinics.calendars.show', $clinic)}}">{{__('translate.calendar')}}</a>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        {{__('translate.clinic')}}
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

        @if(Auth::user()->hasAnyRoles(['admin']) )
        <a class="dropdown-item" href="{{route('clinics.users.list', $clinic)}}">{{__('translate.users')}}</a>
        <a class="dropdown-item" href="{{route('clinics.species.index', $clinic)}}">{{__('translate.species')}}</a>
        <!--
        @todo
            <a class="dropdown-item" href="#">{{__('translate.preferences')}}</a>
        -->
        <div class="dropdown-divider"></div>
        @endif

        <a class="dropdown-item" href="{{route('clinics.join')}}">{{__('translate.join')}}</a>
        <a class="dropdown-item" href="{{route('clinics.create')}}">{{__('translate.create')}}</a>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#contact-modal">{{__('translate.contact')}}</a>
</li>

<li class="nav-item">
    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</li>
@endif

@endisset