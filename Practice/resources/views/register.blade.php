

@extends('layout.main')

@section('main-section')
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-12 mx-auto mt-5">
         <h3 class="text-center">{{$tittle}}</h3>
          <form action="{{$action }}" method="post">
          @csrf
          @php
            $v = 1 
          @endphp
          {{--  {{ pp($data) }}  --}}
          <x-first-component type="text" name="fName" value="{{($tittle=='Edit Form')?$data->name:''}}" label="Enter your Name"  />
          <x-first-component type="email" name="email"  value="{{ ($tittle=='Edit Form')?$data->email:''}}" label="Enter your Email"  />
          <x-first-component type="password" name="namePassword"  value="{{($tittle=='Edit Form')?$data->password:''}}" label="Enter your password" />
          <x-first-component type="radio" name="gender" value="Male"  label="Male" gender="{{ ($tittle=='Edit Form')?$data->gender:'' }}"/>
          <x-first-component type="radio" name="gender" value="Female"  label="Female" gender="{{($tittle=='Edit Form')?$data->gender:''}}"/>
          <x-first-component type="radio" name="gender" value="Other" label="Other" gender="{{($tittle=='Edit Form')?$data->gender:''}}" />
            {{--  <div class="form-group">
              <label for="">Enter your Name</label>
              <input type="text" class="form-control" name="fName" aria-describedby="emailHelpId" placeholder="">
              <span class="text-danger">@error('fName') {{ $message }}@enderror</span>
            </div> 
            <div class="form-group">
              <label for="">Enter your Email</label>
              <input type="email" class="form-control" name="email" aria-describedby="emailHelpId" placeholder="">
                <span class="text-danger">@error('email') {{ $message }}@enderror</span>
            </div> 
            <div class="form-group">
              <label for="">Enter your password</label>
              <input type="password" class="form-control" name="namePassword" placeholder="">
                <span class="text-danger">@error('namePassword') {{ $message }}@enderror</span>
            </div>
            <div class="form-group">
              <label for="">you gender</label>
              <input type="radio" class="form-control" name="gender" value="Male">
                <span class="text-danger">@error('namePassword') {{ $message }}@enderror</span>
            </div>  --}}
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>

@endsection