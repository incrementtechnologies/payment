<?php

namespace Increment\Payment\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Payment\Models\StripeCard;
class StripeCardController extends APIController
{
    function __construct(){
      $this->model = new StripeCard();
    }
}
