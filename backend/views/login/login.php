<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>网豫游戏 | 登录</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">GAME</h1>

        </div>
        <h3>欢迎登录网豫游戏</h3>
        <p>
        </p>
        <p>快乐游戏，欢乐至上</p>
        <form class="m-t" method="post" role="form" action="<?= \yii\helpers\Url::to(['login/login'])?>">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="用户名" required="">
            </div>
            <div class="form-group">
                <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->csrfToken?>">
                <input type="password" name="password" class="form-control" placeholder="密码" required="">
                <?php if(!empty($error)):?>
                    <label id="cate_name-error" class="error" for="title"><?= $error;?></label>
                <?php endif;?>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">登录</button>
        </form>
        <p class="m-t"> <small>Copyright</strong> 网豫游戏 &copy; 2017-2018</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>
