 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
 </head>
 <body>
     <table class="table">
         <thead>
             <tr>
                 <th>Name</th>
                 <th>Email</th> 
             </tr>
         </thead>
         <tbody>
             <tr> 
                 @if(Route::has('user.login'))
                 <td>Login</td>
                 @else
                 <td>{{Auth::user()->name}}</td>
                 <td>{{Auth::user()->email}}</td> 
                 @endif 
                  <form action="{{ url('/user/logout') }}" id="logout-user" method="POST">@csrf <button>logout</button></form>
             </tr> 
         </tbody>
     </table>
 </body>
 </html>