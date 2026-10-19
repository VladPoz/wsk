<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('./bootstrap.min.css')}}">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="container">
            <div class="row min-vh-100 align-items-center justify-content-center">
                <div class="col-lg-5 col-md-9">
                    <form method="post" class="border border-1 border-black p-lg-5 rounded-2">
                        @csrf
                        <div class="text-center">
                            <h2 class="fw-bold">Login</h2>
                        </div>
                        <div class="card-body">
                            <div>
                                <label for="username" class="form-text">username</label>
                                <input id="username" placeholder="username" name="username" type="text" class="form-control my-1" value="{{old('username')}}">
                                <label for="username" class=" text-danger">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div>
                                <label for="password" class="form-text">password</label>
                                <input id="password" placeholder="password" name="password" type="text" class="form-control my-1">
                                <label for="password" class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                    @error('error')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <button type="submit" class="btn btn-dark w-100 mt-3">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
