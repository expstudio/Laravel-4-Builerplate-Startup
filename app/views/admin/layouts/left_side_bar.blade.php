@if ( !Auth::guest() )
<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
            
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ url('/admin') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    @if(Setting::ENABLE_POST() == true )
                    <li class="treeview{{ (strpos(Route::currentRouteAction(), 'PostsController') !== FALSE) || ((strpos(Route::currentRouteAction(), 'CategoriesController') !== FALSE) && !(strpos(Route::currentRouteAction(), 'ProductCategoriesController') !== FALSE)) ? " active" : ""; }}">
                        <a href="{{ action('admin\PostsController@index'); }}"><i class="fa fa-bullhorn fa-fw"></i> Post
                        <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ action('admin\PostsController@create'); }}"><i class="fa fa-plus-square-o"></i> Add post</a></li>
                            <li><a href="{{ action('admin\PostsController@index'); }}"><i class="fa fa-th"></i> All Posts</a></li>
                            <li><a href="{{ action('admin\CategoriesController@index'); }}"><i class="fa fa-th-list"></i> Add Category</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ action('admin\CategoriesController@index'); }}"><i class="fa fa-th-list"></i> Post Categories</a></li>
                    @endif

                    @if(Setting::ENABLE_PORTFOLIO() == true )
                    <li class="treeview{{ (strpos(Route::currentRouteAction(), 'PortfoliosController') !== FALSE) ? " active" : ""; }}">
                        <a href="{{ action('admin\PortfoliosController@index'); }}"><i class="fa fa-lightbulb-o  fa-fw"></i> Portfolio
                        <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ action('admin\PortfoliosController@create'); }}"><i class="fa fa-plus-square-o"></i> Add Portfolio</a></li>
                            <li><a href="{{ action('admin\PortfoliosController@index'); }}"><i class="fa fa-th"></i> All Portfolios</a></li>
                        </ul>
                    </li>
                    @endif

                    @if(Setting::ENABLE_PRODUCT() == true )
                    <li class="treeview{{ (strpos(Route::currentRouteAction(), 'ProductsController') !== FALSE) || (strpos(Route::currentRouteAction(), 'ProductCategoriesController') !== FALSE) ? " active" : ""; }}">
                        <a href="{{ action('admin\ProductsController@index'); }}"><i class="fa fa-shopping-cart fa-fw"></i> Product
                        <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ action('admin\ProductsController@create'); }}"><i class="fa fa-plus-square-o"></i> Add Product</a></li>
                            <li><a href="{{ action('admin\ProductsController@index'); }}"><i class="fa fa-th"></i> All Product</a></li>
                            <li><a href="{{ action('admin\ProductCategoriesController@index'); }}"><i class="fa fa-th-list"></i> Product Categories</a></li>
                        </ul>
                    </li>
                    @endif

                    <li class="treeview{{ (strpos(Route::currentRouteAction(), 'UsersController') !== FALSE) ? " active" : ""; }}">
                        <a href="{{ action('admin\UsersController@index'); }}"><i class="fa fa-users fa-fw"></i> User
                        <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ action('admin\UsersController@create'); }}"><i class="fa fa-plus-square-o"></i> Add User</a></li>
                            <li><a href="{{ action('admin\UsersController@index'); }}"><i class="fa fa-th"></i> All Users</a></li>
                        </ul>
                    </li>
                    <li class="treeview{{ (strpos(Route::currentRouteAction(), 'PagesController') !== FALSE) ? " active" : ""; }}">
                        <a href="{{ action('admin\PagesController@index'); }}">
                            <i class="fa fa-file-o fa-fw"></i> Page
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ action('admin\PagesController@create'); }}"><i class="fa fa-plus-square-o"></i> Add Page</a></li>
                            <li><a href="{{ action('admin\PagesController@index'); }}"><i class="fa fa-th"></i> All Pages</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ action('admin\MenusController@index'); }}"><i class="fa fa-list fa-fw"></i> Menu</a>
                    </li>
                    <li><a href="{{ action('admin\SettingsController@index'); }}"><i class="fa fa-gears fa-fw"></i> Settings</a>
                    </li>
                </ul>
                <!-- /#side-menu -->
                
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->
@endif        