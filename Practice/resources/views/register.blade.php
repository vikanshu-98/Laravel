<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body> 
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-12 mx-auto mt-5">
          <form action="/formData" method="post">
          @csrf
            <div class="form-group">
             <label for="">Enter yout Name</label>
              <input type="text" name="fName" class="form-control" placeholder="" aria-describedby="helpId" value={{old('cfName')}} >
              <span class="text-danger">@error('fName') {{ $message }}@enderror</span>
            </div>
            <div class="form-group">
              <label for="">Enter your Email</label>
              <input type="email" class="form-control" name="email" aria-describedby="emailHelpId" placeholder="">
                <span class="text-danger">@error('email') {{ $message }}@enderror</span>
            </div> 
            <div class="form-group">
              <label for="">Enter yout password</label>
              <input type="password" class="form-control" name="namePassword" placeholder="">
                <span class="text-danger">@error('namePassword') {{ $message }}@enderror</span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
















    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>