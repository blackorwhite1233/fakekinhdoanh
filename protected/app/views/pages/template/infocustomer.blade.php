
<div class="container">
			<div class="box register">
                <h2>Thông tin cá nhân !</h2>
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
                      <input type="text" readonly class="form-control" name="name" value="{{$input['name']}}">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Giới tính</span>
                      <input type="text" readonly class="form-control" name="sex" value=" @if($input['sex'] == 1) Nam @else Nữ @endif">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Số điện thoại</span>
                      <input type="text" readonly class="form-control" name="phone" value="{{$input['phone']}}">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">Số dư tài khoản</span>
                      <input type="text" readonly class="form-control" name="phone" value="{{number_format($input['money'],0,',','.')}} VNĐ">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">CMND</span>
                      <input type="text" readonly class="form-control" name="address" value="{{$input['cmnd']}}">
                    </div>
                    
                    <div class="input-group">
                      <span class="input-group-addon">Ảnh đại diện</span>
                      @if($input['image'] != "")
                        <img src="{{URL::to('')}}/uploads/customer/thumb/{{$input['image']}}">
                      @elseif
                        <img src="{{ asset('sximo/themes/uber/image/no-avatar.jpg')}}">
                      @endif
                    </div>
                   
			</div>
        </div><!-- container -->
        