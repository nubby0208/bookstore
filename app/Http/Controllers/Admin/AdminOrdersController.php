<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sburina\Whmcs\Facades\Whmcs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminOrdersController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();
        
        $result1 = \Whmcs::GetClients([
            'limitnum' => 1000
        ]);

        $result2 = \Whmcs::GetClientPassword([
            'userid' => 352
        ]);

        // foreach($result['clients']['client'] as $client){
        //     $client['id']
        // }
        // Storage::disk('local')->put('file.txt', 'Your content here');


        // $pid = 0;
        // foreach ($result['products']['product'] as $Item)
        // {
        //     if($Item['name'] == 'AAVV-A_Modo_Mio')
        //         $pid = $Item['pid'];
        // }
        
        $display1 = json_encode($result1);
        $display2 = json_encode($result2);
        $display = $display1 . $display2;
        return view('admin.orders.all-orders', compact('display', 'orders'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order_details = OrderDetail::where('order_id', $id)->get();

        return view('admin.orders.order-details', compact('order_details', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $order = Order::findOrFail($id);
        $order->update($input);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('alert_message', 'Order deleted successfully');
    }
}
