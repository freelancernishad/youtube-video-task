<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Library\UddoktaPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UddoktapayController extends Controller {

    /**
     * Show the payment view
     *
     * @return void
     */
    public function show() {
        return view( 'uddoktapay.payment-form' );
    }

    /**
     * Initializes the payment
     *
     * @param Request $request
     * @return void
     */
    public function pay( Request $request ) {

        $amount =$request->amount;
        $metadata = $request->all();
        $requestData = [
            'full_name'    => 'Freelancer Nishad',
            'email'        => 'freelancernishad123@gmail.com',
            'amount'       => $amount,
            'metadata'     => $metadata,
            'redirect_url' => route( 'uddoktapay.success' ),
            'cancel_url'   => route( 'uddoktapay.cancel' ),
            'webhook_url'  => env( "UDDOKTAPAY_WEBHOOK_DOMAIN" ),
        ];

        try {
         return   $paymentUrl = UddoktaPay::init_payment( $requestData );
            return redirect ( $paymentUrl );
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Reponse from sever
     *
     * @param Request $request
     * @return void
     */
    public function webhook( Request $request ) {

        $headerApi = isset( $_SERVER['HTTP_RT_UDDOKTAPAY_API_KEY'] ) ? $_SERVER['HTTP_RT_UDDOKTAPAY_API_KEY'] : null;

        if ( $headerApi == null ) {
            return response( "Api key not found", 403 );
        }

        if ( $headerApi != env( "UDDOKTAPAY_API_KEY" ) ) {
            return response( "Unauthorized Action", 403 );
        }

        $validatedData = $request->validate( [
            'full_name'      => 'required',
            'email'          => 'required',
            'amount'         => 'required',
            'invoice_id'     => 'required',
            'metadata'       => 'required',
            'payment_method' => 'required',
            'sender_number'  => 'required',
            'transaction_id' => 'required',
            'status'         => 'required',
        ] );

        Order::findOrFail( $validatedData['metadata']['order_id'] )->update( [
            'status'         => $validatedData['status'],
            'payment_method' => $validatedData['payment_method'],
            'sender_number'  => $validatedData['sender_number'],
            'transaction_id' => $validatedData['transaction_id'],
            'invoice_id'     => $validatedData['invoice_id'],
        ] );

        return response( 'Database Updated' );
        Log::info($data);
    }

    /**
     * Success URL
     *
     * @return void
     */
    public function success() {
        return 'Payment is successful, Thanks for using Uddokta Pay- Regards <a href="https://codecstasy.com">Code Ecstasy</a>';
    }

    /**
     * Cancel URL
     *
     * @return void
     */
    public function cancel() {
        return redirect('/dashboard/user/Recharge');
    }

}
