<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">CasualFriends</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item me-2">
            <a class="nav-link @yield('activeHome')" aria-current="page" href="{{ route('home') }}">Home</a>
          </li>
          
          @guest
          <li class="nav-item me-2">
            <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
          </li>
          @endguest

          @auth
          <li class="nav-item me-2">
            <a class="nav-link @yield('activeManageFriends')" href="{{ route('friend.index') }}">Manage Friends</a>
          </li>

          <li class="nav-item dropdown me-2">
            <a class="nav-link dropdown-toggle @yield('activeProfile')" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profile
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
              <li><a class="dropdown-item" href="{{ route('logout') }}">Log Out</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown me-2">
            <a class="nav-link dropdown-toggle @yield('activeAvatar')" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Avatar
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{ route('transaction.index') }}">Buy Avatar</a></li>
              <li><a class="dropdown-item" href="{{ route('myavatar') }}">Collectors Angels</a></li>
            </ul>
          </li>
          @endauth

          <li class="nav-item me-2">
            <a class="nav-link @yield('activeTopup')" href="{{ route('show_topup') }}">Top Up</a>
          </li>
          
        </ul>

        <ul class="navbar-nav ms-auto mb-2 me-5 mb-lg-0">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Language
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{ route('locale', 'id') }}">Indonesia</a></li>
                  <li><a class="dropdown-item" href="{{ route('locale', 'en') }}">English</a></li>
              </ul>
          </li>
      </ul>

        
      </div>
    </div>
  </nav>