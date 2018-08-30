<!DOCTYPE HTML>
<html>
<head>
    <title>老王个人博客 — 一个站在java开发之路上的草根程序员个人博客网站</title>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="keywords" content="个人博客,王风宇个人博客,个人博客系统,老王博客,王风宇">
    <meta name="description" content="Lao王博客系统，一个站在java开发之路上的草根程序员个人博客网站。">
    <LINK rel="Bookmark" href="favicon.ico" >
    <LINK rel="Shortcut Icon" href="favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/staticRes/js/html5shiv.js"></script>
    <script type="text/javascript" src="/staticRes/js/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="plugin/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="plugin/Hui-iconfont/1.0.8/iconfont.min.css" />
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <link rel="stylesheet" type="text/css" href="plugin/pifu/pifu.css" />
    <link rel="stylesheet" type="text/css" href="plugin/wangEditor/css/wangEditor.min.css">
<!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <style>
        /*分页样式*/
        .pagination{text-align:center;margin-top:20px;margin-bottom: 20px;}
        .pagination li{margin:0px 10px; border:1px solid #e6e6e6;padding: 3px 8px;display: inline-block;}
        .pagination .active{background-color: #dd1a20;color: #fff;}
        .pagination .disabled{color:#aaa;}
    </style>
    <!--[if lt IE 9]>
    <link href="/staticRes/lib/h-ui/css/H-ui.ie.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript" src="plugin/jquery/1.9.1/jquery.min.js"></script>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } function showSide(){$('.navbar-nav').toggle();}</script>
</head>
<body>
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container cl">
            <a class="navbar-logo hidden-xs" href="index.html">
                <img class="logo" src="img/logo.png" alt="Lao王博客" />
            </a>
            <a class="logo navbar-logo-m visible-xs" href="index.html">Lao王博客</a>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:void(0);" onclick="showSide();">&#xe667;</a>
            <nav class="nav navbar-nav nav-collapse w_menu" role="navigation">
                <ul class="cl">
                    <li class="active"> <a href="<?= \yii\helpers\Url::to(['home/home'])?>" data-hover="首页">首页</a> </li>
                    <li> <a href="<?= \yii\helpers\Url::to(['home/about'])?>" data-hover="关于我">关于我</a> </li>
                    <li> <a href="mood.html" data-hover="碎言碎语">碎言碎语</a> </li>
                    <li><a href="article.html" data-hover="学无止尽">学无止尽</a></li>
                    <li> <a href="board.html" data-hover="留言板">留言板</a> </li>
                </ul>
            </nav>
            <nav class="navbar-nav navbar-userbar hidden-xs hidden-sm " style="top: 0;">
                <ul class="cl">
                    <li class="userInfo dropDown dropDown_hover">
                        <?php if(!empty(Yii::$app->session['member_info'])):?>
                        <a href="javascript:;" ><img class="avatar radius" src="<?= Yii::$app->session['member_info']['icon']?>" alt=" "></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="<?= \yii\helpers\Url::to(['member/logout']);?>">退出</a></li>
                        </ul>
                        <?= Yii::$app->session['member_info']['nickname'];?>
                        <?php else:?>
                            <a href="<?= \yii\helpers\Url::to(['member/login'])?>" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" ><img class="avatar size-S" src="img/qq.jpg" title="登入">登入</a>
                        <?php endif;?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<?= $content;?>
<footer class="footer mt-20">
    <div class="container-fluid" id="foot">
        <p>Copyright &copy; 2016-2017 www.wfyvv.com <br>
            <a href="#" target="_blank">皖ICP备17002922号</a>  更多模板：<a href="http://www.mycodes.net/" target="_blank">源码之家</a><br>
        </p>
    </div>
</footer>
<script type="text/javascript" src="plugin/layer/3.0/layer.js"></script>
<script type="text/javascript" src="plugin/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="plugin/pifu/pifu.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script> $(function(){ $(window).on("scroll",backToTopFun); backToTopFun(); }); </script>
<script type="text/javascript" src="plugin/jquery.SuperSlide/2.1.1/jquery.SuperSlide.min.js"></script>
<script>
    $(function(){
//幻灯片
        jQuery(".slider_main .slider").slide({mainCell: ".bd ul", titCell: ".hd li", trigger: "mouseover", effect: "leftLoop", autoPlay: true, delayTime: 700, interTime: 2000, pnLoop: true, titOnClassName: "active"})
//tips
        jQuery(".slideTxtBox").slide({titCell: ".hd ul", mainCell: ".bd ul", autoPage: true, effect: "top", autoPlay: true});
//标签
        $(".tags a").each(function(){
            var x = 9;
            var y = 0;
            var rand = parseInt(Math.random() * (x - y + 1) + y);
            $(this).addClass("tags"+rand)
        });

        $("img.lazyload").lazyload({failurelimit : 3});
    });

</script>

</body>
</html>
