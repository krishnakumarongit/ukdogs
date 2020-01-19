<nav class="nav flex-column side-nav">

@if(Auth::user()->email_verified == 0)
    <a class="nav-link @if(isset($resend) && $resend == 1)active @endif icon" href="{{ route('resent-mail') }}">
        <i class="fa fa-envelope"></i>Verify Email Address
    </a>
@endif

    <a class="nav-link @if(isset($personal) && $personal == 1)active @endif icon" href="{{ route('my-account-profile') }}">
        <i class="fa fa-user"></i>Personal Details
    </a>
    <a class="nav-link @if(isset($email) && $email == 1)active @endif icon" href="{{ route('my-account-email') }}">
        <i class="fa fa-pencil-square-o"></i>Change Login Email
    </a>
    <a class="nav-link @if(isset($password) && $password == 1)active @endif icon" href="{{ route('my-account-change-password') }}">
        <i class="fa fa-recycle"></i>Change Password
    </a>
    <a class="nav-link  icon" href="my-ads.html">
        <i class="fa fa-heart"></i>My Ads Listing
    </a>
    <a class="nav-link  icon" href="bookmarks.html">
        <i class="fa fa-star"></i>Bookmarks
    </a>
    <a class="nav-link  icon" href="sold-items.html">
        <i class="fa fa-check"></i>Sold Items
    </a>
     <a class="nav-link  icon" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>{{ __('Logout') }}
                                    </a>

</nav>