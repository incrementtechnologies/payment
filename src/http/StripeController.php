<?php

namespace Increment\Payment\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Payment\Models\StripeWebhook;
use Increment\Payment\Models\StripeCard;
use Increment\Payment\Models\PaymentMethod;
use Carbon\Carbon;
class StripeController extends APIController
{

    public function create(Request $request){
      $data = $request->all();
      $stripe = new StripeWebhook();
      $accountId = $data['account_id'];
      $source = $data['source'];
      $customer = $stripe->createCustomer($data['email'], $source['id'], $data['name']);
      if($customer->id){
        // $charge = $this->stripe->chargeCustomer($account['email'], $source['id'], $customer->id, (floatval($checkout['total']) * 100), "ID FACTORY BILLING FOR ID PRINTING ");
        $stripeCard = new StripeCard();
        $stripeCard->account_id = $accountId;
        $stripeCard->brand = $source['card']['brand'];
        $stripeCard->last4 = $source['card']['last4'];
        $stripeCard->exp_year = $source['card']['exp_year'];
        $stripeCard->exp_month = $source['card']['exp_month'];
        $stripeCard->source = $source['id'];
        $stripeCard->customer = $customer->id;
        $stripeCard->created_at = Carbon::now();
        $stripeCard->save();
        
        $paymentMethod = new PaymentMethod();
        $paymentMethod->account_id = $accountId;
        $paymentMethod->payload = 'credit_card';
        $paymentMethod->payload_value = $stripeCard->id;
        $paymentMethod->status = 'active';
        $paymentMethod->created_at = Carbon::now();
        $paymentMethod->save();
        return response()->json(
          array(
            'data'  => $stripeCard->id,
            'error' => null,
            'timestamps'  => Carbon::now()
          )
        );

      }else{
        return response()->json(
          array(
            'data'  => 0,
            'error' => 'Card is invalid',
            'timestamps'  => Carbon::now()
          )
        );
      }
    }



}
