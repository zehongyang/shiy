<section class="container pt-20">
    <!--<div class="Huialert Huialert-info"><i class="Hui-iconfont">&#xe6a6;</i>成功状态提示</div>-->
    <!--left-->
    <div class="col-sm-9 col-md-9">
        <!--滚动图-->
        <div class="slider_main">
            <div class="slider">
                <div class="bd">
                    <ul>
                        <li><a href="#" target="_blank"><img src="img/temp/banner1.jpg"></a></li>
                        <li><a href="#" target="_blank"><img src="img/temp/banner8.png"></a></li>
                    </ul>
                </div>
                <ol class="hd cl dots">
                    <li>1</li>
                    <li>2</li>
                </ol>
                <a class="slider-arrow prev" href="javascript:void(0)"></a>
                <a class="slider-arrow next" href="javascript:void(0)"></a>
            </div>
        </div>

        <div class="mt-20 bg-fff box-shadow radius mb-5">
            <div class="tab-category">
                <a href=""><strong class="current">最新发布</strong></a>
            </div>
        </div>
        <div class="art_content">
            <ul class="index_arc">
                <?php foreach ($data as $k=>$v):?>
                <li class="index_arc_item">
                    <a href="#" class="pic">
                        <img class="lazyload" data-original="http://www.advanced.com/<?= !empty($v->file->file_path)? $v->file->file_path : 'temp/art.jpg';?>" alt="应该选" />
                    </a>
                    <h4 class="title"><a href="<?= \yii\helpers\Url::to(['article/detail','id'=>$v->id]);?>"><?= $v->title;?></a></h4>
                    <div class="date_hits">
                        <span><?= !empty($v->user->nickname) ? $v->user->nickname : "匿名" ;?></span>
                        <span><?= date('Y-m-d H:i:s',$v->created_time);?></span>
                        <span><a href="#"><?= $v->category->cate_name;?></a></span>
                        <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe6c1;</i> <?= $v->views;?></p>
                        <p class="commonts"><i class="Hui-iconfont" title="点击量">&#xe622;</i> <span class="cy_cmt_count"><?= $v->comment_num;?></span></p>
                    </div>
                    <div class="desc"><?= $v->desc;?></div>
                </li>
                <?php endforeach;?>
            </ul>
            <div class="text-c mb-20" id="moreBlog">
                <?= \yii\widgets\LinkPager::widget([
                    'pagination'=>$pagination
                ])?>
            </div>
        </div>
    </div>

    <!--right-->
    <div class="col-sm-3 col-md-3">

        <!--站点声明-->
        <div class="panel panel-default mb-20">
            <div class="panel-body">
                <i class="Hui-iconfont" style="float: left;">&#xe62f;&nbsp;</i>
                <div class="slideTxtBox">
                    <div class="bd">
                        <ul>
                            <li><a href="javascript:void(0);">Lao博客测试版上线，欢迎访问</a></li>
                            <li><a href="javascript:void(0);">内容如有侵犯，请立即联系管理员删除</a></li>
                            <li><a href="javascript:void(0);">本站内容仅供学习和参阅，不做任何商业用途</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--博主信息-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>博主信息</strong></a>
            </div>
            <div class="tab-category-item">
                <ul class="index_recd">
                    <li class="index_recd_item"><i class="Hui-iconfont">&#xe653;</i>姓名：王风宇</li>
                    <li class="index_recd_item"><i class="Hui-iconfont">&#xe70d;</i>职业：JavaWeb开发</li>
                    <li class="index_recd_item"><i class="Hui-iconfont">&#xe63b;</i>邮箱：<a href="mailto:wfyv@qq.com">wfyv@qq.com</a></li>
                    <li class="index_recd_item"><i class="Hui-iconfont">&#xe671;</i>定位：安徽 &middot; 合肥</li>
                </ul>
            </div>
        </div>


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

        <!--点击排行-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>点击排行</strong></a>
            </div>
            <div class="tab-category-item">
                <ul class="index_recd clickTop">
                    <li>
                        <a href="#">AJAX的刷新和前进后退问题解决</a>
                        <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe6c1;</i> 276° </p>
                    </li>
                    <li>
                        <a href="#">AJAX的刷新和前进后退问题解决</a>
                        <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe6c1;</i> 276° </p>
                    </li>
                    <li>
                        <a href="#">AJAX的刷新和前进后退问题解决</a>
                        <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe6c1;</i> 276° </p>
                    </li>
                    <li>
                        <a href="#">AJAX的刷新和前进后退问题解决</a>
                        <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe6c1;</i> 276° </p>
                    </li>
                    <li>
                        <a href="#">AJAX的刷新和前进后退问题解决</a>
                        <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe6c1;</i> 276° </p>
                    </li>
                    <li>
                        <a href="#">AJAX的刷新和前进后退问题解决</a>
                        <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe6c1;</i> 276° </p>
                    </li>
                    <li>
                        <a href="#">AJAX的刷新和前进后退问题解决</a>
                        <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe6c1;</i> 276° </p>
                    </li>
                </ul>
            </div>
        </div>

        <!--标签-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>标签云</strong></a>
            </div>
            <div class="tab-category-item">
                <div class="tags"> <a href="http://www.h-ui.net/">H-ui前端框架</a> <a href="http://www.h-ui.net/websafecolors.shtml">Web安全色</a> <a href="http://www.h-ui.net/Hui-4.4-Unslider.shtml">jQuery轮播插件</a> <a href="http://idc.likejianzhan.com/vhost/korea_hosting.php">韩国云虚拟主机</a> <a href="http://www.h-ui.net/bug.shtml">IEbug</a> <a href="http://www.h-ui.net/site.shtml">IT网址导航</a> <a href="http://www.h-ui.net/icon/index.shtml">网站常用小图标</a> <a href="http://www.h-ui.net/tools/jsformat.shtml">web工具箱</a> <a href="http://www.h-ui.net/bg/index.shtml">网站常用背景素材</a> <a href="http://www.h-ui.net/yuedu/chm.shtml">H-ui阅读</a> <a href="http://www.h-ui.net/easydialog-v2.0/index.html">弹出层插件</a> <a href="http://www.h-ui.net/SuperSlide2.1/demo.html">SuperSlide插件</a> <a href="http://www.h-ui.net/TouchSlide1.1/demo.html">TouchSlide</a></div>
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

        <!--友情链接-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>隔壁邻居</strong></a>
            </div>
            <div class="tab-category-item">
                <span><i class="Hui-iconfont">&#xe6f1;</i><a href="#" class="btn-link">百度</a></span>
                <span><i class="Hui-iconfont">&#xe6f1;</i><a href="#" class="btn-link">淘宝</a></span>
                <span><i class="Hui-iconfont">&#xe6f1;</i><a href="#" class="btn-link">腾讯</a></span>
                <span><i class="Hui-iconfont">&#xe6f1;</i><a href="#" class="btn-link">慕课网</a></span>
                <span><i class="Hui-iconfont">&#xe6f1;</i><a href="#" class="btn-link">h-ui</a></span>
            </div>
        </div>
        <!--最近访客-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>最近访客</strong></a>
            </div>
            <div class="panel-body">
                <ul class="recent">
                    <div class="item"><img src="img/40.jpg" alt=""></div>
                    <div class="item"><img src="img/40.jpg" alt=""></div>
                    <div class="item"><img src="img/40.jpg" alt=""></div>
                    <div class="item"><img src="img/40.jpg" alt=""></div>
                    <div class="item"><img src="img/40.jpg" alt=""></div>
                    <div class="item"><img src="img/40.jpg" alt=""></div>
                    <div class="item"><img src="img/40.jpg" alt=""></div>
                    <div class="item"><img src="img/40.jpg" alt=""></div>
                    <div class="item"><img src="img/40.jpg" alt=""></div>
                    <div class="item"><img src="img/40.jpg" alt=""></div>
                </ul>
            </div>
        </div>

        <!--分享-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>站点分享</strong></a>
            </div>
            <div class="panel-body">
                <div class="bdsharebuttonbox Hui-share"><a href="#" class="bds_weixin Hui-iconfont" data-cmd="weixin" title="分享到微信">&#xe694;</a><a href="#" class="bds_qzone Hui-iconfont" data-cmd="qzone" title="分享到QQ空间">&#xe6c8;</a> <a href="#" class="bds_sqq Hui-iconfont" data-cmd="sqq" title="分享到QQ好友">&#xe67b;</a> <a href="#" class="bds_tsina Hui-iconfont" data-cmd="tsina" title="分享到新浪微博">&#xe6da;</a> <a href="#" class="bds_tqq Hui-iconfont" data-cmd="tqq" title="分享到腾讯微博">&#xe6d9;</a></div>
            </div>
        </div>




    </div>

</section>