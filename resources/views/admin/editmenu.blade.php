
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
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
            <form action="{{url('/updatemenu', $data->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal align-items-center" style="width:40%" >

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
                <legend>Food Items to Update</legend>

                <!-- Text input-->
                <div class="form-group">
                <label class="col-md-4 control-label" for="product_id">Food Name</label>  
                <div class="col-md-12">
                <input style="color:white" id="product_id" name="food_name" value="{{$data->title}}" class="form-control input-md" type="text" >
                    
                </div>
                </div>

                <!-- price input-->
                <div class="form-group">
                <label class="col-md-4 control-label" for="product_name">Price</label>  
                <div class="col-md-12">
                <input style="color:white" id="product_name" name="food_price" value="{{$data->price}}" class="form-control input-md" type="num" >
                    
                </div>
                </div>

                <!-- Description input-->
                <div class="form-group">
                <label class="col-md-4 control-label" for="product_name_fr">Description</label>  
                <div class="col-md-12">
                <textarea style="color:white" class="form-control" id="product_name_fr" name="food_description">{{$data->description}}</textarea>
                    
                </div>
                </div>

                
                <!-- image button --> 
                <div class="form-group">
                <div class="col-md-8">
                    <p>Old Image</p>
                    <img src="/food_images/{{$data->image}}" height="200" width="200"alt="">
                    <input class="mt-3" id="filebutton" name="food_image" class="input-file" type="file">
                </div>
                </div>


                <!-- Button -->
                <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary btn-lg">Update Item</button>
                </div>
                </div>

                </fieldset>
            </form>
            <!-- form ends -->


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
