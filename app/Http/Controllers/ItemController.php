<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
         $list_item = Item::all();
         return response()->json(array("data"=> $list_item), 200);
    }

    public function show($_id){
        $detail_item = Item::findOrFail($_id);
        return response()->json(array("data"=> $detail_item), 200);
    }

    public function store(Request $request){
        try{
             $this->validate($request, [
                'title' => 'required',
                'price' => 'required|numeric'
            ]);
            $data = new Item($request->all());
            $data->save();
            if($data){
                return response()->json(array("message"=> "Success Create Item"), 201);
            }
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
       
    }

    public function update(Request $request, $_id){
        try{
            $this->validate($request, [
                'title' => 'required',
                'price' => 'required|numeric'
            ]);
            $detail_item = Item::findOrFail($_id);
            $detail_item->title = $request->post('title');
            $detail_item->price = $request->post('price');
            $detail_item->save();
            if($detail_item){
                return response()->json(array("message"=> "Success Update Item"), 200);
            }
        }catch(\ModelNotFoundException $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($_id){
        try{
            $detail_item = Item::destroy($_id);
            if($detail_item){
                return response()->json(array("message"=> "Success delete Item"), 200);
            }
        }catch(\ModelNotFoundException $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
