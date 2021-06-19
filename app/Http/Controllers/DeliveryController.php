<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\City; // link sang model 
use App\Models\Wards; // link sang model 
use App\Models\Province; // link sang model 
use App\Models\Feeship; // link sang model 
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class DeliveryController extends Controller
{

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
             return Redirect::to('admin')->send();
        }
    }
    public function calculator_delivery(Request $Request){
        $data = $Request->all();
        if($data['city']){
            $feeship= Feeship::where('feeship_matp',$data['city'])->where('feeship_maqh',$data['province'])->where('feeship_xaid',$data['wards'])->get();
            if(($feeship->count())==0){
                Session::put('fee',1000);
                 Session::save(); 
            }else{
                 foreach($feeship as $key => $val){
                   Session::put('fee',$val->feeship);
                   Session::save();
                }
            }
        }
    }
    public function update_delivery(Request $Request){
        $this->AuthLogin();
    	$data = $Request->all();
    	$feeship = Feeship::find($data['feeship_id']);
    	$number = rtrim($data['fee_number'],'.');
    	$feeship->feeship = $number;
    	$feeship->save();
    }
    public function select_feeship(){
    	$this->AuthLogin();
    	$feeship = Feeship::orderby('feeship_id','DESC')->get();
    	$output = '';
    	$output.='<div class="table-responsive">
    		<table class="table table-bordered">
    			<thread>
    				<tr>
    					<td>Tên tỉnh/thành phố</td>
    					<td>Tên quận/huyện</td>
    					<td>Tên xã phường</td>
    					<td>Phí ship (vnđ)</td>
    				</tr>
    			</thread>
    			<tbody>';
    			foreach($feeship as $key => $fee) {
    				$output.='
    				<tr>
    					<td>'.$fee->city->name_tp.'</td>
    					<td>'.$fee->province->name_qh.'</td>
    					<td>'.$fee->wards->name_xa.'</td>
    					<td contenteditable data-fee_ship="'.$fee->feeship_id.'" class="feeship_edit">'.number_format($fee->feeship,0,',','.').'</td>
    				</tr>
    				';
    			}
    	$output.='</tbody></table></div>';
    	echo $output;
    }
    public function insert_delivery(Request $Request){
    	$this->AuthLogin();
    	$data = $Request->all();
    	$feeship = new Feeship();
    	$feeship->feeship_matp = $data['city'];
    	$feeship->feeship_maqh= $data['province'];
    	$feeship->feeship_xaid= $data['wards'];
    	$feeship->feeship= $data['feeship'];
    	$feeship->save();
    }
    public function select_delivery(Request $Request){
    	$this->AuthLogin();
    	$data = $Request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="city"){
    			$select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option value="">---Chọn Quận/Huyện---</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name_qh.'</option>';
    			}
    		}else{
    			$select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option value="">---Phường/Xã/Thị trấn---</option>';
    			foreach($select_wards as $key => $ward){
    				$output.= '<option value="'.$ward->xaid.'">'.$ward->name_xa.'</option>';
    			}
    		}
    		echo $output;
    	}
    }
    public function delivery(Request $Request){
    	$this->AuthLogin();
    	$city = City::orderby('matp','ASC')->get();
    	return view('admin.delivery.delivery')->with(compact('city'));

    }
}
