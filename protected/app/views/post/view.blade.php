<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('post?md='.$masterdetail["filtermd"]) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('post?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('post/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>ID</td>
						<td>{{ $row->post_id }} </td>
						
					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>Tên sản phẩm</td>
						<td>{{ $row->post_name }} </td>
						
					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>Người tạo</td>
						<td>{{SiteHelpers::getNameUser($row->customer_id)}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Mã sản phẩm</td>
						<td>{{ $row->post_code }}</td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Danh mục</td>
						<td>{{SiteHelpers::getNameCat($row->post_category)}}</td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Giá</td>
						<td>{{number_format($row->post_price,0,',','.') }} VNĐ </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Giá khuyến mãi</td>
						<td>{{number_format($row->post_price_promotion,0,',','.') }} VNĐ </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Số điện thoại</td>
						<td>{{ $row->phone }} </td>
						
					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>Hình sản phẩm</td>
						<td>
							@if($row->post_image != "")
								<img src="{{URL::to('')}}/uploads/post/thumb/{{$row->post_image}}" />
							@else
								Không có hình ảnh
							@endif
						</td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kích hoạt</td>
						<td>@if($row->active == 1) Đã kích hoạt @else Chưa kích hoat @endif </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Trạng thái</td>
						<td>@if($row->status == 1) Hiện @else Ẩn @endif </td>
						
					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>Created</td>
						<td>{{date('Y-m-d',$row->created)}} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	</div>
	</div>
</div>
	  