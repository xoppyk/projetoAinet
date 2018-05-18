<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="#">
          <span data-feather="home"></span>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('me.index')}}">
          <span data-feather="file"></span>
          Profiles
        </a>
    </li> 
      <li class="nav-item">
        <a class="nav-link" href="{{route('me.associates')}}">
          <span data-feather="file"></span>
          Associates
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('me.associatesOf')}}">
          <span data-feather="file"></span>
          Associates Of
        </a>
      </li>{{--
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="bar-chart-2"></span>
          Reports
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="layers"></span>
          Integrations
        </a>
      </li> --}}
    </ul>
    @if(\Auth::user()->admin)
        @include('admin.partials.leftNavBar')
    @endif
  </div>
</nav>
