<?php

return array(
	"accepted"         => "The :attribute must be accepted.",
	"active_url"       => "The :attribute is not a valid URL.",
	"after"            => "The :attribute must be a date after :date.",
	"alpha"            => "The :attribute may only contain letters.",
	"alpha_dash"       => "The :attribute may only contain letters, numbers, and dashes.",
	"alpha_num"        => ":attribute phải là chữ hoặc số.",
	"array"            => "The :attribute must be an array.",
	"before"           => "The :attribute must be a date before :date.",
	"between"          => array(
		"numeric" => ":attribute phải từ :min tới :max ký tự.",
		"file"    => "The :attribute must be between :min and :max kilobytes.",
		"string"  => ":attribute phải từ :min tới :max ký tự.",
		"array"   => "The :attribute must have between :min and :max items.",
	),
	"confirmed"        => "The :attribute confirmation does not match.",
	"date"             => "The :attribute is not a valid date.",
	"date_format"      => "The :attribute does not match the format :format.",
	"different"        => "The :attribute and :other must be different.",
	"digits"           => "The :attribute must be :digits digits.",
	"digits_between"   => "The :attribute must be between :min and :max digits.",
	"email"            => ":attribute Không đúng định dạng.",
	"exists"           => "The selected :attribute is invalid.",
	"image"            => "The :attribute must be an image.",
	"in"               => "The selected :attribute is invalid.",
	"integer"          => "The :attribute must be an integer.",
	"ip"               => "The :attribute must be a valid IP address.",
	"max"              => array(
		"numeric" => "The :attribute may not be greater than :max.",
		"file"    => "The :attribute may not be greater than :max kilobytes.",
		"string"  => "The :attribute may not be greater than :max characters.",
		"array"   => "The :attribute may not have more than :max items.",
	),
	"mimes"            => ":attribute phải có đuôi là: :values.",
	"min"              => array(
		"numeric" => "The :attribute must be at least :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => "The :attribute must be at least :min characters.",
		"array"   => "The :attribute must have at least :min items.",
	),
	"not_in"           => "The selected :attribute is invalid.",
	"numeric"          => ":attribute phải là số.",
	"regex"            => "The :attribute format is invalid.",
	"required"         => ":attribute không được rỗng.",
	"required_if"      => "The :attribute field is required when :other is :value.",
	"required_with"    => "The :attribute field is required when :values is present.",
	"required_without" => "The :attribute field is required when :values is not present.",
	"same"             => ":attribute và :other Phải giống nhau.",
	"size"             => array(
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	),
	"unique"           => ":attribute đã tồn tại.",
	"url"              => ":attribute không đúng định dạng.",
	"recaptcha" => 'Mã bảo mật Không chính xác',
	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
			'username' => 'Tên đăng nhập',
			'name' => 'Tên',
			'email' => 'Email',
			'phone' => 'Số điện thoại',
			'address' => 'Địa chỉ',
			'password' => 'Mật khẩu',
			'repassword' => 'Xác nhận mật khẩu',
			'password' => 'Mật khẩu',
			'provinceid' => 'Tỉnh/Thành',
			'districtid' => 'Quận/Huyện',
			'wardid' => 'Phường/Xã',
			'recaptcha_response_field' => 'Mã bảo mật',
			'newpassword' => 'Mật khẩu mới',
			'confirmpassword' => 'Nhập lại mật khẩu',
			'post_typecustomer' => 'Loại khách hàng',
			'post_provincefrom' => 'Tỉnh/Thành xuất phát',
			'post_districtfrom' => 'Quận/Huyện xuất phát',
			'post_provinceto' => 'Tỉnh/Thành đến',
			'post_districtto' => 'Quận/Huyện đến',
			'post_addressfrom' => 'Địa chỉ xuất phát',
			'post_addressto' => 'Địa chỉ đến',
			'post_datestar' => 'Ngày xuất phát ',
			'post_note' => 'Ghi chú',
			'post_subject' => 'Tiêu đề',
			'post_typecar' => 'Loại xe',
			'post_file1' => 'Tập tin',
			'post_file2' => 'Tập tin',
			'post_price' => 'Giá',
			'post_price_promotion' => 'Giá khuyến mãi',
			'post_name' => 'Tên sản phẩm',
			'post_code' => 'Mã sản phẩm',
			'post_category' => 'Danh mục',
			'post_link' => 'Link sản phẩm',
			'content' => 'Nội dung',
			'subject' => 'Tiêu đề',
		),

);
