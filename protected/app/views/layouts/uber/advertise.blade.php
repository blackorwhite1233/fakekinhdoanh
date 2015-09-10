{{--*/ $advertise = SiteHelpers::getAdvertise(1) /*--}}
                @if(count($advertise) >0)
                @foreach($advertise as $ad)
                <div class="box ads">
                    <div><a href="{{$ad->advertise_link}}"><img src="{{URL::to('')}}/uploads/advertise/thumb/{{$ad->image}}"></a></div>
                </div><!-- ads -->
                @endforeach
                @endif