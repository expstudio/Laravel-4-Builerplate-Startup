<div class="col-md-12">
			<h3 class="portfolioFilter text-center thai-regular">เลือกชมผลงาน&nbsp;
				<a href="javascript:;" data-filter="all" class="f-link active">ทั้งหมด</a>, 
				<a href="javascript:;" data-filter="done" class="f-link">กำลังดำเนินการ</a>, 
				<a href="javascript:;" data-filter="processing" class="f-link">เสร็จสิ้นโครงการแล้ว</a></h3> 
		</div>
		<div class="col-md-12 mg-bt-80">
			<div class="row portfolioContainer  text-center">
				<?php $portfolios = Portfolio::all(); ?>
				@foreach($portfolios as $portfolio)
				<div class="col-md-4 col-xs-6 portfolio-item {{ str_replace(',', ' ', $portfolio->tags) }}">
					<a class="popup f-link" href="{{ url(action('PortfoliosController@show_box', $portfolio->slug)) }}" title="{{ $portfolio->title }}"> 
						<span class="project-hover">                                        
							<span>{{ $portfolio->title }} / {{ $portfolio->customer }}                                        
							</span> 
						</span> 
						<span class="f-img-wrap">
							<img src="{{ url($portfolio->cover->url('original')) }}" alt="{{ $portfolio->title }}">
						</span> 
					</a>
				</div>
				@endforeach
			</div>
		</div>