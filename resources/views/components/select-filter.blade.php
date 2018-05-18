<label class="mr-sm-2 mb-0"> {{$label}} </label>
<select name="{{$name}}" class="form-control">
    <option selected> All </option>
    @foreach ($options as $option)
        <option value="{{$option[0]}}" {{is_selected(request($name), $option[0])}}>{{$option[1]}}</option>
    @endforeach
</select>
