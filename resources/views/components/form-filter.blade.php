<form class="" action="{{route($route, $parameter ?? '')}}" method="GET">
    <div class="d-flex">
         {{ $slot }}
    </div>
</form>
