<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        return view('user.customer.index');
    }

    public function customerList(Request $request)
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

        $all = Customer::count();
        $bran = Customer::orWhere(function ($query) use ($search) {
            $query->orWhere('name', 'like', '%' . $search . '%');
        })->offset($offset)->limit($limit)->orderBy('id','DESC')->get();

        $index = 1 + $offset;

        $data = [];

        foreach($bran as $brand) {

            $data[] = array(
                $index++,
                $brand->name,
                $brand->email,
                $brand->contact,
                $brand->address,
                ' <button class=" btn btn-success btn-sm editModal" data-name = "' . $brand->name . '" data-email = "' . $brand->email . '" data-address = "' . $brand->address . '" data-contact = "' . $brand->contact . '" data-id = "' . $brand->id . '" ><i class="fa fa-edit"></i></button>
                 <button class="btn btn-danger btn-sm deleteModal" data-id = "' . $brand->id . '" ><i class="fa fa-trash"></i></button>',
            );
        }

        $records ['recordsTotal'] = $all;
        $records ['recordsFiltered'] = $all;
        $records ['data'] = $data;

        echo json_encode($records);
    }

    public function customerAdd(Request $request)
    {

        $value = User::where('id',Auth::guard('web')->id())->first();
        

        $val = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'address' => 'required',
        ]);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg' =>$val->errors()->first()]);
        } else {

            $data = new Customer;

            $data->name = $request->name;
            $data->email = $request->email;
            $data->contact = $request->contact;
            $data->address = $request->address;

            if ($value->subs_value > 0) {
                // $remain = ($value->subs_value - (1));
                $use =  $value;
                $use->subs_value = $value->subs_value - (1);
                $ans = $use->update();
                $insert = $data->save();

                if ($insert) {
                return response()->json(['status'=>true, 'msg'=>'Added Successfully..']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong. Try again Later..']);
            }

            } else {

                return response()->json(['status'=>false, 'msg'=>'Your Subscription Pack is Over']);
            }
        }
    }

    public function customerEdit(Request $request)
    {
        $val = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'address' => 'required'
        ]);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {

            $data = Customer::findOrFail($request->id);

            $data->name = $request->name;
            $data->email = $request->email;
            $data->contact = $request->contact;
            $data->address = $request->address;

            $change = $data->update();

            if ($change) {
                return response()->json(['status'=>true, 'msg'=>'Updated Succeessfully..']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong. Try again Later..']);
            }
        }
    }

    public function customerRemove(Request $request)
    {
        $val = Validator::make($request->all(),[
            'id' => 'required|exists:customers,id',
        ]);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {

            $dscrptv = Customer::findOrFail($request->id);

            $remove = $dscrptv->delete();

            if ($remove) {
                return response()->json(['status'=>true, 'msg'=>'Deleted Successfully..']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong. Try again Later..']);
            }
        }
    }
}
