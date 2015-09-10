<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	protected  $perpage = 15;

	public function __construct() {

		parent::__construct();
		$this->lang = Session::get('lang') == '' ? CNF_LANG : Session::get('lang');
		 $this->layout = "layouts.".CNF_THEME.".index";

	}

	public function dangky(){
		if(Session::has('customer')){
			return Redirect::to('change-info.html');
		}
		$this->data['pageTitle'] = "Đăng ký";
		$this->data['pageNote'] = CNF_APPNAME;

		$input = array(
				'username'	=>'',
				'name'	=>'',
				//'sex'	=>'1',
				'phone'	=>'',
				'email'	=>'',
				//'cmnd'	=>'',
				//'provinceid'	=>'79',
				//'districtid'	=>'',
				//'wardid'	=>'',
				'link_website'	=>'',
				'link_fanpage'	=>'',
			);
		if(Session::has('input_rd')){
			$input = Session::get('input_rd');
		}
		$data['input'] = $input;

		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.dangky';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','dangky');
	}

	public function postDangky(){
		$rules = Customer::$rules;
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$data = $this->getDataPost('customer');
			//print_r($data);die;
			$data['created'] = time();
			$data['password'] = md5($data['password']);
			$data['code'] = md5(time());
			$mdCus = new Customer();

			if(!is_null(Input::file('file')))
			{
				$file = Input::file('file');
				$destinationPath = './uploads/customer/';
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				$newfilename = time().'.'.$extension;
				$uploadSuccess = Input::file('file')->move($destinationPath, $newfilename);
				if( $uploadSuccess ) {
				    $data['image'] = $newfilename;
				    $orgFile = $destinationPath.'/'.$newfilename;
				    $thumbFile = $destinationPath.'/thumb/'.$newfilename;
				    SiteHelpers::resizewidth("193",$orgFile,$thumbFile);
				}
			}

			$ID = $mdCus->insertRow($data , Input::get('customer_id'));
			$data_message = array('name'=>Input::get('name'),'code'=>$data['code'],'email'=>Input::get('email'),'password'=>Input::get('password')); 
			Mail::send('emails.dangky', $data_message, function($message)
			{
				$message->from( CNF_EMAIL, 'Admin' );
			    $message->to(Input::get('email'), Input::get('name'))->subject('Kích hoạt tài khoản');
			});
			return Redirect::to('thong-bao.html')->with('message', SiteHelpers::alert('success','Đăng ký thành công ! Email kích hoạt dã được gửi vào Email của bạn Vui lòng kích hoạt để sử dụng dịch vụ chủa chúng tôi'));
		}
		else{
			return Redirect::to('dang-ky.html')->with('message_dangky', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->with('input_rd',Input::all())->withErrors($validator)->withInput();
		}
	}

	public function getActivation(){
		if(!isset($_GET['code']) || $_GET['code'] == ''){
			return Redirect::to('');
		}
		$code = $_GET['code'];
		$customer = DB::table('customer')->where('code','=',$code)->first();
		if(count($customer) <= 0){
			return Redirect::to('');
		}
		$data['code'] = '';
		$data['status'] = '1';
		DB::table('customer')->where('customer_id','=',$customer->customer_id)->update($data);
		return Redirect::to('thong-bao.html')->with('message', SiteHelpers::alert('success','Kích hoạt thành công ! Hãy đăng nhập ngay để tham gia với chúng tôi !'));
	}

	public function getDangnhap(){
		$this->data['pageTitle'] = "Đăng nhập";
		$this->data['pageNote'] = CNF_APPNAME;


		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.dangnhap';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page)->with('page', $this->data)->with('menu','dangnhap');
	}

	public function postDangnhap(){
		$rules = array(
			'username'=>'required',
			'password'=>'required',
		);		
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$cus = DB::table('customer')->where('username', '=',Input::get('username'))->where('status','=','1')->where('password','=',md5(Input::get('password')))->first();
			if(count($cus)>0){
				$arr_cus = array('id'=>$cus->customer_id, 'name'=>$cus->name, "email"=>$cus->email, 'image'=>$cus->image);
				Session::put('customer',$arr_cus);
				Session::save();
				return Redirect::to('');
			}else{
				return Redirect::to('home/dangnhap')->with('message_dangnhap', SiteHelpers::alert('error','Sai tên đăng nhập hoặc mật khẩu'));
			}
		}
		else{
			return Redirect::to('home/dangnhap')->with('message_dangnhap', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->withErrors($validator)->withInput();
		}
		
	}

	public function postDangnhapajax(){
		$cus = DB::table('customer')->where('username', '=',Input::get('username'))->where('status','=','1')->where('password','=',md5(Input::get('password')))->first();
		if(count($cus)>0){
			$arr_cus = array('id'=>$cus->customer_id, 'name'=>$cus->name, "email"=>$cus->email, 'image'=>$cus->image, 'username'=>$cus->username);
			Session::put('customer',$arr_cus);
			Session::save();
			echo "1";
		}else{
			echo "0";
		}
		die();
	}

	public function forgotpass(){
		$this->data['pageTitle'] = "Quên mật khẩu";
		$this->data['pageNote'] = CNF_APPNAME;


		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.forgotpass';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page)->with('page', $this->data)->with('menu','forgotpass');
	}

	public function postForgotpass(){
		$rules = array(
			'email'=>'required|email',
		);
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$cus = DB::table('customer')->where('email','=',Input::get('email'))->first();
			if(count($cus) > 0){
				$pass = SiteHelpers::randomPassword();
				DB::table('customer')->where('email','=',Input::get('email'))->update(array('password'=>md5($pass)));
				$data = array('name'=>$cus->name,'username'=>$cus->username,'pass'=>$pass); 
				Mail::send('emails.forgotpass', $data, function($message)
				{
					$message->from( CNF_EMAIL, 'Admin' );
				    $message->to(Input::get('email'), '')->subject('Thông tin đăng nhập');
				});
			}
			return Redirect::to('thong-bao.html')->with('message', SiteHelpers::alert('success','Vui lòng kiểm tra Email để nận mật khẩu mới !'));
		}	
		else{
			return Redirect::to('forgotpass.html')->with('message_forgotpass', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->withErrors($validator)->withInput();
		}
	}

	public function  changeinfo(){
		if(!Session::has('customer')){
			return Redirect::to('dang-ky.html');
		}
		$this->data['pageTitle'] = "Thay đổi thông tin";
		$this->data['pageNote'] = CNF_APPNAME;
		$ses_cus = Session::get('customer');
		$input = DB::table('customer')->where("customer_id",'=',$ses_cus['id'])->first();
		

		if(Session::has('input_rd')){
			$input = Session::get('input_rd');
		}
		$data['input'] =(array) $input;

		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.changeinfo';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','changeinfo');
	}
	
	public function thongtinthanhvien(){
		
		if(!Session::has('customer')){
			return Redirect::to('dang-ky.html');
		}
		$this->data['pageTitle'] = "Thông tin thành viên";
		$this->data['pageNote'] = CNF_APPNAME;
		$ses_cus = Session::get('customer');
		$data['input'] = (array) DB::table('customer')->where("customer_id",'=',$ses_cus['id'])->first();
		$data['input']['cmnd'] = SiteHelpers::getCMND($data['input']['cmnd']);
		/*if(Session::has('input_rd')){
			$input = Session::get('input_rd');
		}
		$data['input'] =(array) $input;*/

		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.infocustomer';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','infocustomer');
	}
	
	public function tindadang(){
		
		if(!Session::has('customer')){
			return Redirect::to('dang-ky.html');
		}
		$sort = 'post_id';
		$order = 'desc';
		$ses_cus = Session::get('customer');
		$id = $ses_cus['id'];
		$filter = " AND status = 1 AND active = 1 AND customer_id = $id ";

		$page = (!is_null(Input::get('page')) && Input::get('page') != '') ? Input::get('page') : "1";
		$params = array(
			'page'		=> $page ,
			'limit'		=> ( $this->perpage ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			//'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$model = new Post();
		$results = $model->getRows( $params );
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);
		//$data['order'] 		= $data_order;
		//$data['province']	= $data_province;
		$data['data']		= $results['rows'];
		$data['page']		= $page;
		$data['numpage']	= $params['limit'];
		// Build Pagination 
		$data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$data['pager'] 		= $this->injectPaginate();


		$this->data['pageTitle'] = "Danh sách tin ";
		$this->data['pageNote'] = CNF_APPNAME;
		$page = 'pages.template.tindadang';
		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','tindadang');
	}

	public function postChangeinfo(){
		if(!Session::has('customer')){
			return Redirect::to('dang-ky.html');
		}
		$rules = $rules=array(
			"email" => "required|email",
			"username" => "required|alpha_num|between:5,20",
			"name" => "required|between:5,50",
			"phone" => "required|Numeric",
			"cmnd" => "required|Numeric",
			//"provinceid" => "required",
			//"districtid" => "required",
			//"wardid" => "required",
			'file'	=>'mimes:gif,png,jpg,jpeg|max:20000',
		);
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$data['name'] = Input::get('name');
			$data['phone'] = Input::get('phone');
			//$data['address'] = Input::get('address');
			$data['cmnd'] = Input::get('cmnd');
			$data['provinceid'] = Input::get('provinceid');
			$data['districtid'] = Input::get('districtid');
			$data['wardid'] = Input::get('wardid');
			if(!is_null(Input::file('file')))
			{
				$file = Input::file('file');
				$destinationPath = './uploads/customer/';
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				$newfilename = time().'.'.$extension;
				$uploadSuccess = Input::file('file')->move($destinationPath, $newfilename);
				if( $uploadSuccess ) {
				    $data['image'] = $newfilename;
				    $orgFile = $destinationPath.'/'.$newfilename;
				    $thumbFile = $destinationPath.'/thumb/'.$newfilename;
				    SiteHelpers::resizewidth("193",$orgFile,$thumbFile);
				    $ses_cus = Session::get('customer');
				    if($ses_cus['image'] != ''){
				    	@unlink(ROOT .'/uploads/customer/'.$ses_cus['image']);
				    	@unlink(ROOT .'/uploads/customer/thumb/'.$ses_cus['image']);
				    }
				}
			}
			DB::table('customer')->where('email','=',Input::get('email'))->where('username','=',Input::get('username'))->update($data);
			return Redirect::to('thong-bao.html')->with('message', SiteHelpers::alert('success','Thay đổi thông tin thành công !'));
		}else{
			return Redirect::to('change-info.html')->with('message_changeinfo', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->withErrors($validator)->withInput();
		}
	}

	public function changepass(){
		if(!Session::has('customer')){
			return Redirect::to('dang-ky.html');
		}
		$this->data['pageTitle'] = "Thay đổi mật khẩu";
		$this->data['pageNote'] = CNF_APPNAME;
		$page = 'pages.template.changepass';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page)->with('page', $this->data)->with('menu','changepass');
	}

	public function postChangepass(){
		if(!Session::has('customer')){
			return Redirect::to('dang-ky.html');
		}
		$rules = $rules=array(
			"password" => "required|between:5,20",
			"newpassword" => "required|between:5,20",
			"confirmpassword" => "required|same:newpassword",
		);
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$ses_cus = Session::get('customer');
			$cus = DB::table('customer')->where('customer_id','=',$ses_cus['id'])->first();
			if(md5(Input::get('password')) != $cus->password){
				return Redirect::to('change-pass.html')->with('message_changepass', SiteHelpers::alert('error','Mật khẩu cũ không chính xác !'));
			}
			$pass = md5(Input::get('newpassword'));
			DB::table('customer')->where('customer_id','=',$ses_cus['id'])->update(array('password'=>$pass));
			return Redirect::to('thong-bao.html')->with('message', SiteHelpers::alert('success','Thay đổi mật khẩu thành công !'));
		}else{
			return Redirect::to('change-pass.html')->with('message_changepass', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->withErrors($validator)->withInput();
		}
		/*$rules = $rules=array(
			"type_customer" => "required|Numeric",
			"subject" => "required",
			"subject" => "required|alpha_num|between:5,15",
			"name" => "required|between:5,15",
			"phone" => "required|Numeric",
			"address" => "required",
			"provinceid" => "required",
			"districtid" => "required",
			"wardid" => "required",
		);
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {

		}else{

		}*/

	}

	public function getLogout(){
		Session::forget('customer');
		return Redirect::to('');
	}

	public function dangtin(){
		if(!Session::has('customer')){
			return Redirect::to('home/dangnhap');
		}
		$this->data['pageTitle'] = "Đăng tin";
		$this->data['pageNote'] = CNF_APPNAME;
		$page = 'pages.template.dangtin';
		$ses_cus = Session::get('customer');
		$cus = DB::table('customer')->where("customer_id","=",$ses_cus['id'])->first();
		$input = array(
				'post_name'	=>'',
				'post_code'	=>'',
				'post_category'	=>'',
				'post_link'	=>'',
				'post_price'	=>'0',
				'post_price_promotion'	=>'0',
				'post_link'	=>'',
				'phone'	=>$cus->phone,
			);
		if(Session::has('input_rd')){
			$input = Session::get('input_rd');
		}
		$data['input'] = $input;

		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','dangtin');
	}

	public function postDangtin(){
		if(!Session::has('customer')){
			return Redirect::to('home/dangnhap');
		}

		$rules = array(
				'post_name'		=>'required',
				'post_code'			=>'required|max:10',
				'post_category'		=>'required|Numeric',
				'post_link'		=>'required',
				//'post_addressfrom'		=>'required',
				'post_price'		=>'required|Numeric',
				'post_price_promotion'		=>'Numeric',
				'phone'					=>'required',
				'post_image'	=>'mimes:gif,png,jpg,jpeg|max:20000',
		);
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) 
		{
			$ses_cus = Session::get('customer');
			$customer = DB::table('customer')->where('customer_id','=',$ses_cus['id'])->first();
			$data = $this->getDataPost('post');
			if(CNF_FREE == 1){
				if($customer->money < CNF_PRICEPOST){
					return Redirect::to('contact-us.html')->with('message_contact', SiteHelpers::alert('warning','Tài khoản quý khách không đủ để đăng tin ! Vui lòng liên hệ Admin để nạp tài khoản !'));
				}
				$update_cus['money'] = $customer->money - CNF_PRICEPOST;
				DB::table('customer')->where('customer_id','=',$ses_cus['id'])->update($update_cus);
			}
			$data['created'] = time();
			$data['customer_id'] = $ses_cus['id'];
			$data['post_slug'] = SiteHelpers::seoUrl(trim($data['post_name']));
			$data['active'] = 1;
			$data['status'] = 1;
			unset($data['lang']);
			if(!is_null(Input::file('post_image')))
			{
				$file = Input::file('post_image');
				$destinationPath = './uploads/post/';
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				$newfilename = SiteHelpers::seoUrl(trim($data['post_name'])).'_'.time().'.'.$extension;
				$uploadSuccess = Input::file('post_image')->move($destinationPath, $newfilename);
				if( $uploadSuccess ) {
				    $data['post_image'] = $newfilename;
				    $orgFile = $destinationPath.'/'.$newfilename;
				    $thumbFile = $destinationPath.'/thumb/'.$newfilename;

					SiteHelpers::resize_crop_image('169' , '166' , $orgFile ,	 $thumbFile);
				}
			}
			$mdPost = new Post();
			$ID = $mdPost->insertRow($data , '');
			return Redirect::to('thong-bao.html')->with('message', SiteHelpers::alert('success','Thao tác thành công ! Bài đăng của bạn đang chờ duyệt !'));
		}else{
			$input_rd = Input::all();
			unset($input_rd['post_image']);
			return Redirect::to('dang-san-pham.html')->with('message_dangtin', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->with('input',$input_rd)->withErrors($validator)->withInput();
		}

	}

	public function postSuatin(){
		if(!Session::has('customer') || Input::get('post_id') == ''){
			return Redirect::to('');
		}

		$rules = array(
				'post_name'		=>'required',
				'post_code'			=>'required|max:10',
				'post_category'		=>'required|Numeric',
				'post_link'		=>'required',
				//'post_addressfrom'		=>'required',
				'post_price'		=>'required|Numeric',
				'post_price_promotion'		=>'Numeric',
				'phone'					=>'required',
				'post_image'	=>'mimes:gif,png,jpg,jpeg|max:20000',
		);
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) 
		{
			$ses_cus = Session::get('customer');
			$customer = DB::table('customer')->where('customer_id','=',$ses_cus['id'])->first();
			$data = $this->getDataPost('post');
			$data['created'] = time();
			$data['customer_id'] = $ses_cus['id'];
			$data['post_slug'] = SiteHelpers::seoUrl(trim($data['post_name']));
			$data['active'] = 1;
			$data['status'] = 1;
			unset($data['lang']);
			$mdPost = new Post();
			if(!is_null(Input::file('post_image')))
			{
				$file = Input::file('post_image');
				$destinationPath = './uploads/post/';
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				$newfilename = SiteHelpers::seoUrl(trim($data['post_name'])).'_'.time().'.'.$extension;
				$uploadSuccess = Input::file('post_image')->move($destinationPath, $newfilename);
				if( $uploadSuccess ) {
				    $data['post_image'] = $newfilename;
				    $orgFile = $destinationPath.'/'.$newfilename;
				    $thumbFile = $destinationPath.'/thumb/'.$newfilename;

					SiteHelpers::resize_crop_image('169' , '166' , $orgFile ,	 $thumbFile);

					$data_old = $mdPost->getRow(Input::get('post_id'));
			    	@unlink(ROOT .'/uploads/advertise/'.$data_old->post_image);
			    	@unlink(ROOT .'/uploads/advertise/thumb/'.$data_old->post_image);
				}
			}else{
				unset($data['post_image']);
			}
			$ID = $mdPost->insertRow($data , $data['post_id']);
			return Redirect::to('thong-bao.html')->with('message', SiteHelpers::alert('success','Thao tác thành công ! Bài đăng của bạn đang chờ duyệt !'));
		}else{
			$input_rd = Input::all();
			unset($input_rd['post_image']);
			return Redirect::back()->with('message_dangtin', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->with('input',$input_rd)->withErrors($validator)->withInput();
		}

	}

	public function thongbao(){
		if(!Session::has('message')){
			return Redirect::to('');
		}
		$this->data['pageTitle'] = "Thông báo";
		$this->data['pageNote'] = CNF_APPNAME;
		$page = 'pages.template.thongbao';
		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page)->with('page', $this->data)->with('menu','thongbao');
	}

	public function page($id){
		$mdPage = new Pages();
		$item = $mdPage->find($id);

		$data['page'] = $item;
		$this->data['pageTitle'] = $item->title;
		$this->data['pageNote'] = CNF_APPNAME;

		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.index';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data);
	}

	public function tinmoi (){
		$sort = 'post_id';
		$order = 'desc';
		$filter = " AND status = 1 AND active = 1 ";
		$province_from = (Input::get('province_from') != '') ? Input::get('province_from') : '';
		$district_from = ( Input::get('district_from') != '') ? Input::get('district_from') : '';
		$province_to = ( Input::get('province_to') != '') ? Input::get('province_to') : '';
		$district_to = ( Input::get('district_to') != '') ? Input::get('district_to') : '';
		$datestar = ( Input::get('datestar') != '') ? strtotime(Input::get('datestar')) : '';

		$filter .= ( Input::get('province_from') != '') ? " AND post_provincefrom = ".Input::get('province_from') : '';
		$filter .= ( Input::get('district_from') != '') ? " AND post_districtfrom = ".Input::get('district_from') : '';
		$filter .= ( Input::get('province_to') != '') ? " AND post_provinceto = ".Input::get('province_to') : '';
		$filter .= ( Input::get('district_to') != '') ? " AND post_districtto = ".Input::get('district_to') : '';
		$filter .= ( Input::get('datestar') != '') ? " AND post_datestar >= ".strtotime(Input::get('datestar')) : '';

		$data_order = array(
						'province_from' => $province_from,
						'district_from' => $district_from,
						'province_to' => $province_to,
						'district_to' => $district_to,
						'datestar' => $datestar,
					);

		$page = (!is_null(Input::get('page')) && Input::get('page') != '') ? Input::get('page') : "1";
		$params = array(
			'page'		=> $page ,
			'limit'		=> ( $this->perpage ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			//'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$model = new Post();
		$results = $model->getRows( $params );
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);
		$data['order'] 		= $data_order;
		$data['data']		= $results['rows'];
		$data['page']		= $page;
		$data['numpage']	= $params['limit'];
		// Build Pagination 
		$data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$data['pager'] 		= $this->injectPaginate();


		$this->data['pageTitle'] = "Tin mới đăng";
		$this->data['pageNote'] = CNF_APPNAME;
		$page = 'pages.template.tinmoi';
		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','tinmoi');
	}

	public function hanhkhach (){
		$sort = 'post_id';
		$order = 'desc';
		$filter = " AND status = 1 AND active = 1 AND post_typecustomer = 1";
		$province_from = (Input::get('province_from') != '') ? Input::get('province_from') : '';
		$district_from = ( Input::get('district_from') != '') ? Input::get('district_from') : '';
		$province_to = ( Input::get('province_to') != '') ? Input::get('province_to') : '';
		$district_to = ( Input::get('district_to') != '') ? Input::get('district_to') : '';
		$datestar = ( Input::get('datestar') != '') ? strtotime(Input::get('datestar')) : '';

		$filter .= ( Input::get('province_from') != '') ? " AND post_provincefrom = ".Input::get('province_from') : '';
		$filter .= ( Input::get('district_from') != '') ? " AND post_districtfrom = ".Input::get('district_from') : '';
		$filter .= ( Input::get('province_to') != '') ? " AND post_provinceto = ".Input::get('province_to') : '';
		$filter .= ( Input::get('district_to') != '') ? " AND post_districtto = ".Input::get('district_to') : '';
		$filter .= ( Input::get('datestar') != '') ? " AND post_datestar >= ".strtotime(Input::get('datestar')) : '';

		$data_order = array(
						'province_from' => $province_from,
						'district_from' => $district_from,
						'province_to' => $province_to,
						'district_to' => $district_to,
						'datestar' => $datestar,
					);

		$page = (!is_null(Input::get('page')) && Input::get('page') != '') ? Input::get('page') : "1";
		$params = array(
			'page'		=> $page ,
			'limit'		=> ( $this->perpage ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			//'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$model = new Post();
		$results = $model->getRows( $params );
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);
		$data['order'] 		= $data_order;
		$data['data']		= $results['rows'];
		$data['page']		= $page;
		$data['numpage']	= $params['limit'];
		// Build Pagination 
		$data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$data['pager'] 		= $this->injectPaginate();


		$this->data['pageTitle'] = "Hành khách";
		$this->data['pageNote'] = CNF_APPNAME;
		$page = 'pages.template.hanhkhach';
		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','hanhkhach');
	}

	public function taixe (){
		$sort = 'post_id';
		$order = 'desc';
		$filter = " AND status = 1 AND active = 1 AND post_typecustomer = 0";
		$province_from = (Input::get('province_from') != '') ? Input::get('province_from') : '';
		$district_from = ( Input::get('district_from') != '') ? Input::get('district_from') : '';
		$province_to = ( Input::get('province_to') != '') ? Input::get('province_to') : '';
		$district_to = ( Input::get('district_to') != '') ? Input::get('district_to') : '';
		$datestar = ( Input::get('datestar') != '') ? strtotime(Input::get('datestar')) : '';

		$filter .= ( Input::get('province_from') != '') ? " AND post_provincefrom = ".Input::get('province_from') : '';
		$filter .= ( Input::get('district_from') != '') ? " AND post_districtfrom = ".Input::get('district_from') : '';
		$filter .= ( Input::get('province_to') != '') ? " AND post_provinceto = ".Input::get('province_to') : '';
		$filter .= ( Input::get('district_to') != '') ? " AND post_districtto = ".Input::get('district_to') : '';
		$filter .= ( Input::get('datestar') != '') ? " AND post_datestar >= ".strtotime(Input::get('datestar')) : '';

		$data_order = array(
						'province_from' => $province_from,
						'district_from' => $district_from,
						'province_to' => $province_to,
						'district_to' => $district_to,
						'datestar' => $datestar,
					);

		$page = (!is_null(Input::get('page')) && Input::get('page') != '') ? Input::get('page') : "1";
		$params = array(
			'page'		=> $page ,
			'limit'		=> ( $this->perpage ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			//'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$model = new Post();
		$results = $model->getRows( $params );
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);
		$data['order'] 		= $data_order;
		$data['data']		= $results['rows'];
		$data['page']		= $page;
		$data['numpage']	= $params['limit'];
		// Build Pagination 
		$data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$data['pager'] 		= $this->injectPaginate();


		$this->data['pageTitle'] = "Danh sách tài xế";
		$this->data['pageNote'] = CNF_APPNAME;
		$page = 'pages.template.taixe';
		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','taixe');
	}

	public function tinhthanh (){
		if(Input::get('province') == ''){
			return Redirect::to('');
		}
		$sort = 'post_id';
		$order = 'desc';
		$province = Input::get('province');
		$data_province = DB::table('province')->where('provinceid','=',$province)->first();
		$filter = " AND status = 1 AND active = 1 AND (post_provincefrom = $province OR post_provinceto = $province) ";
		$data_order = array(
						'province' => $province,
					);

		$page = (!is_null(Input::get('page')) && Input::get('page') != '') ? Input::get('page') : "1";
		$params = array(
			'page'		=> $page ,
			'limit'		=> ( $this->perpage ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			//'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$model = new Post();
		$results = $model->getRows( $params );
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);
		$data['order'] 		= $data_order;
		$data['province']	= $data_province;
		$data['data']		= $results['rows'];
		$data['page']		= $page;
		$data['numpage']	= $params['limit'];
		// Build Pagination 
		$data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$data['pager'] 		= $this->injectPaginate();


		$this->data['pageTitle'] = "Danh sách tin ".$data_province->name;
		$this->data['pageNote'] = CNF_APPNAME;
		$page = 'pages.template.tinhthanh';
		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','tinhthanh');
	}

	public function detailpost($alias = '', $id = ''){
		if(!Session::has('customer')){
			return Redirect::to('');
		}
		$post = DB::table('post')->where('post_id','=',$id)->first();
		$data['customer'] = DB::table('customer')->where('customer_id','=',$post->customer_id)->first();
		$data['input'] = (array)$post;
		$this->data['pageTitle'] = $post->post_subject;
		$this->data['pageNote'] = CNF_APPNAME;
		$page = 'pages.template.detailpost';
		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','detailpost');
	}

	public function getViewfile($file = ''){
		$url = URL::to('').'/uploads/files/'.$file;
		header('Content-Description: Thông tin bài đăng');
	    //header('Content-Type: application/octet-stream');
	    //header('Content-Disposition: attachment; filename='.basename($file));
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	   // header('Content-Length: ' . filesize($url));
	    //readfile($url);
		header('Location: ' . $url);
		die;
	}

	/*public function cart()
	{
		$cart = Session::get('addcart');
		if(count($cart) <= 0){
			return Redirect::to('')->with('message', SiteHelpers::alert('success','Bạn vui lòng chọn mua sản phẩm'));	
		}
		$datacart = array();
		$mdPro = new Nproducts();
		$mdCat = new Ncategories();
		//$total = 0;
		$total_real = 0;
		foreach ($cart as $key => $value) {
			$data = $mdPro->find($key);
			$category = $mdCat->find($data->CategoryID);
			$price_convert = SiteHelpers::getPricePromotion($data);

			$price_item = $price_convert * $value;
			//$total += $data->UnitPrice * $value ;
			$total_real += $price_item ;
			$datacart[$key]['image'] = $data->image == '' ? URL::to('').'/sximo/images/no_pic.png' : URL::to('').'/uploads/products/thumb/'.$data->image;
			$datacart[$key]['ProductName'] = $data->ProductName;
			$datacart[$key]['categoryname'] = $category->CategoryName != "" ?  $category->CategoryName : 'Unknow';
			$datacart[$key]['sl'] = $value;
			$datacart[$key]['price'] = number_format($price_convert,0,',','.') . 'VNĐ';
			$datacart[$key]['price_total'] = number_format($price_item,0,',','.') . 'VNĐ';
			$datacart[$key]['price_promition'] = $data->id_promotion != 0 ? '<br/><span style="color: #f00;font-weight: normal;text-decoration: line-through;">'.number_format($data->UnitPrice,0,',','.') . 'VNĐ</span><br/>' : '';
			$datacart[$key]['link'] = URL::to('')."/detail/".$data->slug . "-" . $data->ProductID . ".html";
		}
		$datas['cart'] = $datacart;
		//$datas['total'] = $total;
		$datas['total_real'] = number_format($total_real,0,',','.') . 'VNĐ';
		$datas['total'] = $total_real;
		//print_r($data);die;

		$seo['pageTitle'] = 'Cart';
		$seo['pageNote'] = 'Welcome To Our Site';
		$html = SiteHelpers::renderHtml('pages.template.cart');
		$this->layout->nest('content',$html,$datas)->with('page', $seo);
	}

	public function postOrder(){
		$cart = Session::get('addcart');
		if(count($cart) <= 0){
			return Redirect::to('')->with('message', SiteHelpers::alert('warning','Bạn vui lòng chọn mua sản phẩm'));	
		}
		$rules = array(
			'recaptcha_response_field'=>'required|recaptcha',
			);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$data = $this->getDataPost('orders');
			$data['total'] = SiteHelpers::getTotalcart();
			unset($data['lang']);
			$data['OrderDate'] = date('Y-m-d H:i:s', time());
			$mdOrderDetail = new Orderdetail();
			$mdOrder = new Order();
			$mdPro = new Nproducts();
			$ID = $mdOrder->insertRow($data,'');
			if($ID){
				foreach($cart as $key=>$val){
					$product = $mdPro->find($key);
					$price = SiteHelpers::getPricePromotion($product);
					$data_cart['UnitPrice'] = $price;
					$data_cart['OrderID'] = $ID;
					$data_cart['ProductID'] = $key;
					$data_cart['Quantity'] = $val;
					$mdOrderDetail->insertRow($data_cart,'');
				}

				Session::put('addcart',array());
				Session::save();
			}
			return Redirect::to('')->with('message', SiteHelpers::alert('success','Đặt hàng thành công'));
		}
		else{
			return Redirect::to('checkout.html')->with('message_checkout', SiteHelpers::alert('warning','Sai mã bảo mật'))->with('input_rd',Input::all());
		}
	}*/

	public function search(){
		if(Input::get('search') == ''){
			return Redirect::to('');
		}
		$s = Input::get('search');
		$sortget = ( Input::get('sort') != '') ? Input::get('sort') : 'ProductID-desc';
		list($sort,$order) = explode('-', $sortget);
		$filter = " AND status = 1 AND (ProductName LIKE '%".$s."%' OR Slug LIKE '%".$s."%' OR Content LIKE '%".$s."%' OR description LIKE '%".$s."%') AND lang = '$this->lang'";
		$page = (!is_null(Input::get('page') && Input::get('page') != '')) ? Input::get('page') : 1;
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null(Input::get('numpage')) ? filter_var(Input::get('numpage'),FILTER_VALIDATE_INT) : $this->perpage ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			//'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$model = new Nproducts();
		$results = $model->getRows( $params );
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);
		$data['search']		=$s;
		$data['data']		= $results['rows'];
		$data['page']		= $page;
		$data['sort']		= $sortget;
		$data['numpage']	= $params['limit'];
		// Build Pagination 
		$data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$data['pager'] 		= $this->injectPaginate();


		$this->data['pageTitle'] = 'Kết qua tìm kiếm từ khóa'.'"'.$s.'"';
		$this->data['pageNote'] = 'Welcome To Our Site';

		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.search';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data);
	}

	/*public function checkout()
	{
		$cart = Session::get('addcart');
		if(count($cart) <= 0){
			return Redirect::to('')->with('message', SiteHelpers::alert('success','Bạn không có sản phẩm nào trong giỏ hàng !'));	
		}
		$input = array(
				'name'	=>'',
				'sex'	=>'1',
				'phone'	=>'',
				'email'	=>'',
				'address'	=>'',
				'provinceid'	=>'79',
				'content'	=>'',
				'districtid'	=>'',
				'wardid'	=>'',
			);
		if(Session::has('input_rd')){
			$input = Session::get('input_rd');
		}
		$datas['input'] = $input;
		$datacart = array();
		$mdPro = new Nproducts();
		$mdCat = new Ncategories();
		//$total = 0;
		$total_real = 0;
		foreach ($cart as $key => $value) {
			$data = $mdPro->find($key);
			$category = $mdCat->find($data->CategoryID);
			$price_convert = SiteHelpers::getPricePromotion($data);

			$price_item = $price_convert * $value;
			//$total += $data->UnitPrice * $value ;
			$total_real += $price_item ;
			$datacart[$key]['image'] = $data->image == '' ? URL::to('').'/sximo/images/no_pic.png' : URL::to('').'/uploads/products/thumb/'.$data->image;
			$datacart[$key]['ProductName'] = $data->ProductName;
			$datacart[$key]['categoryname'] = $category->CategoryName != "" ?  $category->CategoryName : 'Unknow';
			$datacart[$key]['sl'] = $value;
			$datacart[$key]['price'] = number_format($price_convert,0,',','.') . 'VNĐ';
			$datacart[$key]['price_total'] = number_format($price_item,0,',','.') . 'VNĐ';
			$datacart[$key]['price_promition'] = $data->id_promotion != 0 ? '<br/><span style="color: #f00;font-weight: normal;text-decoration: line-through;">'.number_format($data->UnitPrice,0,',','.') . 'VNĐ</span><br/>' : '';
			$datacart[$key]['link'] = URL::to('')."/detail/".$data->slug . "-" . $data->ProductID . ".html";
		}
		$datas['cart'] = $datacart;
		//$datas['total'] = $total;
		$datas['total_real'] = number_format($total_real,0,',','.') . 'VNĐ';
		$datas['total'] = $total_real;

		$this->data['pageTitle'] = 'Check out';
		$this->data['pageNote'] = 'Welcome To Our Site';

		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.checkout';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$datas)->with('page', $this->data);
	}

	public function getUpdatecart(){
		if($_GET['id'] != '' && $_GET['quality'] != ''){
			$id = $_GET['id'] ;
			$quality = $_GET['quality'] ;
			$cart = Session::get('addcart');
			if(isset($cart[$id])){
				$cart[$id] = $quality;
				Session::put('addcart',$cart);
				Session::save();
			}
		}
		die;
	}*/
	

	public function index()
	{
		if(CNF_FRONT =='false' && Session::get('uid') !=1) :
			if(!Auth::check())  return Redirect::to('user/login');
		endif; 
		$data['items'] = DB::table('products')->where('lang','=',$this->lang)->where('status','=','1')->orderby('created','desc')->limit('20')->get();
		$this->data['pageTitle'] = 'Home';
		$this->data['pageNote'] = 'Welcome To Our Site';
		//$this->data['breadcrumb'] = 'inactive';			
		$page = 'pages.template.home';
		
		$page = SiteHelpers::renderHtml($page);
		

		$this->layout->nest('content',$page,$data)->with('menu', 'index' );
			
	}

	/*public function getAddtocart(){
		if($_GET['id'] != '' && $_GET['quality'] != ''){
			$id = $_GET['id'] ;
			$quality = $_GET['quality'] ;
			$cart = Session::get('addcart');
			if(isset($cart[$id])){
				$cart[$id] = $cart[$id] + $quality;
			}
			else{
				$cart[$id] =  $quality;
			}
			
			Session::put('addcart',$cart);
			Session::save();
		}
		$output = SiteHelpers::getCart();

		echo $output;die;

	}

	public function getLoadcart(){
		$cart = Session::get('addcart');
		if(count($cart) > 0){
			$mdPro = new Nproducts();
			$datacart = array();
			foreach($cart as $key=>$val){
				$data = $mdPro->find($key);
				$price_convert = SiteHelpers::getPricePromotion($data);
				$price_item = $price_convert * $val;
				$datacart[$key]['ProductName'] = $data->ProductName;
				$datacart[$key]['image'] = $data->image != '' ? asset('uploads/products/thumb').'/'.$data->image : asset('sximo/images/no_pic.png');
				$datacart[$key]['sl'] = $val;
				$datacart[$key]['link'] = URL::to('detail').'/'.$data->slug.'-'.$data->ProductID.'.html';
				$datacart[$key]['price'] = number_format($price_convert,0,',','.').' VNĐ';
			}
			$view = View::make('pages.template.loadcart')->with('datacart', $datacart);
	    	echo $view;die;
		}else{
			echo '';die;
		}

	}

	public function getRemovecart(){
		if($_GET['id'] != ''){
			$id = $_GET['id'] ;
			$cart = Session::get('addcart');
			unset($cart[$id]);
			Session::put('addcart',$cart);
			Session::save();
		}
		$output = SiteHelpers::getCart();

		echo $output;die;
	}

	public function productdetail($alias = '',$id = ''){
		$mdPro = new Nproducts();
		$mdCat = new Ncategories();
		$mdImg = new Imagesproduct();
		$product = $mdPro->find($id);
		$cat = $mdCat->find($product->CategoryID);
		$images = $mdImg->getImagesOfProduct($product->ProductID);

		$pro_same = DB::table('products')->where('ProductID','!=',$product->ProductID)->where('status','=',1)->where('lang','=',$this->lang)->where('CategoryID','=',$product->CategoryID)->limit(10)->get();

		$data['pro_same'] = $pro_same;
		$data['cat'] = $cat;
		$data['cat_link'] = $cat != NULL ? "» <a href='".URL::to('')."/category/".$cat->alias."-".$cat->CategoryID.".html'>".$cat->CategoryName."</a>" : '';
		$data['images'] = $images;
		$data['product'] = $product;
		$seo['pageTitle'] = $product->ProductName;
		$seo['pageNote'] = $cat != NULL ? $cat->CategoryName :'Welcome To Our Site';
		$html = SiteHelpers::renderHtml('pages.template.productdetail');
		$this->layout->nest('content',$html,$data)->with('page', $seo);
	}

	public function categorydetail($alias = '',$id = ''){
		
		$cat = Ncategories::detail($id);
		$sortget = ( Input::get('sort') != '') ? Input::get('sort') : 'ProductID-desc';
		list($sort,$order) = explode('-', $sortget);
		$filter = " AND status = 1 AND CategoryID = $id AND lang = '$this->lang'";
		$page = (!is_null(Input::get('page') && Input::get('page') != '')) ? Input::get('page') : 1;
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null(Input::get('numpage')) ? filter_var(Input::get('numpage'),FILTER_VALIDATE_INT) : $this->perpage ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			//'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$model = new Nproducts();
		$results = $model->getRows( $params );
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);
		$data['cat']		=$cat;
		$data['data']		= $results['rows'];
		$data['page']		= $page;
		$data['sort']		= $sortget;
		$data['numpage']	= $params['limit'];
		// Build Pagination 
		$data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$data['pager'] 		= $this->injectPaginate();

		$html = SiteHelpers::renderHtml('pages.template.category');
		$this->layout->nest('content',$html,$data);
	}*/
	
	public function  postContactform()
	{
	
		$this->beforeFilter('csrf', array('on'=>'post'));
		$rules = array(
				'name'		=>'required',
				'email'	=>'required|email',
				'phone'	=>'required|Numeric',
				'content'	=>'required',
				'subject'	=>'required',
				'recaptcha_response_field'=>'required|recaptcha',
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) 
		{
			
			$data = array('name'=>Input::get('name'),'phone'=>Input::get('phone'),'email'=>Input::get('email'),'content'=>Input::get('content'),'subject'=>Input::get('subject')); 
			/*$message = View::make('emails.contact', $data); 		
			$to 		= 	CNF_EMAIL;
			$subject 	= Input::get('subject');
			$headers  	= 'MIME-Version: 1.0' . "\r\n";
			$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers 	.= 'From: '.Input::get('name').' <'.Input::get('email').'>' . "\r\n";
			mail($to, $subject, $message, $headers);*/
			Mail::send('emails.contact', $data, function($message)
			{
				$message->from( Input::get('email'), Input::get('name') );
			    $message->to(CNF_EMAIL, 'Admin')->subject(Input::get('subject'));
			});
			return Redirect::to(URL::to('')."/thong-bao.html")->with('message', SiteHelpers::alert('success','Yêu cầu của bạn đã được gởi !'));	
				
		} else {
			return Redirect::to(URL::to('')."/contact-us.html")->with('message_contact', SiteHelpers::alert('error','Vui lòng khắc phục các lỗi bên dưới'))->with('input_rd',Input::all())
			->withErrors($validator)->withInput();
		}		
	}

	public function contactus(){
		$input = array(
				"name"=>'',
				"phone"=>'',
				"email"=>'',
				"content"=>'',
				"subject"=>''
			);
		if(Session::has('input_rd')){
			$input = Session::get('input_rd');
		}
		$data['input'] = $input;


		$page = 'pages.template.contactus';

		$this->data['pageTitle'] = 'Contact US';
		$this->data['pageNote'] = 'Welcome To Our Site';
		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data);
	}

	public function  getLang($lang='en')
	{
		Session::put('lang', $lang);
		return  Redirect::back();
	}	
}