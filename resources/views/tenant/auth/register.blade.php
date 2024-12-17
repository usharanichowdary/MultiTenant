<html>
    <head>
        <title>Tenant Login</title>
    </head>  

<body>
    @if($errors->any())
       @foreach($errors->all() as $error)
           <div>{{ $error }}</div>
        @endforeach
    @endif

    <form method="POST" action="{{ route('tenant.register.store') }}">
        @csrf
        <input type="text" name="name" placeholder=" Enter your name " required/> <br />
        <input type="email" name="email" placeholder=" Enter your email " /> <br />
        <input type="password" name="password" placeholder=" Enter your password " /> <br />
        <input type="password" name="password_confirmation" placeholder="confirm your password "/> <br />
        <button type="submit">Register</button>

    </form>
</body>
</html>