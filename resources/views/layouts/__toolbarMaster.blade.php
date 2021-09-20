<!-- TopBar -->
<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <?php
            $index = explode(".", request()->route()->getName());
            //dd($index);
            ?>
            @if($index[0]!="")
                @if(isset($index[1]))
                    @if($index[1]=='index')
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form action="{{ route(request()->route()->getName()) }}" method="get"
                                  class="navbar-search">
                                <div class="input-group">
                                    <input name="search" type="text" class="form-control bg-light border-1 small"
                                           placeholder="Buscar {{ $index[0] }}..."
                                           aria-label="Search" aria-describedby="basic-addon2" autofocus
                                           style="border-color: #3f51b5;">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                @endif
            @endif

        </li>

        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="{{asset('images/user.jpg')}}" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    @if(!empty(Auth::user()->getRoleNames()))
                        @foreach(Auth::user()->getRoleNames() as $v)
                            {{ $v }}<br>
                        @endforeach
                    @endif
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- Topbar -->