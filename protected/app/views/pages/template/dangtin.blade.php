{{ HTML::script('sximo/themes/shop/js/jquery.jcombo.min.js') }}
<div id="body_wrapper">
  <div class="container">
        @include('layouts/fake/boxcustomer')
        <div id="main">
          <div class="block">
              <div class="block_heading"><h2>Đăng sản phẩm</h2></div>
                <div class="block_content">
                  <div class="product_form">
                        @if(Session::has('message_dangtin'))
                             {{ Session::get('message_dangtin') }}
                        @endif
                        <ul class="parsley-error-list">
                          @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                        <form method="post" action="{{URL::to('')}}/home/dangtin" enctype="multipart/form-data">
                            <div class="input-group">
                              <span class="input-group-addon">Tên sản phẩm <font color="red">*</font></span>
                              <input type="text" class="form-control" name="post_name" value="{{$input['post_name']}}">
                            </div>
                            <div class="input-group">
                              <span class="input-group-addon">Mã sản phẩm <font color="red">*</font></span>
                              <input type="text" class="form-control" name="post_code" value="{{$input['post_code']}}">
                            </div>
                            <div class="input-group">
                              <span class="input-group-addon">Danh mục<font color="red">*</font></span>
                              <select id="post_category" name="post_category" class="form-control">
                              </select>
                            </div>
                            <div class="input-group">
                              <span class="input-group-addon">Giá <font color="red">*</font></span>
                              <input type="text" class="form-control" name="post_price" value="{{$input['post_price']}}">
                            </div>
                            <div class="input-group">
                              <span class="input-group-addon">Giá khuyến mãi</span>
                              <input type="text" class="form-control" name="post_price_promotion" value="{{$input['post_price_promotion']}}">
                            </div>
                            <div class="input-group">
                              <span class="input-group-addon">Số điện thoại liên hệ <font color="red">*</font></span>
                              <input type="text" class="form-control" name="phone" value="{{$input['phone']}}">
                            </div>
                            <div class="input-group">
                              <span class="input-group-addon">Ảnh sản phẩm</span>
                              <input type="file" class="form-control" name="post_image">
                            </div> 
                            <div class="input-group">
                              <span class="input-group-addon">Chi tiết sản phẩm</span>
                              <input type="text" class="form-control" name="post_link" value="{{$input['post_link']}}" placeholder="Link sản phẩm (trên website hoặc fanpage) của bạn">
                            </div>
                            <div class="box info-user">
                              <label>Mã bảo mật</label>
                              <table>
                                  <tr><td> @if(CNF_RECAPTCHA =='true') 

                                {{ Form::captcha(array('theme' => 'white')); }}

                              @endif</td></tr>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-default submit">Đăng sản phẩm</button>
                        </form>
                  </div><!-- product_form -->
                </div><!-- block_content -->
            </div><!-- block -->
      </div><!-- main -->
    </div><!-- container -->
</div><!-- body_wrapper -->
        <script type="text/javascript">
          $(document).ready(function() { 
            $("#post_category").jCombo("{{ URL::to('ward/comboselect?filter=categories:CategoryID:CategoryName') }}",
            {  selected_value : "{{$input['post_category']}}",initial_text: "-- Danh mục --", });
          });
        </script>
