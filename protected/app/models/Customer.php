<?php
class Customer extends BaseModel  {
	
	protected $table = 'customer';
	protected $primaryKey = 'customer_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT customer.* FROM customer  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE customer.customer_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}

	public static $rules=array(
			"username" => "required|alpha_num|between:5,20|unique:customer",
			"name" => "required|between:5,50",
			"phone" => "required|Numeric",
			"email" => "required|email|unique:customer",
			"password" => "required|alpha_num|between:5,20",
			"repassword" => "required|alpha_num|same:password",
			"link_website" => "required",
			"link_fanpage" => "required",
			//"cmnd" => "required|Numeric",
			//"provinceid" => "required",
			//"districtid" => "required",
			//"wardid" => "required",
			'file'	=>'mimes:gif,png,jpg,jpeg|max:20000',
		);
	
	public function columnTable(){
		$array = array(
			"customer_id" => array("label"=>Lang::get('core.table_id'), "type"=>"text", "name"=>"customer_id", "value" => ""),
			"name" => array("label"=>Lang::get('core.table_name'), "type"=>"text", "name"=>"name", "value" => ""),
			"email" => array("label"=>Lang::get('core.table_email'), "type"=>"text", "name"=>"email", "value" => ""),
			"status" => array("label"=>Lang::get('core.table_status'), "type"=>"radio", "name"=>"status", "value" => "","option"=>array("0"=>Lang::get('core.table_disable'),"1"=>Lang::get('core.table_enable'))),
			"provinceid" => array("label"=>Lang::get('core.table_city'), "type"=>"select_nola", "name"=>"provinceid", "value" => "", "model"=>"province", "id"=>"provinceid", "show" =>"name"),
			"type" => array("label"=>Lang::get('core.table_type_customer'), "type"=>"radio", "name"=>"status", "value" => "","option"=>array("0"=>Lang::get('core.customer_type_enable'),"1"=>Lang::get('core.customer_type_disable'))),
			"created" => array("label"=>Lang::get('core.table_created'), "type"=>"date", "name"=>"created", "value" => ""),
		);
		return $array;
	}

}
