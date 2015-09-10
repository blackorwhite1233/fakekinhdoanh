@if(isset($menu) && $menu == "index")
{{--*/ $slide = SiteHelpers::getSlide(); /*--}}
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
              <?php
			  	$i = 0;
              	foreach($slide as $sl){
					$class = $i == 0 ? 'class="active"' : '';
				?>
                	<li data-target="#carousel-example-generic" data-slide-to="{{$i}}" {{$class}}></li>
                <?php
					$i++;
				}
			  ?>
              </ol>
            
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
              	<?php
					$i = 0;
					foreach($slide as $sl){
						$class = $i == 0 ? 'active' : '';
					?>
                    	<div class="item {{$class}}">
						<a href="{{$sl->slideshow_link}}"><img src="{{URL::to('')}}/uploads/slideshow/{{$sl->slideshow_image}}" ></a>
                        </div>
					<?php
						$i++;
					}
				  ?>
                
              </div>
            
              <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
@else
        	<div class="text-promotion">
                <h2>Đưa đón mọi người</h2>
                <p>CHỈ CẦN ẤN NÚT VÀ BẠN SẼ ĐƯỢC ĐÓN NGAY</p>
            </div><!-- text -->
@endif