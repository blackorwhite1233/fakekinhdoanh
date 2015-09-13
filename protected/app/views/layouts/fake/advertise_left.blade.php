<?php
    $ads = SiteHelpers::getAdvertise();
?>
<div class="box_content">
	@foreach($ads as $a)
		<a target="_blank" href="{{$a->advertise_link}}"><img src="{{URL::to('')}}/uploads/advertise/thumb/{{$a->image}}"></a>
	@endforeach
</div><!-- box_content -->