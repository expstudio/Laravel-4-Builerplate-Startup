<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li class="treeview{{ (strpos(Route::currentRouteAction(), 'PagesController') !== FALSE) ? " active" : ""; }}">
                        <a href="{{ action('admin\PagesController@index'); }}">
                            <i class="fa fa-file-o fa-fw"></i> Pages
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ action('admin\PagesController@create'); }}"><i class="fa fa-plus-square-o"></i> เพิ่มเพจ</a></li>
                            <li><a href="{{ action('admin\PagesController@index'); }}"><i class="fa fa-th"></i> รายการเพจทั้งหมด</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ action('admin\SettingsController@index'); }}"><i class="fa fa-gears fa-fw"></i> Settings</a>
                    </li>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->