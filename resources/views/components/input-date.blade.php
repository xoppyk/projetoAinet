<div class="form-group">
    <label class="col-lg-12 control-label">{{$label}}: </label>
    <div class="col-lg-12" id="sandbox-container">
        <input type="text" class="form-control" name="{{$name}}" value="{{old($name)}}" autocomplete="off">
        @if ($errors->has($name))
            <small class="text-danger">
                {{ $errors->first($name) }}
            </small>
        @endif
    </div>
    <script type="text/javascript">
        $('#sandbox-container input').datepicker({
            format: "yyyy/mm/dd"
        });
    </script>
</div>
