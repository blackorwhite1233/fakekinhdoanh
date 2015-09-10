<div class="container">
			<div class="box register">
                @if(Session::has('message_dangnhap'))
                     {{ Session::get('message_dangnhap') }}
                @endif
                <ul class="parsley-error-list">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                <form  method="post" action="{{URL::to('home/dangnhap')}}">
                	<div class="group-name">Đăng nhập</div>
                    <div class="input-group">
                      <span class="input-group-addon">Tài khoản</span>
                      <input  type="text" class="form-control" name="username" value="" >
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Mật khẩu</span>
                      <input type="password" class="form-control" name="password">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Mã bảo mật</span>
                      @if(CNF_RECAPTCHA =='true') 

                        {{ Form::captcha(array('theme' => 'white')); }}

                      @endif
                    </div>
                  	<button type="submit" class="btn btn-default submit">Đăng nhập</button>
                </form>
			</div>
        </div><!-- container -->