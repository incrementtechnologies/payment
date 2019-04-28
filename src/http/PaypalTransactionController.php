<?php

namespace Increment\Payment\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Payment\Models\PaypalTransaction;
class PaypalTransactionController extends APIController
{
    function __construct(){
    	$this->model = new PaypalTransaction();
    }

    public function getPaypalTransaction($id){
      $response = array();
      $result = PaypalTransaction::where('id', '=', $id)->get();
      $response['stripe'] = null;
      $response['paypal'] =  (sizeof($result) > 0) ? $result[0] : null;
      return $response;
    }
}
