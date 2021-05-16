<?php 

namespace Modules\PaySubscriptions\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentController extends Controller {

    public function pay(Request $request, $id)
    {
        dd($request->all(), $id);
    }

    public function approval(){

    }

    public function cancelled(){

    }
}