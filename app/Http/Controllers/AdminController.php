<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FoodItems;
use App\Models\Chef;
use App\Models\Reservation;
use App\Models\Order;
use App\Models\Breakfast;
use App\Models\Dinner;
use Auth;
use Session;
use File;

class AdminController extends Controller
{
    
    //general user & super Admin function
    public function user(){

        if(Auth::id()){

        $userdeta = User::paginate(5);
        //$userdeta = User::all();
        return view('admin.users', compact('userdeta'));

        }else{
            return redirect('login');
        }
    }
    //Delete User function
    public function deleteuser($id){

        if(Auth::id()){

        $userdata = User::find($id);
        $userdata->delete();
        return redirect()->back();

        }else{
            return redirect('login');
        }
    }

    //Food items list function
    public function foodmenu(){
        if(Auth::id()){

       // $deta = FoodItems::all();
       $deta = FoodItems::Paginate(2);
        return view('admin.foodmenu', compact('deta'));

        }else{
            return redirect('login');
        }  
    }

    //Food Item add via form function
    public function uploadfood(Request $request){

        if(Auth::id()){

        //validation
        $rules = [
            'food_name'=>'required|max:10',
            'food_price'=>'required',
            'food_description'=>'required',
            'food_image'=>'required'
        ];
        $this->validate($request, $rules);


        $data = new FoodItems;

        //creating image name and storing to public folder
        $image = $request->food_image;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $request->food_image->move('food_images', $imageName);

        //uploading in database
        $data->title = $request->food_name;
        $data->price = $request->food_price;
        $data->description = $request->food_description;
        $data->image = $imageName;

        $data->save();
        Session::flash('addmsg', 'Data Added successfully'); 
        return redirect()->back();

        }else{
            return redirect('login');
        }         

    }

    //Food Item Delete function 
    public function deletemenu($id){

        if(Auth::id()){
        $foodmenu = FoodItems::find($id);

        //deleting image from folder
        $destination = 'food_images/'.$foodmenu->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $foodmenu->delete();
        Session::flash('delmsg', 'Data Deleted successfully');
        return redirect()->back();
        
        }else{
            return redirect('login');
        }
    }

    
    //Food Items Edit Form function
    public function editmenu($id){
        if(Auth::id()){
        $data = FoodItems::find($id);
        return view("admin.editmenu", compact('data'));
        }else{
            return redirect('login');
        }
    }

    //Updating Food Items function
    public function updatemenu(Request $request, $id){

        if(Auth::id()){
        //validation
        $rules = [
            'food_name'=>'required|max:10',
            'food_price'=>'required',
            'food_description'=>'required',
        ];
        $this->validate($request, $rules);


        $data = FoodItems::find($id);
        $image = $request->food_image;

        
        //uploading in database
        if($image){
            //creating image name and storing to public folder
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $request->food_image->move('food_images', $imageName);
        $data->image = $imageName;
        }
        $data->title = $request->food_name;
        $data->price = $request->food_price;
        $data->description = $request->food_description;

        $data->save();
        Session::flash('addmsg', 'Data Added successfully'); 
        return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    //Reservation function 
    public function reservation(Request $request){

        if(Auth::id()){
        }else{
            $data = new Reservation;
            //validation
            $rules = [
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'guest'=>'required',
                'date'=>'required',
                'time'=>'required',
                'message'=>'required',
            ];
            $this->validate($request, $rules);
    
    
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->guest = $request->guest;
            $data->date = $request->date;
            $data->time = $request->time;
            $data->message = $request->message;
    
            $data->save();
            
            return redirect()->back();
            return redirect('login');
        }
    }

    //View the reservation from backend function
    public function viewreserve(){

        if(Auth::id()){
                    // $deta = Reservation::all();
        $deta = Reservation::Paginate(3);
        
        return view('admin.viewreserve', compact('deta'));
        }else{
            return redirect('login');
        }

    }

    //Reservation Completed function
    public function reserve_complete($id){

        if(Auth::id()){

            $reservation = Reservation::find($id);
            $reservation->delete();
            Session::flash('msg', 'Reservation Completed Successfully');
            return redirect()->back();
        }else{
            return redirect('login');
        }

    }

    //Chef add function
    public function uploadchef(Request $request){

        if(Auth::id()){
            $rules = [
                'chef_name'=>'required',
                'chef_speciality'=>'required',
                'chef_country'=>'required',
                'chef_image'=>'required'
            ];
            $this->validate($request, $rules);
    
    
            $data = new Chef;
    
            //creating image name and storing to public folder
            $image = $request->chef_image;
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->chef_image->move('chef_images', $imageName);
    
            //uploading in database
            $data->name = $request->chef_name;
            $data->speciality = $request->chef_speciality;
            $data->country = $request->chef_country;
            $data->image = $imageName;
    
            $data->save();
            Session::flash('addmsg', 'Data Added successfully'); 
            return redirect()->back();
        }else{
            return redirect('login');
        }

    }

    //chef view and manage function
    public function chefmanage(){

        if(Auth::id()){
            $deta = chef::Paginate(5);
            return view('admin.chefmanage', compact('deta'));
        }else{
            return redirect('login');
        }

    }

    //chef edit form function
    public function editchef($id){

        if(Auth::id()){
            $data = chef::find($id);
            return view('admin.editchef', compact('data'));
        }else{
            return redirect('login');
        }

    }

    //Updating chefs function
    public function updatechef(Request $request, $id){

        if(Auth::id()){
                    //validation
        $rules = [
            'chef_name'=>'required',
            'chef_speciality'=>'required',
            'chef_country'=>'required',
        ];
        $this->validate($request, $rules);


        $data = Chef::find($id);
        $image = $request->chef_image;

        
        //uploading in database
        if($image){
            //creating image name and storing to public folder
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $request->chef_image->move('chef_images', $imageName);
        $data->image = $imageName;
        }
        $data->name = $request->chef_name;
        $data->speciality = $request->chef_speciality;
        $data->country = $request->chef_country;

        $data->save();
        Session::flash('addmsg', 'Data updated successfully'); 
        return redirect()->back();
        }else{
            return redirect('login');
        }
   
    }

    //Deleting Chef function 
    public function deletechef($id){

        if(Auth::id()){
            $chef = Chef::find($id);

            //deleting image from folder
            $destination = 'chef_images/'.$chef->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $chef->delete();
            Session::flash('delmsg', 'Data Deleted successfully');
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    //Showing the orders function
    public function orders(){

        if(Auth::id()){
            $deta = Order::Paginate(3);
            return view('admin.orders', compact('deta'));
        }else{
            return redirect('login');
        }

    }


    //Completing the orders function
    public function order_complete($id){

        if(Auth::id()){
            $order = Order::find($id);

            $order->delete();
            Session::flash('delmsg', 'Order Completed');
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    //Searching from the orders function
    public function search_order(Request $request){

        if(Auth::id()){
            if($request->isMethod('post')){
                $search = $request->get('search');
                $deta = Order::where('food', 'Like', '%'.$search.'%')->Paginate(3);
            }
            
            // $search = $request->search;
    
            // $deta = Order::where('name', 'Like', '%'.$search.'%')->Paginate(3);
    
            return view('admin.orders', compact('deta'));
        }else{
            return redirect('login');
        }
    
    }


    //Breakfast menu
    public function breakfast(){
        if(Auth::id()){
            $deta = Breakfast::all();
            return view('admin.special.breakfast', compact('deta'));
        }else{
            return redirect('login');
        }
    }

    //Breakfast menu Add
    public function uploadbreakfast(Request $request){

        if(Auth::id()){

        //validation
        $rules = [
            'food_name'=>'required|max:10',
            'food_price'=>'required',
            'food_description'=>'required',
            'food_image'=>'required'
        ];
        $this->validate($request, $rules);


        $data = new Breakfast;

        //creating image name and storing to public folder
        $image = $request->food_image;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $request->food_image->move('Breakfast_images', $imageName);

        //uploading in database
        $data->food = $request->food_name;
        $data->price = $request->food_price;
        $data->Description = $request->food_description;
        $data->image = $imageName;

        $data->save();
        Session::flash('addmsg', 'Data Added successfully'); 
        return redirect()->back();

        }else{
            return redirect('login');
        }         

    }

    //Dinner menu
    public function dinner(){
        if(Auth::id()){
            $deta = Dinner::all();
            return view('admin.special.dinner', compact('deta'));
        }else{
            return redirect('login');
        }
    }

    //Dinner menu Add
    public function uploaddinner(Request $request){

        if(Auth::id()){

        //validation
        $rules = [
            'food_name'=>'required|max:10',
            'food_price'=>'required',
            'food_description'=>'required',
            'food_image'=>'required'
        ];
        $this->validate($request, $rules);


        $data = new Dinner;

        //creating image name and storing to public folder
        $image = $request->food_image;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $request->food_image->move('dinner_images', $imageName);

        //uploading in database
        $data->food = $request->food_name;
        $data->price = $request->food_price;
        $data->Description = $request->food_description;
        $data->image = $imageName;

        $data->save();
        Session::flash('addmsg', 'Data Added successfully'); 
        return redirect()->back();

        }else{
            return redirect('login');
        }         

    }

    //Breakfast Item Delete function 
    public function deletebreakfast($id){

        if(Auth::id()){
        $data = Breakfast::find($id);

        //deleting image from folder
        $destination = 'breakfast_images/'.$data->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $data->delete();
        Session::flash('delmsg', 'Data Deleted successfully');
        return redirect()->back();
        
        }else{
            return redirect('login');
        }
    }


    //Dinner Item Delete function 
    public function deletedinner($id){

        if(Auth::id()){
        $data = Dinner::find($id);

        //deleting image from folder
        $destination = 'dinner_images/'.$data->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $data->delete();
        Session::flash('delmsg', 'Data Deleted successfully');
        return redirect()->back();
        
        }else{
            return redirect('login');
        }
    }

}
