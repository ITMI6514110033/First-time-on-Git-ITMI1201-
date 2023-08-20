@extends('master')

@section('title','Login Page')

@section('content')
    <h1 class="mx-3">Login</h1>
    <form action="{{url('login')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
            @error('email')
                <div class="invalid-feedback d-block">{{ $errors->first('email') }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
                <div class="invalid-feedback d-block">{{ $errors->first('password') }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection
</html>
