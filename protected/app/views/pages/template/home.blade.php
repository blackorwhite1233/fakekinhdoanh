<div id="body_wrapper">
    <div class="container">
        <div class="text_intro">Chắp Cánh Tiểu Thương <sup><i class="fa fa-quote-right"></i></sup></div>
        @include('layouts/fake/slide')
        @include('layouts/fake/sidebar')
        <div id="main">
            <div class="block">
                <div class="block_heading"><h2>Sản phẩm HOT</h2></div>
                <div class="product_list">
                    @foreach($sp_banchay as $item)
                        {{ SiteHelpers::templatePost($item) }}
                    @endforeach
                </div><!-- product_list -->
            </div><!-- block -->
            <div class="block">
                    @if($adver_1 == '')
                        <a href="#">
                            <img src="{{ asset('sximo/themes/fake/images/ads3.jpg')}}">
                        </a>
                    @else
                        <a target="_blank" href="{{$adver_1->advertise_link}}">
                            <img src="{{URL::to('')}}/uploads/advertise/thumb/{{$adver_1->image}}">
                        </a>
                    @endif
            </div><!-- block -->
            <div class="block">
                <div class="block_heading"><h2>Sản phẩm Bán chạy</h2></div>
                <div class="product_list">
                    @foreach($sp_muanhieu as $item)
                        {{ SiteHelpers::templatePost($item) }}
                    @endforeach
                </div><!-- product_list -->
            </div><!-- block -->
            <div class="block">
                @if($adver_2 == '')
                    <a href="#">
                        <img src="{{ asset('sximo/themes/fake/images/ads3.jpg')}}">
                    </a>
                @else
                    <a target="_blank" href="{{$adver_2->advertise_link}}">
                        <img src="{{URL::to('')}}/uploads/advertise/thumb/{{$adver_2->image}}">
                    </a>
                @endif            </div><!-- block -->
            <div class="block">
                <div class="block_heading"><h2>Sản phẩm Khuyến mãi</h2></div>
                <div class="product_list">
                    @foreach($sp_muanhieu as $item)
                        {{ SiteHelpers::templatePost($item) }}
                    @endforeach
                </div><!-- product_list -->
            </div><!-- block -->
        </div><!-- main -->
    </div><!-- container -->
</div><!-- body_wrapper -->