<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>分类列表</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= \yii\helpers\Url::to(['index/index'])?>">主页</a>
            </li>
            <li>
                <a>分类管理</a>
            </li>
            <li class="active">
                <strong>分类列表</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form action="<?= \yii\helpers\Url::to(['article/index'])?>" method="post" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <a href="<?= \yii\helpers\Url::to(['article/add'])?>" class="btn btn-primary btn-sm" type="button">添加</a>
                            </div>
                            <label class="col-sm-1 col-sm-offset-6 control-label">文章标题</label>
                            <div class="col-sm-3">
                                <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->csrfToken?>">
                                <div class="input-group"><input type="text" name="title" value="<?= Yii::$app->request->get('title','')?>" placeholder="请输入搜索内容" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span></div>
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>文章标题</th>
                            <th>文章分类</th>
                            <th>作者</th>
                            <th>阅读次数</th>
                            <th>发布时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($articles as $key=>$article):?>
                        <tr>
                            <td><?= $key+1;?></td>
                            <td><?= $article->title;?></td>
                            <td><?= $article->category->cate_name;?></td>
                            <td><?= $article->user->username;?></td>
                            <td><?= $article->views;?></td>
                            <td><?= date('Y-m-d H:i:s',$article->created_time);?></td>
                            <td>
                                <a href="<?= \yii\helpers\Url::to(['article/edit','id'=>$article->id])?>" class="btn btn-outline btn-primary btn-sm">编辑</a>
                                <a href="#" class="btn btn-outline btn-danger btn-sm" onclick="remove(<?= $article->id;?>)">删除</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?= \yii\widgets\LinkPager::widget([
                    'pagination'=>$pagination
                ])?>
            </div>
        </div>
    </div>
</div>
<script>
    function remove(id) {
        swal({
            title: "你确定？",
            text: "是否删除文章？",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确定",
            cancelButtonText: '取消',
            closeOnConfirm: false
        }, function () {
            var url = "<?= \yii\helpers\Url::to(['article/remove'])?>";
            var data = {id: id};
            $.get(url,data,function (res) {
                if(res.code == 200){
                    swal("删除成功", res.msg, "success");
                    window.location.href = "<?= \yii\helpers\Url::to(['article/index'])?>";
                }else{
                    swal("删除失败", res.msg, "error");
                }
            });
        });
    }

</script>