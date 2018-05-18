{{-- Filter Form --}}
<form class="" action="{{route($route)}}" method="GET">
    <div class="d-flex">
        <div class="d-inline-flex align-items-center p-2">

            @if (isset($type))
                <label class="mr-sm-2 mb-0">Type: </label>
                <select name="type" class="form-control">
                    <option selected> All </option>
                    <option value="normal" {{is_selected(request('type'), 'normal')}}>Normal User</option>
                    <option value="admin" {{is_selected(request('type'), 'admin')}}>Admin</option>
                </select>
                &nbsp;
            @endif
            @if (isset($status))
                <label class="mr-sm-2 mb-0">Status: </label>
                <select name="status" class="form-control">
                    <option selected> All </option>
                    <option value="blocked" {{is_selected(request('status'), 'blocked')}}>Blocked</option>
                    <option value="unblocked" {{is_selected(request('status'), 'unblocked')}}>Unblocked</option>
                </select>
            @endif
        </div>
        @if (isset($name))
            <div class="d-inline-flex ml-auto align-items-center  p-2">
                <label class="text-nowrap mr-sm-2 mb-0">Search Name:</label>
                <input type="text" name="name" value="{{request('name') ?? ''}}" class="form-control mr-sm-2 mb-2 mb-sm-0">
                <input type="submit" class="btn btn-primary mr-sm-2 mb-0" value="Filter"></input>
            </div>
        @endif
    </div>
</form>
<br>
