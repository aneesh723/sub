<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;

class SubsController extends Controller
{

    public function index()
    {
        return view('admin.subs.index');
    }

    public function subscriptionList(Request $request)
    {
        if (isset($_GET['search']['value'])) {
            $search = $_GET['search']['value'];
        } else {
            $search='';
        }

        if (isset($_GET['length'])) {
            $limit = $_GET['length'];
        } else {
            $limit = 10;
        }

        if (isset($_GET['start'])) {
            $offset = $_GET['start'];
        } else {
            $offset = 0;
        }

        $orderType = $_GET['order'][0]['dir'];
        $nameOrder = $_GET['columns'][$_GET['order'][0]['column']]['name'];

        $all = Subscription::count();
        $bran = Subscription::orWhere(function ($query) use ($search) {
            $query->orWhere('name', 'like', '%' . $search . '%');
        })->offset($offset)->limit($limit)->orderBy('id','DESC')->get();

        $index = 1 + $offset;

        $data = [];

        foreach($bran as $brand) {

            $data[] = array(
                $index++,
                $brand->name,
                $brand->value,
                $brand->amount,
                ' <button class=" btn btn-success btn-sm editItem" data-name = "' . $brand->name . '" data-value = "' . $brand->value . '" data-amount = "' . $brand->amount . '" data-id = "' . $brand->id . '" ><i class="fa fa-edit"></i></button>
                 <button class="btn btn-danger btn-sm deleteItem" data-id = "' . $brand->id . '" ><i class="fa fa-trash"></i></button>',
            );
        }

        $records ['recordsTotal'] = $all;
        $records ['recordsFiltered'] = $all;
        $records ['data'] = $data;

        echo json_encode($records);
    }

    public function manageSubscriptionSubmit(Request $request)
    {
        $val = Validator::make($request->all(), [
            'name'=>'required',
            'amount'=>'required',
            'value'=>'required'
        ]);

         if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {

        if($request->post('id')>0){
            $data=Subscription::find($request->post('id'));
        }else{
            $data=new Subscription();
        }

        $data->name=$request->post('name');
        $data->amount=$request->post('amount');
        $data->value=$request->post('value');
        $data->save();
        
        if ($data) {
                return response()->json(['status'=>true, 'msg'=>'success...']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong. Try again later...']);
            }

        }
        
    }

    public function deleteSubscription(Request $req)
    {
        $val = Validator::make($req->all(), [
            'id' => 'required|exists:subscriptions,id',
        ]);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {
            $crud = Subscription::findOrFail($req->id);

            $remove = $crud->delete();

            if ($remove) {
                return response()->json(['status'=>true, 'msg'=>'deleted successfully...']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong. Try again later...']);
            }
        }
    }
}
