<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register</title>
    <link href="/css/styles_login.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>

</head>

<body class="bg-image" style="background-image: url('https://assets.proof.pub/2056/firstround/JTBD%20framework.jpg'); height: 100vh;">
    <div class="row" id="conteiner">
        <div class="col-sm-6 boxLogin" id="login">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center">
                        <i class="fa-solid fa-gears custom-icon"></i>
                    </div>
                    <h1 class="my-2">ระบบเเจ้งซ่อมออนไลน์</h1>
                    <h3>ลงชื่อเข้าใช้งาน</h3>
                    <input type="email" placeholder="Email" name="email"/>
                    <input type="password" placeholder="Password" name="password"/>
                    <a href="{{ route('password.request') }}">ลืมรหัสผ่านใช่ไหม?</a>
                    <button type="submit" style="font-size: 15px">เข้าสู่ระบบ</button>
                </form>
        </div>
    </div>
</body>

</html>
