<div class="form-group">
    
    <label for="">{{  $label }}</label> 
    <input type="{{$type}}" name="{{ $name }}" class="form-control" placeholder=""  value="{{ $value }}" 
    @if($dataGender=="Female" && $type=="radio" && $label=="Female")
        checked
    @elseif($dataGender=="Male" && $type=="radio" && $label=="Male")
         checked
    @elseif($dataGender=="Other" && $type=="radio" && $label=="Other")
        checked
    @endif
    
    >
    {{--  {{ $value }}   --}}
    <span class="text-danger">@error( $name) {{ $message }}@enderror</span>
</div>