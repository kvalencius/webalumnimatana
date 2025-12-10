@extends('layout.  ,.,m login')
@section('content')
 <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 400px;">
            <h3 class="text-center">Login</h3>
              @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
           
            <form method="POST" action="{{ url('/login') }}" class="mb-3">
                 @csrf
                 <div class="mb-3">
                    <label for="email" class="form-label" >Email </label>
                    <input type="email" class="form-control" name="email" id="email" required>
                 </div>
                 <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                 </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection

