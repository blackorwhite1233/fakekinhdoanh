<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('Customer?md='.$masterdetail["filtermd"]) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('Customer?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('Customer/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>{{ Lang::get('core.table_id') }}</td>
						<td>{{ $row->customer_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ Lang::get('core.table_name') }}</td>
						<td>{{ $row->name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ Lang::get('core.table_email') }}</td>
						<td>{{ $row->email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ Lang::get('core.table_phone') }}</td>
						<td>{{ $row->phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ Lang::get('core.username') }}</td>
						<td>{{ $row->username }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ Lang::get('core.table_address') }}</td>
						<td>{{ $row->address }} </td>
						
					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>CMND</td>
						<td>{{ $row->cmnd }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ Lang::get('core.city') }}</td>
						<td>{{ SiteHelpers::getNameaddress($row->provinceid,'province','provinceid') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ Lang::get('core.ward') }}</td>
						<td>{{ SiteHelpers::getNameaddress($row->wardid,'ward','wardid') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ Lang::get('core.district') }}</td>
						<td>{{ SiteHelpers::getNameaddress($row->districtid,'district','districtid') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ Lang::get('core.table_status') }}</td>
						<td>@if($row->status == 1) {{ Lang::get('core.enable') }}  @else {{ Lang::get('core.disable') }}  @endif </td>
						
					</tr>
				
					<!--<tr>
						<td width='30%' class='label-view text-right'>{{ Lang::get('core.table_type_customer') }}</td>
						<td>{{ $row->type }} </td>
						
					</tr>-->
				
		</tbody>	
	</table>    
	</div>
	</div>
</div>
	  