@extends('layouts.application')

@section('title')
{{$product->title}}
@stop

@section('style')
{{$product->style}}
@stop

@section('main')

<!-- BEGIN BLOG -->
            <section id="blog" class="blog">
                <div class="row">
                    <div class="col-md-9">
                        <div id="primary" class="row">
                            <div class="col-md-12">
                                <!-- BEGIN ARTICLE -->
                                <article class="post">
                                    <div class="post-thumb">
                                        <a href="{{ url(action('ProductsController@show', $product->slug)) }}">
                                            <img src="{{ url($product->cover->url('large')) }}" alt="{{ $product->title }}" />
                                        </a>
                                    </div>
                                    <div class="post-title">
                                        <h1><a href="{{ url(action('ProductsController@show', $product->slug)) }}">{{ $product->title }}</a>
                                        </h1>
                                    </div>
                                    <div class="post-meta">
                                        <span class="dates">{{ date("d F Y",strtotime($product->created_at)) }}</span>
                                    </div>
                                    <div class="post-content">
                                        <p>{{ $product->content }}
                                        </p>

                                    </div>
                                </article>
                                <!-- END ARTICLE -->
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-3 widgetbar">
                        <div class="categories-widget">
                            <h3 class="widget-title thai-regular">
                                แบบบ้าน รุ่น {{ $product->code() }}
                            </h3>
                            <ul>
                                {{ "<li>ห้องนอนห้อง</li>"}}
                                <li>
                                    ห้องน้ำ 2       ห้อง
                                </li>
                                <li>
                                    ที่จอดรถ    2       คัน
                                </li>
                                <li>
                                    พื้นที่ใช้สอย   234     ตารางเมตร
                                </li>
                                <li>
                                    เหมาะสำหรับที่ขนาด  71      ตารางวา
                                </li>
                                <li>
                                     - หน้ากว้าง    14.00       เมตร
                                </li>
                                <li>
                                     - ลึกประมาณ    21.00       เมตร
                                </li>
                            </ul>
                        </div>
                        <!-- /widget -->

                        <?php echo View::make('shared.widget_category', compact('categories')) ?> 

                    </div>
                </div>
            </section>
            <!-- END BLOG -->


@stop
