
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
            
              
                <h1>Welcome to Admin panel of Restaurant Management System</h1>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                
                
              
              
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
