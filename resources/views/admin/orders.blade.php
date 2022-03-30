
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

            <!-- Table starts -->
            <div class="table-responsive mt-3">
            <div class="container-fluid"> 
              <div class="row">
                  <div class="col-sm-6 justify-content-start">
                    <h2>Food Order List</h2>
                  </div>
                  <div class="col-sm-6">
                    @if(Session::has('delmsg'))
                    <p class="alert alert-danger">{{Session::get('delmsg')}}</p>
                    @endif    
                  </div>
              </div>
            </div>
            
              
              
              {!! $deta->links() !!} 
              
              
              <table class="table table-hover table-striped table-bordered table-dark table-responsive-sm">
                        <thead>
                            <tr align="center">
                            <th style="font-weight: bold; font-size: 100%;" scope="col">SL No.</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Food Name</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Price</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Quanity</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Total Price</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Customer Name</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Phone</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Address</th>
                            <th style="font-weight: bold; font-size: 100%;" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deta as $data)
                            <tr align="center">

                            <td>1</td>
                            <td>{{$data->food}}</td>
                            <td>{{$data->price}}</td>
                            <td>{{$data->quantity}}</td>
                            <td>${{$data->price * $data->quantity}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->phone}}</td>
                            <td>{{$data->address}}</td>
                            
                            <td>
                              <a type="button" class="btn btn-danger btn-sm" href="{{url('/order-complete', $data->id)}}" onclick="return confirm('Is The reservation Completed?')">Order Completed</a>
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
