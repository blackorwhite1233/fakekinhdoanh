{{--*/ $menus = SiteHelpers::menus('top') /*--}}
<div class="links">
                <a href="{{URL::to('')}}">Trang chủ</a>
                @foreach ($menus as $menu)
					<a
		              @if($menu['menu_type'] =='external')
		                href="{{ URL::to($menu['module'])}}" 
		              @else
		                href="{{ URL::to($menu['module'])}}" 
		              @endif
		            >{{$menu['menu_name']}}</a>
                @endforeach
                
            </div><!-- links -->
