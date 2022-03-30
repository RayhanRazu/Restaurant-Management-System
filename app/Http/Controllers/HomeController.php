<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\FoodItems;
use App\Models\Chef;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Breakfast;
use App\Models\Dinner;
use Session;

class HomeController extends Controller
{
    //showing food items
    public function index(){

        //showing food items & Chefs deta
        $fooddeta= FoodItems::all();
        $chefdeta = Chef::all();
        $breakfast = Breakfast::all();
        $dinner = Dinner::all();

        if(Auth::id()){
            return redirect('redirects');
        }else{  
             
            return view('home', compact('fooddeta', 'chefdeta', 'breakfast', 'dinner'));   
        }
        
    }


    public function redirects(){

        
            //showing food items & Chefs deta
            $fooddeta= FoodItems::all();
            $chefdeta = Chef::all();
            $breakfast = Breakfast::all();
            $dinner = Dinner::all();

            $usertype = Auth::User()->usertype;

            if($usertype=='1'){
                
                return view('admin.adminhome');
            }else{

                //Cart data showing in Home view
                $user_id = Auth::id();
                $count = cart::where('user_id', $user_id)->count();
                
                return view('home', compact('fooddeta','chefdeta', 'count','breakfast', 'dinner'));
            }
        

        
    }

    //if I am in super admin then FOR GOING TO WEBSITE PAGE
    public function index2(){

        
        $fooddeta= FoodItems::all();
        $chefdeta = Chef::all();
        $breakfast = Breakfast::all();
        $dinner = Dinner::all();

        //Cart data showing in Home view
        $user_id = Auth::id();
        $count = cart::where('user_id', $user_id)->count();

        return view('home', compact('fooddeta','chefdeta', 'count', 'breakfast', 'dinner'));
        
        
    }

    //Add to cart
    public function addcart(Request $request, $id){

        if(Auth::id()){

            //inserting cart data from home view to database
            $user_id = Auth::id();
            $foodid = $id;
            $quantity = $request->quantity;

            $data = new Cart;

            $data->user_id =$user_id;
            $data->food_id =$foodid;
            $data->quantity =$quantity;

            $data->save();

            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    //showing cart to user
    public function showcart(Request $request, $id ){

        if(Auth::id()){
            $count = Cart::where('user_id', $id)->count();

            if(Auth::id()==$id){
                
            //joining food_items and carts table to get data
            $deta = Cart::where('user_id',$id)->join('food_items', 'carts.food_id', '=', 'food_items.id')->get();

            //for deleting the cart data of a user
            $cartdeta = Cart::select('*')->where('user_id', '=', $id)->get();

            return view('showcart', compact('count', 'deta', 'cartdeta'));
            
            }else{
                return redirect()->back();
            }
        }else{
            return redirect('login');  
        }

        

    }

    //deleting cart data
    public function deletecart($id){

        if(Auth::id()){
            $cart = Cart::find($id);
        
            $cart->delete();
            Session::flash('delmsg', 'You have Successfully removed the item!');
            return redirect()->back();
        }else{ 
        }
        return redirect('login'); 
        
    }

    //Oder confirm button
    public function orderconfirm(Request $request){
        if(Auth::id()){
            foreach($request->foodname as $key=> $foodname){

            $data = new Order;

            $data->food=$foodname;
            $data->price = $request->price[$key];
            $data->quantity = $request->quantity[$key];
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->address = $request->address;

            $data->save();
        }

        return redirect()->back();
        }else{
            return redirect('login'); 
        }
        
    }

    

}
