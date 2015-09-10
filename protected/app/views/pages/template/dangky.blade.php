<div id="body_wrapper">
  <div class="container">
        <div class="block register">
            <div class="block_heading"><h2>Đăng ký thành viên</h2></div>
            <div class="block_content">
                <div class="register_form">
                    @if(Session::has('message_dangky'))
                     {{ Session::get('message_dangky') }}
                    @endif
                    <ul class="parsley-error-list">
                      @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                    <form  method="post" action="{{URL::to('home/dangky')}}" enctype="multipart/form-data">
                        <div class="group-name" style="margin-top:0;">Thông tin tài khoản</div>
                        <div class="input-group">
                          <span class="input-group-addon">Tài khoản <font color="red">*</font></span>
                          <input  type="text" class="form-control" name="username" value="{{$input['username']}}" >
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon">Mật khẩu <font color="red">*</font></span>
                          <input type="password" class="form-control" name="password">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon">Nhập lại mật khẩu <font color="red">*</font></span>
                          <input type="password" class="form-control" name="repassword">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon">Email <font color="red">*</font></span>
                          <input type="text" class="form-control" name="email" value="{{$input['email']}}">
                        </div>
                        <div class="group-name">Thông tin cá nhân</div>
                        <div class="input-group">
                          <span class="input-group-addon">Họ tên <font color="red">*</font></span>
                          <input type="text" class="form-control" name="name" value="{{$input['name']}}">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon">Số điện thoại <font color="red">*</font></span>
                          <input type="text" class="form-control" name="phone" value="{{$input['phone']}}">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon">Địa chỉ Website <font color="red">*</font></span>
                          <input type="text" class="form-control" name="link_website" value="{{$input['link_website']}}">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon">Địa chỉ Fanpage <font color="red">*</font></span>
                          <input type="text" class="form-control" name="link_fanpage" value="{{$input['link_fanpage']}}">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon">Ảnh đại diện</span>
                          <input type="file" class="form-control" name="file" >
                        </div>
                        @if(CNF_RECAPTCHA =='true') 
                        <div class="input-group">
                          <span class="input-group-addon">Mã bảo mật <font color="red">*</font></span>

                            {{ Form::captcha(array('theme' => 'white')); }}

                        </div>
                          @endif
                        <button type="submit" class="btn btn-default submit">Đăng ký</button>
                    </form>
                </div><!-- product_form -->
            </div><!-- block_content -->
        </div><!-- block -->
    </div><!-- container -->
</div><!-- body_wrapper -->