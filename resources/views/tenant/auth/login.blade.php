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

    <form method="POST" action="{{ route('tenant.login.store') }}">
        @csrf
        <input type="email" name="email" placeholder=" Enter your email " /> <br />
        <input type="password" name="password" placeholder=" Enter your password " /> <br />
        <button type="submit">Login</button>

    </form>
</body>
</html>