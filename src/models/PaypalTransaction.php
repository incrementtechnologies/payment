<?php

namespace Increment\Payment\Models;

use Illuminate\Database\Eloquent\Model;
use App\APIModel;
class PaypalTransaction extends APIModel
{
    protected $table = 'paypal_transactions';
    protected $fillable = ['account_id', 'paypal', 'cart', 'email', 'first_name', 'last_name', 'middle_name', 'payer', 'total', 'currency'];
}
