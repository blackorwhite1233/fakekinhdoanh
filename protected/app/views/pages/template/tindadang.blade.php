<div id="body_wrapper">
    <div class="container">
        @include('layouts/fake/boxcustomer')
        <div id="main">
            <div class="block">
                <div class="block_heading"><h2>Sản phẩm đã đăng</h2></div>
                <div class="product_list">
                    @foreach($data as $item)
                        {{ SiteHelpers::templatePost($item) }}
                    @endforeach
                </div><!-- product_list -->
            </div><!-- block -->
            <div class="pages">
                {{ $pagination->appends(array("page"=>$page))->links('pagination_site') }}
              </div> <!-- pages -->      
        </div><!-- main -->
    </div><!-- container -->
</div><!-- body_wrapper -->




