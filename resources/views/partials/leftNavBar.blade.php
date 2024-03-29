<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{leftNavBarActive('dashboard')}}" href="{{route('dashboard.show', \Auth::id())}}">
          <span data-feather="home"></span>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
    <li class="nav-item">
        <a class="nav-link {{leftNavBarActive('me.index')}}" href="{{route('me.index')}}">
          <span data-feather="file"></span>
          Profiles
        </a>
    </li>
      <li class="nav-item">
        <a class="nav-link {{leftNavBarActive('me.associates')}}" href="{{route('me.associates')}}">
          <span data-feather="file"></span>
          Associates
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{leftNavBarActive('me.associatesOf')}}" href="{{route('me.associatesOf')}}">
          <span data-feather="file"></span>
          Associates Of
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{leftNavBarActive('accounts.ofUser')}}" href="{{route('accounts.ofUser', \Auth::user())}}">
          <span data-feather="file"></span>
          My Accounts
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{leftNavBarActive('account.create')}}" href="{{route('account.create')}}">
          <span data-feather="file"></span>
          Create Account
        </a>
      </li>

    </ul>
    @if(\Auth::user()->admin)
        @include('admin.partials.leftNavBar')
    @endif
  </div>
</nav>
