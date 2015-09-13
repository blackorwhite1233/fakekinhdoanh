<div class="container">
			<div class="box register">
                @if(Session::has('message_changepass'))
                     {{ Session::get('message_changepass') }}
                @endif
                <ul class="parsley-error-list">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                <form  method="post" action="{{URL::to('home/changepass')}}">
                	<div class="group-name">Thay đổi mật khẩu</div>
                    <div class="input-group">
                      <span class="input-group-addon">Mật khẩu cũ</span>
                      <input  type="password" class="form-control" name="password"  >
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Mật khẩu mới</span>
                      <input type="password" class="form-control" name="newpassword">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Nhập lại mật khẩu mới</span>
                      <input type="password" class="form-control" name="confirmpassword">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Mã bảo mật</span>
                      @if(CNF_RECAPTCHA =='true') 

                        {{ Form::captcha(array('theme' => 'white')); }}

                      @endif
                    </div>
                  	<button type="submit" class="btn btn-default submit">Gửi</button>
                </form>
			</div>
        </div><!-- container -->