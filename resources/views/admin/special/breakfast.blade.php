
<!DOCTYPE html>
<html lang="en">
  <head>

    @include('admin.css')
  </head>
  <body>

    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.navbar')
      <!-- partial -->

      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.topnav')


        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <!-- form starts -->
            <form action="{{url('/upload-breakfast')}}" method="post" enctype="multipart/form-data" class="form-horizontal align-items-center" style="width:40%" >

                @csrf
                <fieldset>
                  <!-- session message start-->
                @if(Session::has('addmsg'))
                    <p class="alert alert-success">{{Session::get('addmsg')}}</p>
                  @endif
                  <!-- session message end-->

                  <!-- validation error message start-->
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                  <!-- validation error message end -->
                <!-- Form Name -->
                <legend>Week's Special Breakfast Items</legend>

                <!-- Text input-->
                <div class="form-group">
                <label class="col-md-4 control-label" for="product_id">Food Name</label>  
                <div class="col-md-12">
                <input style="color:white" id="product_id" name="food_name" placeholder="Enter Name" class="form-control input-md" type="text" >
                    
                </div>
                </div>

                <!-- price input-->
                <div class="form-group">
                <label class="col-md-4 control-label" for="product_name">Price</label>  
                <div class="col-md-12">
                <input style="color:white" id="product_name" name="food_price" placeholder="Enter Price" class="form-control input-md" type="num" >
                    
                </div>
                </div>

                <!-- Description input-->
                <div class="form-group">
                <label class="col-md-4 control-label" for="product_name_fr">Description</label>  
                <div class="col-md-12">
                <textarea style="color:white" class="form-control" id="product_name_fr" name="food_description" ></textarea>
                    
                </div>
                </div>

                
                <!-- image button --> 
                <div class="form-group">
                <div class="col-md-8">
                    <input id="filebutton" name="food_image" class="input-file" type="file">
                </div>
                </div>


                <!-- Button -->
                <div class="form-group">
                <div class="col-md-8">
                    <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary btn-lg">Add Item</button>
                </div>
                </div>

                </fieldset>
            </form>
            <!-- form ends -->

            <!-- Table starts -->
            <div class="table-responsive mt-3">
              <div class="container-fluid"> 
                <div class="row">
                    <div class="col-sm-6 justify-content-start">
                      <h2>Week's Special Breakfast Items List</h2>
                    </div>
                    <div class="col-sm-6">
                      @if(Session::has('delmsg'))
                      <div class="alert alert-danger">{{Session::get('delmsg')}}</div>
                      @endif    
                    </div>
                </div>
              </div>
            
              
              
              
              
              
              <table class="table table-hover table-striped table-bordered table-dark table-responsive-sm">
                        <thead>
                            <tr align="center">
                            <th style="font-weight: bold; font-size: 100%;" scope="col">SL No.</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Food Name</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Food Price</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Food Description</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Food Image</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deta as $data)
                            <tr align="center">

                            <td>1</td>
                            <td>{{$data->food}}</td>
                            <td>{{$data->price}}</td>
                            <td>{{$data->Description}}</td>
                            <td><img src="/Breakfast_images/{{$data->image}}" alt=""></td>
                            <td>
                              <a type="button" class="btn btn-danger " href="{{url('/deletebreakfast', $data->id)}}" onclick="return confirm('Are you sure to delete?')">Delete</a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
              </table>
              <!-- Table Ends -->
          </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('admin.footer')

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.js')
  </body>
</html>
