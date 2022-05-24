
@extends('layout.main')
@section('main-section') 
{{--  @php
    pp($data)
@endphp  --}}
<a name="" id="" class="btn btn-primary" href="{{url('/move-trash')}}" role="button">Go To Delete</a>
<a name="" id="" class="btn btn-primary" href="{{url('/customer-list')}}" role="button">Go to List</a>
<div class="row mt-4">
    <div class="col-md-12">
        <form action="/searching" method="POST">
            @csrf
            <div class="form-group"> 
                <input type="text" class="form-control" name="search" id="" aria-describedby="emailHelpId" placeholder="Type to search"> 
            </div>
            <button class="btn btn-success">Search</button>
        </form>
    </div> 
</div>
    <table class="table mt-5" >
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Gender</th>
            <th>Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key)

        <tr>
            <td>  {{ $key->name }}</td>
            <td>  {{ $key->email }}</td>
            <td>  {{ $key->password }}</td>
            <td><i class="fas fa-pills "><span class="badge badge-pill badge-primary">{{ $key->gender }}</span></td>
            <td>  {{ $key->created_at }}</td>
            <td> 
                  <a name="" id="" class="btn btn-primary" href="{{url('/edit-data')}}/{{$key->customer_id }} " role="button">Edit</a>
                  <a name="" id="" class="btn btn-danger" href="{{url('/delete')}}/{{$key->customer_id }}" role="button">Trash</a> 
             </td>
        </tr>
    @endforeach
    </tbody>
</table>
   {{ $data->links() }}
@endsection