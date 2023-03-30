<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        <a href="index.html">Master Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">MD</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
           
            @foreach (getMenus() as $menu)
          
                @if(count($menu->subMenus) > 0)
                    @can('read ' .$menu->url)
                    <li class="nav-item dropdown {{ request()->segment(1) == $menu->url ? 'active open' : ''}}">
                        <a href="{{url($menu->url)}}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="{{$menu->icon}}"></i> <span> {{$menu->name}}</span></a>
                        <ul class="dropdown-menu {{ request()->segment(1) == $menu->url ? 'expand' : ''}}">
                           
                                @foreach($menu->subMenus as $submenu)
                                    @can('read ' .$submenu->url)
                                        <li class="{{ request()->segment(1) == explode($submenu->url,$menu->url)[0] && request()->segment(2) == $submenu->url ? 'active' : ''}}"><a class="nav-link" href="{{url($submenu->url)}}">{{$submenu->name}}</a></li>
                                    @endcan                                
                                @endforeach
                           
                        </ul>
                    </li>
                    @endcan
                @else
                @can('read ' .$menu->url)
                    <li class="nav-item {{ request()->segment(1) == $menu->url ? 'active' : ''}}">
                        <a href="{{url($menu->url)}}" class="nav-link"><i class="{{$menu->icon}}"></i><span> {{$menu->name}}</span></a>
                    </li>
                @endcan
                @endif
            @endforeach
        
            

        <!-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> -->
    </aside>
</div>