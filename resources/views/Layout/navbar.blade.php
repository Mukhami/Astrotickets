<?php 
$itemscount=Cart::count(); //count of items stored in cart
?>
<style>
nav .badge{
    position: relative;
    top: 25px;
    left: -25px;
}
</style>
<div class="navbar-fixed">
<nav class="indigo darken-2">
    <div class="nav-wrapper">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                 </button>
                <a class="brand-logo" href="/" data-toggle="tooltip" title="Home"><i class="fas fa-user-astronaut white-text fa-2x"></i>ASTROTICKETS</a>
            </div>
            <!-- Navbar Right -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="right">
                    <li>                     
                    <li><a href="{{ route('contact') }}"  data-toggle="tooltip" title="contact us"><b>CONTACT US</b></a></li>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                    <li>
                        <a class="nav-link" href="{{ route('login') }}"  data-toggle="tooltip" title="login"><b>{{ __('LOGIN') }}</b></a></li>
                    <li>
                        <a class="nav-link" href="{{ route('register') }}"  data-toggle="tooltip" title="register"><b>{{ __('REGISTER') }}</b></a>
                    </li>
                    @else
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }}
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="user">MY ACCOUNT</a> </li>
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

                    <li><a href="{{ route('bookmarks') }}" class="btn-floating indigo darken-4 z-depth-0"  data-toggle="tooltip" title="view bookmarked events">
                            <i class="tiny material-icons">bookmark_border</i></a></li>
                </ul>
            </div>
        </div>
</nav>
</div>

