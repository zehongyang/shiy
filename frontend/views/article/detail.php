
<!--导航条-->
<nav class="breadcrumb">
    <div class="container"> <i class="Hui-iconfont">&#xe67f;</i> <a href="<?= \yii\helpers\Url::to(['home/home'])?>" class="c-primary">首页</a> <span class="c-gray en">&gt;</span>  <span class="c-gray">文章</span></div>
</nav>
<section class="container pt-20">

    <div class="row w_main_row">


        <div class="col-lg-9 col-md-9 w_main_left">
            <div class="panel panel-default  mb-20">
                <div class="panel-body pt-10 pb-10">
                    <h2 class="c_titile"><?= $article->title;?></h2>
                    <p class="box_c"><span class="d_time">发布时间：<?= date('Y-m-d',$article->created_time);?></span><span>编辑：<a href="#"><?= !empty($article->user->nickname)?$article->user->nickname:'匿名';?></a></span><span>阅读（<?= $article->views;?>）</span></p>
                    <ul class="infos">
                        <?= $article->content;?>
                    </ul>

                    <div class="keybq">
                        <p><span>关键字</span>：<a class="label label-default">个人博客</a></p>
                    </div>



                    <div class="nextinfo">
                        <?php if(!is_null($pre)):?>
                        <p class="last">上一篇：<a href="<?= \yii\helpers\Url::to(['article/detail','id'=>$pre->id]);?>"><?= $pre->title;?></a></p>
                        <?php endif;?>
                        <?php if(!is_null($next)):?>
                        <p class="next">下一篇：<a href="<?= \yii\helpers\Url::to(['article/detail','id'=>$next->id]);?>"><?= $next->title;?></a></p>
                        <?php endif;?>
                    </div>

                </div>
            </div>

            <div class="panel panel-default  mb-20">
                <div class="tab-category">
                    <a href=""><strong>评论区</strong></a>
                </div>
                <div class="panel-body">
                    <div class="panel-body" style="margin: 0 3%;">
                        <div class="mb-20">
                            <ul class="commentList">
                                <?php foreach ($comments as $comment):?>
                                <li class="item cl"> <a href="#"><i class="avatar size-L radius"><img alt="" src="<?= $comment->member->icon;?>"></i></a>
                                    <div class="comment-main">
                                        <header class="comment-header">
                                            <div class="comment-meta"><a class="comment-author" href="#"><?= $comment->member->nickname;?></a>
                                                <time  datetime="2014-08-31T03:54:20" class="f-r"><?= date('Y-m-d H:i:s',$comment->created_time);?></time>
                                            </div>
                                        </header>
                                        <div class="comment-body">
                                            <?= $comment->comment;?>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>

                        </div>
                        <div class="line"></div>
                        <!--用于评论-->
                        <form id="add">
                            <div class="mt-20" id="ct">
                                <div id="err" class="Huialert Huialert-danger hidden radius">成功状态提示</div>
                                <textarea id="textarea1" name="comment" style="height:200px;" placeholder="看完不留一发？"> </textarea>
                                <div class="text-r mt-10">
                                    <input type="hidden" name="article_id" value="<?= $article->id;?>">
                                    <input type="hidden" name="_csrf-frontend" value="<?= Yii::$app->request->csrfToken;?>">
                                    <button type="button" onclick="commit()" class="btn btn-primary radius" > 发表评论</button>
                                </div>
                            </div>
                        </form>
                        <!--用于回复-->
                        <div class="comment hidden mt-20">
                            <div id="err2" class="Huialert Huialert-danger hidden radius">成功状态提示</div>
                            <textarea class="textarea" style="height:100px;" > </textarea>
                            <button onclick="hf(this);" type="button" class="btn btn-primary radius mt-10">回复</button>
                            <a class="cancelReply f-r mt-10">取消回复</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <!--热门推荐-->
            <div class="bg-fff box-shadow radius mb-20">
                <div class="tab-category">
                    <a href=""><strong>热门推荐</strong></a>
                </div>
                <div class="tab-category-item">
                    <ul class="index_recd">
                        <li>
                            <a href="#">阻止a标签href默认跳转事件</a>
                            <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe622;</i> 276 </p>
                        </li>
                        <li >
                            <a href="#">PHP面试题汇总</a>
                            <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe622;</i> 276 </p>
                        </li>
                        <li >
                            <a href="#">阻止a标签href默认跳转事件</a>
                            <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe622;</i> 276 </p>
                        </li>
                        <li >
                            <a href="#">阻止a标签href默认跳转事件</a>
                            <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe622;</i> 276 </p>
                        </li>
                        <li >
                            <a href="#">PHP面试题汇总</a>
                            <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe622;</i> 276 </p>
                        </li>
                    </ul>
                </div>
            </div>

            <!--图片-->
            <div class="bg-fff box-shadow radius mb-20">
                <div class="tab-category">
                    <a href=""><strong>扫我关注</strong></a>
                </div>
                <div class="tab-category-item">
                    <img data-original="temp/gg.jpg" class="img-responsive lazyload" alt="响应式图片">
                </div>
            </div>

        </div>
    </div>
</section>
<script type="text/javascript" src="plugin/wangEditor/js/wangEditor.min.js"></script>
<script>
    $(function () {
        wangEditor.config.printLog = false;
        var editor1 = new wangEditor('textarea1');
        editor1.config.menus = ['insertcode', 'quote', 'bold', '|', 'img', 'emotion', '|', 'undo', 'fullscreen'];
        editor1.config.emotions = { 'default': { title: '表情', data: 'plugin/wangEditor/emotions1.data'}, 'default2': { title: '心情', data: 'plugin/wangEditor/emotions3.data'}, 'default3': { title: '顶一顶', data: 'plugin/wangEditor/emotions2.data'}};
        editor1.create();

        // show reply
        $(".hf").click(function () {
            pId = $(this).attr("name");
            $(this).parents(".commentList").find(".cancelReply").trigger("click");
            $(this).parent(".comment-body").append($(".comment").clone(true));
            $(this).parent(".comment-body").find(".comment").removeClass("hidden");
            $(this).hide();
        });
        //cancel reply
        $(".cancelReply").on('click',function () {
            $(this).parents(".comment-body").find(".hf").show();
            $(this).parents(".comment-body").find(".comment").remove();
        });

    });

    function commit() {
        var value = $('#textarea1').val();
        if (value.length == 1 || value.length > 255){
            layer.alert('评论长度为2-255个字符', {title: '错误提示',icon: 2})
            return;
        }
        <?php if(empty(Yii::$app->session['member_info'])):?>
        layer.confirm('请先登陆，再发表评论',{
                btn: ['登陆','取消'],title: '提示'}
            ,function () {
                window.location.href = "<?= \yii\helpers\Url::to(['member/login'])?>";
            },function () {

            });
        <?php else:?>
        var url = "<?= \yii\helpers\Url::to(['comment/add']);?>";

        $.post(url,$('#add').serialize(),function (res) {
            if(res.code == 200){
                window.location.reload();
            }
        });
        <?php endif;?>
    }
</script>

