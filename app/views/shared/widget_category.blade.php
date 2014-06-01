<!-- /widget -->

                        <div class="row widget">
                            <div class="col-md-12">
                                <div class="categories-widget">
                                    <h3 class="widget-title">
                                        ประเภท
                                    </h3>
                                    <ul>
                                        @foreach($categories as $category)
                                        <li>
                                            <a href="{{ url(action('PostsController@index_category', $category->slug)) }}">{{ $category->name_th }}</a> ({{$category->posts()->count()}})
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /widget -->                        