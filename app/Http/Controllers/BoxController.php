<?php

use Illuminate\Support\Facades\Auth;

namespace App\Http\Controllers;
use App\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
  public function all(){
    return response()->json(Box::all());
  }

  public function index(){
    return response()->json(Box::where( ['user_id' => Auth()->user()->id] )->get());
  }

  public function create(Request $req){
    $box = new Box();
    $box->user_id = Auth()->user()->id;
    $box->name= $req->name;
    $box->price = $req->price;
    if ($box->save()){
      return response()->json(['box' => $box]);
    }
    return response()->json(['error' => "could not create"]);
  }

  public function update(Request $req, $id){
    $box = Box::find($id);

    if ($box->user_id!= Auth()->user()->id){
      return response()->json(['msg' => "This is not your box!"]);
    }

    $box->name= $req->name;
    $box->price = $req->price;
    if ($box->update()){
      return response()->json(['box' => $box]);
    }
    return response()->json(['error' => "could not update"]);
  }

  public function remove(Request $req, $id){
    $box = Box::find($id);

    if ($box->user_id!= Auth()->user()->id){
      return response()->json(['msg' => "This is not your box!"]);
    }

    if ($box->delete()){
      return response()->json(['msg' => 'box removed']);
    }
    return response()->json(['error' => "could not delte"]);
  }
}
