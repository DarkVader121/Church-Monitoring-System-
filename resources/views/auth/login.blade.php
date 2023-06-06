@extends('layouts.master')

@section('content')

     <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
         <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2 class="title">Login</h2>
            <div class="input-field">
                <i class="fas fa-user @error('username') is-invalid @enderror"></i>
                <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" />
            </div>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong style="color: red;">{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-field @error('username') is-invalid @enderror">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" />
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong style="color: red;">{{ $message }}</strong>
                </span>
            @enderror
           <button type="submit" class="btn btn-primary">Login</button>
          </form>
    
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h1>Lila Holy Rosary Parish Monitoring System</h1>
          </div>
          <img src="img/ntc.png" class="image" alt=""  />
        </div>
      </div>
    </div>
@endsection
 