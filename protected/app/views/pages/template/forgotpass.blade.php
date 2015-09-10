<div class="container">
			<div class="box register">
                @if(Session::has('message_forgotpass'))
                     {{ Session::get('message_forgotpass') }}
                @endif
                <ul class="parsley-error-list">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                <form  method="post" action="{{URL::to('home/forgotpass')}}">
                	<div class="group-name">Quên mật khẩu</div>
                    <div class="input-group">
                      <span class="input-group-addon">Email</span>
                      <input  type="text" class="form-control" name="email" value="" >
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