<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class FirebaseController extends Controller
{
    public function __construct(Database $database){
        $this->middleware('auth');
        $this->factory = (new Factory)->withServiceAccount(base_path('resources/json/asdas-9ca97-firebase-adminsdk-rag7w-629bbf73c0.json'));
        $this->database = $database;
    }

    public function index(){
        $database = app('firebase.database');
        $list_item = $database->getReference('item')
                ->getValue();
        $data = array();
        foreach($list_item as $key => $li){
            $field = array(
                        '_id' => $key, 
                        'title' => $li['title'], 
                        'price' => $li['price'], 
                    );
            $data[] = $field;
        }
        return response()->json($data, 200);
    }

    public function show($_id){
        $database = app('firebase.database');
        $detail_item = $database->getReference('item/'.$_id)
                ->getValue();
        return response()->json(array("data"=> $detail_item), 200);
    }

    public function store(Request $request){
        try{
            $this->validate($request, [
                'title' => 'required',
                'price' => 'required|numeric'
            ]);
            $title = $request->post('title');
            $price = $request->post('price');
            $database = app('firebase.database');
            $database->getReference('item')
                ->push([
                'title' => $title,
                'price' => $price
            ]);
            return response()->json(array("message"=> "Success Create Item on firebase"), 201);
        }
        catch(\ModelNotFoundException $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $_id){
        try{
            $this->validate($request, [
                'title' => 'required',
                'price' => 'required|numeric'
            ]);
            $title = $request->post('title');
            $price = $request->post('price');
            $database = app('firebase.database');
            $database->getReference('item/'.$_id)
                    ->set([
                        'title' => $title,
                        'price' => $price
                    ]);
            return response()->json(array("message"=> "Success Update Item"), 200);
        }catch(\ModelNotFoundException $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($_id){
        try{
            $database = app('firebase.database');
            $database->getReference('item/'.$_id)
                    ->remove();
            return response()->json(array("message"=> "Success delete Item"), 200);
        }catch(\ModelNotFoundException $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
