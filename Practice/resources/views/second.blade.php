<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    {{--  conditional   --}}

  @if($name=="vikanshu chauhan")
        <h1>THis is the heading of vikanshu chauhan</h1>
    @else
        <h1>not vikanshu chauhan</h1>
  @endif
      
      @unless($name=="vikanshu")
          <h1>THis s the use of unless </h1>
      @endunless
 </body>
</html>

html-skeleton