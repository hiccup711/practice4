<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>感谢您注册WeiboApp</title>
</head>
<body>
<h1>感谢您注册WeiboApp</h1>
<p>请点击下方链接激活账号<br>
    <a href="{{ $user->activation_token }}">
        {{ $user->activation_token }}
    </a></p>
<p>如果这不是您本人操作，请忽略此邮件。</p>
</body>
</html>
