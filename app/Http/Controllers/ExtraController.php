<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtraController extends Controller
{
    public function index(){
        $jsonString = file_get_contents(base_path('resources/json/filter-data.json'));
        $data = json_decode($jsonString);
        $demon_list = array();
        foreach ($data->data->response->billdetails as $key => $dt) {
            $temp = str_replace(' ', '', $dt->body);
            $demon = explode(":",$temp[0]);
            if($demon[1] >= 100000){
                $demon_list[] = $demon[1];   
            }
        }
        return $demon_list;
    }
}
