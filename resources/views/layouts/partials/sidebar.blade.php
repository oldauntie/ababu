<div id="sidebar" class="collapse show collapse-horizontal col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">

    <div class="d-flex flex-column align-items-center align-items-sm-start px-0 pt-2 text-white min-vh-100">
        {{-- 
    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-5 d-none d-sm-inline text-white">Menu</span>
    </a>
    --}}
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link align-middle px-0 text-white">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('clinics.show', $clinic) }}" class="nav-link align-middle px-0 text-white">
                    <i class="fs-4 bi-speedometer2"></i> <span
                        class="ms-1 d-none d-sm-inline">{{ __('translate.dashboard') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link align-middle px-0 text-white">
                    <i class="fs-4 bi-file-earmark-person"></i> <span
                        class="ms-1 d-none d-sm-inline">{{ __('translate.owners') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link align-middle px-0 text-white">
                    <i class="fs-4 bi-calendar"></i> <span
                        class="ms-1 d-none d-sm-inline">{{ __('translate.calendar') }}</span>
                </a>
            </li>
            {{--
        <li>
            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
            <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                <li class="w-100">
                    <a href="#" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                </li>
                <li>
                    <a href="#" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                </li>
            </ul>
        </li>
        --}}
            <li>
                <a href="#" class="nav-link px-0 align-middle text-white">
                    <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
            </li>



            {{--
        <li>
            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                <li class="w-100">
                    <a href="#" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline">Item</span> 1</a>
                </li>
                <li>
                    <a href="#" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline">Item</span> 2</a>
                </li>
            </ul>
        </li>
        --}}

            <li>
                <a href="#submenu-clinic" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                    <i class="fs-4 bi-hospital"></i> <span
                        class="ms-1 d-none d-sm-inline">{{ __('translate.clinic') }}</span> </a>
                <ul class="collapse nav flex-column ms-1" id="submenu-clinic" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link px-0 text-white"> <span
                                class="d-none d-sm-inline">Product</span>
                            1</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 text-white"> <span
                                class="d-none d-sm-inline">Product</span>
                            2</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 text-white"> <span
                                class="d-none d-sm-inline">Product</span>
                            3</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 text-white"> <span
                                class="d-none d-sm-inline">Product</span>
                            4</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="nav-link px-0 align-middle text-white">
                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
            </li>
            <li>
                <a href="#" class="nav-link px-0 align-middle text-white">
                    <i class="fs-4 bi-envelope"></i> <span
                        class="ms-1 d-none d-sm-inline">{{ __('translate.contact') }}</span></a>
            </li>
        </ul>

        {{--
    <!-- User menu / circle icon -->
    <hr>
    <div class="dropdown pb-4">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
            <span class="d-none d-sm-inline mx-1">user</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
    --}}


    </div>
</div>
