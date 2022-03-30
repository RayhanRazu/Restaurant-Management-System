<!DOCTYPE html>
<html lang="en">

  <head>

    <!-- //sometimes if the css does not get supported -->
    <base href="/public">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>Klassy Cafe - Restaurant HTML Template</title>
<!--
    
TemplateMo 558 Klassy Cafe

https://templatemo.com/tm-558-klassy-cafe

-->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-klassy-cafe.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

    <!-- jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <!-- <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>   -->
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{url('home')}}" class="logo">
                            <img src="assets/images/klassy-logo.png" align="klassy cafe html template">\

                            <a class="menu-trigger">
                                <span>Menu</span>
                            </a>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{url('/home')}}" class="">Home</a></li>
                            <li class="scroll-to-section"><a href="{{url('/home')}}">About</a></li>
                           	
                        
                            <li class="scroll-to-section"><a href="{{url('/home')}}">Menu</a></li>
                            <li class="scroll-to-section"><a href="{{url('/home')}}">Chefs</a></li> 
                            
                            <!-- <li class=""><a rel="sponsored" href="https://templatemo.com" target="_blank">External URL</a></li> -->
                            <li class="scroll-to-section"><a href="{{url('/home')}}">Contact Us</a></li> 
                            <li class="scroll-to-section"><a href="{{url('/home')}}">Week's Special</a></li> 
                            <li class="scroll-to-section">
                                @auth
                                <a href="{{url('/showcart', Auth::user()->id)}}" class="active">
                                My-Cart[{{$count}}]
                                </a>
                                @endauth

                                @guest
                                <a href="" class="active">My-cart[0]</a>
                                @endguest
                            </li> 
                            <li>
                            @if (Route::has('login'))
                                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                    @auth
                                        <li class="submenu">
                                            <a href="javascript:;">{{ Auth::user()->name }}</a>
                                            <ul>
                                                <li><a href="{{ route('profile.show') }}">Profile</a></li>
                                                <li><a href="{{url('/logout')}}">Logout</a></li>
                                            </ul>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a></li> 

                                        @if (Route::has('register'))
                                            <li><a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a></li>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                            </li>
                            <li>

                            
                            
                        </ul>        
                        
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div id="top">
        
        <div class="container-fluid" style="margin-top:50px">
        <div class="d-flex justify-content-center">
            <label style="font-weight:bold; font-size: 150%">My Food Cart
              
              <!-- delete notification -->
              @if(Session::has('delmsg'))
                  <p class="alert alert-danger">{{Session::get('delmsg')}}</p>
                @endif
            </label>
        </div>
        <div class="d-flex justify-content-center">
        
        <div class="row col-lg-6">
        
            
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr align="center">
                            <th scope="col">#</th>
                            <th scope="col">Food</th>
                            <th scope="col">Price ($)</th>
                            <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>

                        <!-- for sending the order data in database -->
                        <form action="{{url('orderconfirm')}}" method="post">
                            @csrf
                            @foreach($deta as $data)
                            <tr align="center">
                            <th scope="row">1</th>
                            <td>
                                <input type="text" name="foodname[]" value="{{$data->title}}" hidden="">
                                {{$data->title}}
                            </td>
                            <td>
                            <input type="text" name="price[]" value="{{$data->price}}" hidden="">
                                {{$data->price}}
                            </td>
                            <td>
                            <input type="text" name="quantity[]" value="{{$data->quantity}}" hidden="">
                                {{$data->quantity}}
                            </td>
                            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

        </div>
        <div class="row col-lg-2">
        <table class="table table-bordered">
                <thead class="thead-light">
                    <tr align="center">
                    <th scope="row">Delete From Cart</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($cartdeta as $cartdata)
                    <tr align="center">
                    <td>
                        
                        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')" href="{{url('/deletecart', $cartdata->id)}}">Remove</a>
                        
                    </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
        </div>
        </div>
        </div>
    </div>

    <!-- For Order Button -->
    <div class="container-fluid d-flex justify-content-center" style="margin-top:20px">
        <button type="button" class="btn btn-info" id="order">Order From Cart</button>
    </div>

    <!-- Order Form -->
    <div class="container-fluid justify-content-center row" style="margin:10px 0 10px 0; display:none" id="open" >
        
        <div class="form-group" style="margin-right:10px">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" id="" aria-describedby="emailHelp" placeholder="your name">
        </div>
        <div class="form-group" style="margin-right:10px">
            <label for="">Phone</label>
            <input type="text" name="phone" class="form-control" id="" placeholder="your phone number">
        </div>
        <div class="form-group" style="margin-right:10px">
            <label for="">Address</label>
            <textarea type="text" name="address" class="form-control" id="" placeholder="your address"></textarea>
        </div>
        <div class="form-group" style="margin-right:10px">
        
        <label for="">Send</label>
        <button type="submit" class="btn btn-success btn-sm form-control">Order now</button>
        </div>
        
    </div>

    </form>
    <!-- Ending the sending the order data in database -->
    
       <!-- ***** Footer Start ***** -->
       <!-- <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xs-12">
                    <div class="right-text-content">
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="logo">
                        <a href="index.html"><img src="assets/images/white-logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="left-text-content">
                        <p>© Copyright Klassy Cafe Co.
                        
                        <br>Design: TemplateMo</p>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->

    <!-- for opening the order form -->
    <script type="text/javascript">

        $("#order").click(
            function(){
                $("#open").show();
            }
        )
    </script>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/slick.js"></script> 
    <script src="assets/js/lightbox.js"></script> 
    <script src="assets/js/isotope.js"></script> 
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>
  </body>
</html>