{{--*/ $slide = SiteHelpers::getSlide(); /*--}}
<div class="slider">
            <?php
              $i = 0;
              foreach($slide as $sl){
                $class = $i == 0 ? 'active' : '';
              ?>
                  <div><a href="{{$sl->slideshow_link}}"><img src="{{URL::to('')}}/uploads/slideshow/{{$sl->slideshow_image}}"></a></div>
              <?php
                $i++;
              }
              ?>
        </div><!-- slider -->

