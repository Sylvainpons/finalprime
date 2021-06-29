<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-3.1.1/css/bootstrap.min.css') }}">
</head>
<body>

<div class="container">
   <div class="row" style="margin-top:45px">
      <div class="col-md-4 col-md-offset-4">
           <h4>Connexion | Dmax Prime</h4><hr>
           <form action="{{ route('acces.check') }}" method="post">
            @if(Session::get('fail'))
               <div class="alert alert-danger">
                  {{ Session::get('fail') }}
               </div>
            @endif

           @csrf
              <div class="form-group">
                 <label>Email</label>
                 <input type="text" class="form-control" name="EMAIL" placeholder="Enter email address" value="{{ old('EMAIL') }}">
                 <span class="text-danger">@error('EMAIL'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label>Password</label>
                 <input type="password" class="form-control" name="PASSWD" placeholder="Enter password">
                 <span class="text-danger">@error('PASSWD'){{ $message }} @enderror</span>
              </div>
              <button type="submit" class="btn btn-block btn-primary">Sign In</button>
              <br>
              <a href="{{ route('acces.register') }}">I don't have an account, create new</a>
           </form>
      </div>
   </div>
</div>

</body>
</html>
