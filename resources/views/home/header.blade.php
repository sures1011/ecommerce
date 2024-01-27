<header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{url('/')}}"><img width="250" src="images/koilogo.jpg" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        
                       
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('products')}}">Products</a>
                        </li>
                        
                        <li class="nav-item">
                           <a class="nav-link" href="contact.html">Contact</a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="{{url('show_cart')}}">Cart</a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="{{url('show_order')}}">Order</a>
                        </li>

                        @if (Route::has('login'))

                        @auth
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('dashboard')}}">Dashboard</a>
                        </li>
                        @else
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('register') }}">Registration</a>
                        </li>
                        @endauth
                        @endif
                        
                     </ul>
                  </div>
               </nav>
            </div>
         </header>