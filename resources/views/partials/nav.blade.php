  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('home') }}">Projeto Ainet</a>
    {{-- <input class="form-control form-control-dark w-50" type="text" placeholder="Search" aria-label="Search"> --}}

    {{-- Edit Profile --}}
    <ul class="navbar-nav px-3 ml-auto justify-content-end">
        <li class="nav-item text-nowrap">
            <a href="{{route('me.editProfile', Auth::user())}}" class="nav-link">EditProfile</a>
        </li>
    </ul>

    {{-- Logout --}}
    <ul class="navbar-nav px-3 justify-content-end">
      <li class="nav-item text-nowrap">
          <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }} </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </li>
    </ul>
  </nav>
