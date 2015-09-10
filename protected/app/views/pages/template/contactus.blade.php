
    <div class="container">
      <div class="box register">
                @if(Session::has('message_contact'))
                     {{ Session::get('message_contact') }}
                @endif
                <ul class="parsley-error-list">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                <form  method="post" action="{{URL::to('')}}/home/contactform">
                  <div class="group-name">Thông tin liên hệ</div>
                    <div class="input-group">
                      <span class="input-group-addon">Họ tên</span>
                      <input  type="text" class="form-control" value="{{$input['name']}}" name="name"  >
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Email</span>
                      <input type="text" class="form-control" value="{{$input['email']}}" name="email">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Số điện thoại</span>
                      <input type="text" class="form-control" value="{{$input['phone']}}" name="phone">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Tiêu đề</span>
                      <input type="text" class="form-control" value="{{$input['subject']}}" name="subject">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Nội dung</span>
                      <textarea style="width: 98%;" rows="10" cols="40" name="content">{{$input['content']}}</textarea>
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



