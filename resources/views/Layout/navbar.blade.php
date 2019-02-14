<?php 
$itemscount=Cart::count();
?>

<style>
nav .badge{
    position: relative;
    top: 25px;
    left: -25px;
}
</style>
<nav class="indigo lighten-2 fixed">
    <div class="nav-wrapper">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                 </button>
                <a class="brand-logo" href="/"><i class="fas fa-user-astronaut white-text fa-2x"></i>ASTROTICKETS</a>


            </div>
            <!-- Navbar Right -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="right">
                    <li>                     
                        <li><a href="contact">CONTACT US</a></li>                        
                    </li>

                    <!-- Authentication Links -->
                    @guest
                    <li>
                        <a class="nav-link" href="{{ route('login') }}">{{ __('LOGIN') }}</a></li>
                    <li>
                        <a class="nav-link" href="{{ route('register') }}">{{ __('REGISTER') }}</a>
                    </li>
                    @else
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }}
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="user/{{Auth::user()->id}}">PROFILE</a> </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('LOGOUT') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    <li><a href="cart" class="btn-floating indigo z-depth-0">
                        <i class="material-icons white-text">shopping_cart</i></a>
                        <span class="badge white"><b> <?php echo $itemscount ?> items</b></span>
                        </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
