{{ HTML::script('sximo/themes/shop/js/jquery.jcombo.min.js') }}
<div class="container">
			<div class="box register">
                <h2>Thông tin cá nhân !</h2>
                @if(Session::has('message_changeinfo'))
                     {{ Session::get('message_changeinfo') }}
                @endif
                <ul class="parsley-error-list">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                <form  method="post" action="{{URL::to('home/changeinfo')}}" enctype="multipart/form-data">
                  <input type="hidden"/>
                	<div class="group-name">Thông tin tài khoản</div>
                    <div class="input-group">
                      <span class="input-group-addon">Tài khoản</span>
                      <input  type="text" readonly class="form-control" name="username" value="{{$input['username']}}" >
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Email</span>
                      <input type="text" readonly class="form-control" name="email" value="{{$input['email']}}">
                    </div>
                    <div class="group-name">Thông tin cá nhân</div>
                    <div class="input-group">
                      <span class="input-group-addon">Tên của bạn</span>
                      <input type="text" class="form-control" name="name" value="{{$input['name']}}">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Giới tính</span>
                      <select name="sex" class="form-control">
                        <option value="1" @if($input['sex'] == 1) selected @endif>Nam</option>
                        <option value="0" @if($input['sex'] == 0) selected @endif>Nữ</option>
                      </select>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Số điện thoại</span>
                      <input type="text" class="form-control" name="phone" value="{{$input['phone']}}">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">CMND</span>
                      <input type="text" class="form-control" name="cmnd" value="{{$input['cmnd']}}">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Tỉnh/Thành</span>
                      <select name="provinceid" id="city" class="form-control">
                      </select>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Quận/Huyện</span>
                      <select name="districtid" id="district" class="form-control">
                      </select>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Phường/Xã</span>
                      <select name="wardid" id="ward" class="form-control">
                      </select>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Ảnh đại diện</span>
                      <input type="file" class="form-control" name="file" >
                      @if($input['image'] != "")
                        <img src="{{URL::to('')}}/uploads/customer/thumb/{{$input['image']}}">
                      @elseif
                        <img src="{{ asset('sximo/themes/uber/image/no-avatar.jpg')}}">
                      @endif
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
        <script type="text/javascript">
          $(document).ready(function() { 
            $("#city").jCombo("{{ URL::to('ward/comboselect?filter=province:provinceid:name') }}",
            {  selected_value : "{{$input['provinceid']}}",initial_text: "-- Tỉnh/Thành --", });
            $("#city").on('change', function() {
              var val = this.value ; 
              $("#district").jCombo("{{ URL::to('ward/comboselect?filter=district:districtid:name:') }}"+val,
            {  selected_value : "{{$input['districtid']}}",initial_text: "-- Quận/Huyện --", });
            });
            $("#district").on('change', function() {
              var val = this.value ; 
              $("#ward").jCombo("{{ URL::to('ward/comboselect?filter=ward:wardid:name:') }}"+val,
            {  selected_value : "{{$input['wardid']}}",initial_text: "-- Phường/Xã --", });
            });
          });
        </script>