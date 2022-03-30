
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
          
            <!-- Table starts -->
          <div class="content-wrapper table-responsive">
              <h1>Admin & Users</h1>
            <div class="d-flex justify-content-start" >
            {!! $userdeta->links() !!}
            </div>
            <table class="table table-hover table-striped table-bordered table-dark table-responsive-sm">
            <thead>
                    <tr align="center">
                    <th style="font-weight: bold; font-size: 100%;" scope="col">SL No.</th>
                    <th style="font-weight: bold; font-size: 100%;" scope="col">Name</th>
                    <th style="font-weight: bold; font-size: 100%;" scope="col">Email</th>
                    <th style="font-weight: bold; font-size: 100%;" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userdeta as $userdata )
                    <tr align="center">
                    <td>1</td>
                    <td>{{$userdata->name}}</td>
                    <td>{{$userdata->email}}</td>
                    @if($userdata->usertype=='0')
                        <td><a type="button" class="btn btn-danger btn-sm" href="{{url('/deleteuser', $userdata->id)}}" onclick="return confirm('Are you sure to delete User: {{$userdata->name}}?')">Delete</a></td>
                    @else
                        <td><a style="font-family:courier; font-weight:bold; color:red;">Super Admin</a></td>
                    @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
          <!-- Table Ends -->

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
