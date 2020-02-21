<?php

namespace Increment\Payment\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Payment\Models\PaymentMethod;
use Increment\Payment\Models\StripeCard;
use Carbon\Carbon;
class PaymentMethodController extends APIController
{
    function __construct(){
      if($this->checkAuthenticatedUser() == false){
        return $this->response();
      }
    	$this->model = new PaymentMethod();
    }

    public function retrieve(Request $request){
    	$data = $request->all();
    	$accountId = $data['account_id'];
    	$result = PaymentMethod::where('account_id', '=', $accountId)->get();
      if(sizeof($result) > 0){
      	$i = 0;
      	foreach ($result as $key) {
      		$payload = $result[$i]['payload'];
	        $payloadValue = $result[$i]['payload_value'];
	        $result[$i]['stripe'] = null;
	        $result[$i]['paypal'] = null;
	        if($payload == 'credit_card'){
	          // stripe
	          $cards = StripeCard::where('id', '=', $payloadValue)->first();
	          $result[$i]['stripe'] = ($cards) ? $cards : null;
	        }else if($payload == 'paypal'){
	          // paypal
	        }else if($payload == 'cod'){
	          // cod
	        }else{
	        	//
	        }
	        $i++;
      	}
      	return response()->json(array(
      		'data'	=> $result,
      		'error' => null,
      		'timestamps' => Carbon::now()
      	));
      }
    	return response()->json(array(
    		'data'	=> null,
    		'error' => null,
    		'timestamps' => Carbon::now()
    	));
    }

    public function update(Request $request){
    	$data = $request->all();
    	$accountId = $data['account_id'];
    	$id = $data['id'];
    	$result = PaymentMethod::where('account_id', '=', $accountId)->where('status', '=', 'active')->first();
    	if($result){
    		PaymentMethod::where('id', '=', $result->id)->update(
    			array(
    				'status'	=> 'inactive',
    				'updated_at' => Carbon::now()
    			)
    		);
    	}
  	  PaymentMethod::where('id', '=', $id)->update(
  			array(
  				'status'	=> 'active',
  				'updated_at' => Carbon::now()
  			)
  		);
  		return response()->json(array(
    		'data'	=> true,
    		'error' => null,
    		'timestamps' => Carbon::now()
    	));
    }

    public function getPaymentMethod($column, $value){
      $result = PaymentMethod::where($column, '=', $value)->where('status', '=', 'active')->get();
      if(sizeof($result) > 0){
        $payload = $result[0]['payload'];
        $payloadValue = $result[0]['payload_value'];
        $result[0]['stripe'] = null;
        $result[0]['paypal'] = null;
        if($payload == 'credit_card'){
          // stripe
          $cards = StripeCard::where('id', '=', $payloadValue)->first();
          $result[0]['stripe'] = ($cards) ? $cards : null;
        }else if($payload == 'paypal'){
          // paypal
        }else if($payload == 'cod'){
          // cod
        }
      }
      return (sizeof($result) > 0) ? $result[0] : null;
    }
}
