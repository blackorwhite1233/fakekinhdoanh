<?php
class Advertise extends BaseModel  {
	
	protected $table = 'advertise';
	protected $primaryKey = 'advertise_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT advertise.* FROM advertise  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE advertise.advertise_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	public static $rules=array(
			"advertise_name" => "required",
			"advertise_link" => "required",
			"file" => "mimes:gif,png,jpg,jpeg|image|max:20000",
		);
	public function columnTable(){
		$array = array(
			"advertise_name" => array("label"=>Lang::get('core.table_name'), "type"=>"text", "name"=>"advertise_name", "value" => ""),
			"advertise_link" => array("label"=>Lang::get('core.table_link'), "type"=>"text", "name"=>"advertise_link", "value" => ""),
			"position" => array("label"=>'Vị trí', "type"=>"radio", "name"=>"position", "value" => "","option"=>array("0"=>"Trang chủ","1"=>"Cột trái")),
			"status" => array("label"=>Lang::get('core.table_status'), "type"=>"radio", "name"=>"status", "value" => "","option"=>array("0"=>Lang::get('core.table_disable'),"1"=>Lang::get('core.table_enable'))),
			"created" => array("label"=>Lang::get('core.table_created'), "type"=>"date", "name"=>"created", "value" => ""),
		);
		return $array;
	}

	public static function getAdvertiseHome($limit = 1){
		if($limit == 1){
			$begin = 0;
		}elseif($limit == 2){
			$begin = 1;
		}
		else{
			$begin = 2;
		}
		return DB::table('advertise')->where('position','=',0)->where('status','=',1)->orderBy('advertise_id','DESC')->take(1)->offset($begin)->first();
	}

}
