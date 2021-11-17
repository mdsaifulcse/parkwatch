<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Reset Password Opt </title>
</head>
<body style="font-family: cursive;">

<p style="font-size: 19px;letter-spacing: 1px;font-weight: 600;text-transform: capitalize;">Hi {{ucfirst($name ?? '')}} ,</p>

<p style="letter-spacing: .5px">This is your reset password Opt : <b>{{$otp ?? ''}}</b>
    <br> This will be expire at {{$expired_at ?? ''}}
    </p>

</body>
</html>