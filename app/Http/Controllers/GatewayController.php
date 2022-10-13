<?php

namespace App\Http\Controllers;

use App\Models\Gateway;
use Illuminate\Http\Request;

class GatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



            return Gateway::all();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function show(Gateway $gateway)
    {
        return $gateway;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function edit(Gateway $gateway)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gateway $gateway)
    {
        $data = $request->all();
        $status = $request->status;

        if($status=='active'){
            $status = true;
        }else{
            $status = false;
        }

        $getStatusText = '';
        $getName = '';
        $name = $request->name;
        if($name=="Bkash"){
            $getName = 'bkash_number';
            $getStatusText = 'bkash_enabled';

        }elseif($name=="Nagad"){
            $getName = 'nagad_number';
            $getStatusText = 'nagad_enabled';
        }elseif($name=="Rocket"){
            $getName = 'rocket_number';
            $getStatusText = 'rocket_enabled';
        }

echo "https://jmyearnmoney.com/paymentupdate.php?name=$getName&value=$number&getStatusText=$getStatusText&status=$status";
        $number = $request->number;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://jmyearnmoney.com/paymentupdate.php?name=$getName&value=$number&getStatusText=$getStatusText&status=$status",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;


       return  $gateway->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gateway $gateway)
    {
        //
    }
}
