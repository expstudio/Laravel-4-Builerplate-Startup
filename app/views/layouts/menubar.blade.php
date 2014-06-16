<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/#">
                        {{ Setting::SITE_TITLE() }}
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right" id="side-menu">
                 <?php $menus = Menu::where('menu_id', '0')->orderBy('ordering', 'asc')->get(); ?>
                 <?php 
                    $current_menu=null;
                    if(isset($page))
                    {
                        $id = $page->slug;
                        $current_menu = Menu::where('path', 'like', "%pages/$id%")->first();
                    }
                 ?>
                 <?php $page_menu_id = $current_menu ? $current_menu->id : false; ?>
                 <?php $page_parent_menu_id = $current_menu ? $current_menu->menu_id : false; ?>
                 <?php
                    $top_menu_id = 0;
                    if($current_menu)
                    {
                        $top_menu = Menu::where('id', '=', $current_menu->menu_id)->first();
                        $top_menu_id = $top_menu ? $top_menu->menu_id : 0;
                    }
                 ?>                
                 
                @if ($menus->count())
                    @foreach ($menus as $menu)
                        <?php $submenus = Menu::where('menu_id', $menu->id)->get(); 
                            $right_cursor = $submenus->count() > 0 ? "<b class=\"caret\"></b>" : '';
                            $dropdown_child_class = $submenus->count() > 0 ? " class=\"dropdown-toggle scrollto\" data-toggle=\"dropdown\"" : 'class="scrollto"';
                            $active = false;
                            $active = $menu->id == $page_menu_id || $menu->id == $page_parent_menu_id || $menu->id == $top_menu_id;
                            $dropdown_class = $submenus->count() > 0 ? " class=\"dropdown\"" : '';

                            if($active)
                            {
                                $dropdown_class = $submenus->count() > 0 ? " class=\"active dropdown\"" : ' class="active"';
                            }
                        ?>
                        <li{{ $dropdown_class }}><a href="{{$menu->path}}" {{ $dropdown_child_class }} title="{{ $menu->title }}">{{ $menu->title }}{{ $right_cursor }}</i></a>
                        @if($submenus->count() > 0 )
                            <ul class="dropdown-menu">
                                @foreach ($submenus as $submenu)
                                <?php $lvsubmenus = Menu::where('menu_id', $submenu->id)->get(); 
                                    $active = false;
                                    $active = $submenu->id == $page_menu_id || $submenu->id == $page_parent_menu_id || $submenu->id == $top_menu_id;

                                    $right_cursor = $lvsubmenus->count() > 0 ? "<b class=\"caret\"></b>" : '';
                                    $dropdown_child_class = $lvsubmenus->count() > 0 ? " class=\"dropdown-toggle scrollto\" data-toggle=\"dropdown\"" : 'class="scrollto"';
                                    $dropdown_class = $lvsubmenus->count() > 0 ? " class=\"dropdown\"" : '';
                                    if($active)
                                    {
                                        $dropdown_class = $lvsubmenus->count() > 0 ? " class=\"active dropdown\"" : ' class="active"';
                                    }
                                ?>
                                <li{{ $dropdown_class }}><a href="{{$submenu->path}}" {{ $dropdown_child_class }} title="{{ $submenu->title }}">{{ $submenu->title }}{{ $right_cursor }}</a>                                    
                                    @if($lvsubmenus->count() > 0 )
                                    <ul class="dropdown-menu">
                                        @foreach ($lvsubmenus as $lvsubmenu)
                                        <li><a href="{{$lvsubmenu->path}}" class="scrollto thai-light" title="{{ $lvsubmenu->title }}">+ {{ $lvsubmenu->title }}</a></li>
                                        @endforeach 
                                    </ul>
                                     @endif
                                </li>
                                @endforeach 
                            </ul>
                        @endif
                        </li>                        
                    @endforeach 
                @endif  
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>