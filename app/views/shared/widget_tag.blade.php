<div class="row widget">
                            <div class="col-md-12">
                                <div class="popular-post-widget">
                                    <h3 class="widget-title">
                                        คำสำคัญ
                                    </h3>
                                    <?php
                                    $tag_list = null;
                                    if(isset($tags))
                                    {
                                        $tag_list = Tag::whereIn('name', explode(',', strtolower($tags)))->get();

                                    }
                                    else
                                    {
                                        $tag_list = Tag::all();
                                    }
                                    ?>
                                    <ul>
                                        @foreach($tag_list as $tag)
                                        <li>
                                            <a href="{{ url(action('PostsController@index_tag', $tag->slug)) }}" class="tag-item">{{$tag->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /widget -->