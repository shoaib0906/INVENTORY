@extends('layouts.default')



	@section('content')

		<div class="row">

			<div class="col-sm-8">
				@foreach($obj as $obj)
				<div class="box-info">
				
				<div class="article">
						
						
						<div class="title_article">
							<h3><a class="author_name" target="_blank" href="{{$obj->page_uri}}">{{$obj->title}}</a></h3>
						</div>
						<div class="time_autor_of_article">
							{{ ($obj->publish_date)}} By <a class="author_name" target="_blank" href="{{$obj->writer->profile_uri}}">
							{{$obj->writer->name}}</a>
						</div>	
						<br/><br/>
						<div class="article_body">
							
							<div class="place_big_image_article" style="background:url('img/big_img1.jpg');">
							</div>
							<div class="small_text_under_main_picture">
								
								<img src="http://hivisasa.com{{$obj->image_uri}}">
							</div>
							<div class="text_article">
								<p>
								Kesi ya ufisadi inayomkabili mbunge wa Lamu Magharibi Julius Ndegwa imeahirishwa baada ya naibu mkurugenzi mkuu wa mashtaka ya umma Alexendra Muteti kukosa kufika mahakamani kwa sababu za kiafya.
								</p>
								<p>
								Hii ni baada ya mwendesha mashtaka Peter Kiprop, kutoka afisi ya mkurugenzi mkuu wa mashtaka ya umma tawi la Mombasa, kuiambia mahakama siku ya Alhamisi, kuwa naibu mkurugenzi mkuu anamatatizo ya kiafya na kuitaka mahakama kuahirisha kesi hiyo.
								</p>
								<p>
								Mbunge Ndegwa na wanakamati wasita wa hazina ya ustawishaji wa maeneo bunge CDF, wanatuhumiwa kutumia vibaya shilingi milioni 1.6 zilizokuwa zimetengewa ujenzi wa kituo cha kutibu mifugo eneo la Witu.
								</p>
								<p>
								Kesi hiyo itasikilizwa Januari 14, 2016.
								</p>
							</div>
							
							
							<a href="">
								<div class="text_report_story">
									Report Story
								</div>
							</a>
						</div>
					</div>	
				
				
				</div>
				@endforeach
			</div>

			<div class="col-sm-4">

				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>

					

				</div>

			</div>

		</div>



	@stop

	