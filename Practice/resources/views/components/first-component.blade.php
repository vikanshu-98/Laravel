<div class="form-group">
    <label for="">{{  $label }}</label>
    <input type="{{$type}}" name="{{ $name }}" class="form-control" placeholder="" >
    {{--  {{ $value }}   --}}
    <span class="text-danger">@error( $name) {{ $message }}@enderror</span>
</div>