<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>管理员列表</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= \yii\helpers\Url::to(['index/index'])?>">主页</a>
            </li>
            <li>
                <a>后台管理</a>
            </li>
            <li class="active">
                <strong>管理员列表</strong>
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
                    <form action="<?= \yii\helpers\Url::to(['user/index'])?>" method="post" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <a href="<?= \yii\helpers\Url::to(['user/add'])?>" class="btn btn-primary btn-sm" type="button">添加</a>
                            </div>
                            <label class="col-sm-1 col-sm-offset-6 control-label">用户名</label>
                            <div class="col-sm-3">
                                <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->csrfToken?>">
                                <div class="input-group"><input type="text" name="username" value="<?= Yii::$app->request->get('username','')?>" placeholder="请输入搜索内容" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span></div>
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>用户名</th>
                            <th>昵称</th>
                            <th>角色</th>
                            <th>上次登陆时间</th>
                            <th>上次登陆ip</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $key=>$user):?>
                        <tr>
                            <td><?= $key+1;?></td>
                            <td><?= $user->username;?></td>
                            <td><?= $user->nickname;?></td>
                            <td><?= $user->role->role_name;?></td>
                            <td><?= date('Y-m-d H:i:s',$user->last_login_time);?></td>
                            <td><?= $user->last_login_ip;?></td>
                            <td><?= date('Y-m-d H:i:s',$user->created_time);?></td>
                            <td>
                                <a href="<?= \yii\helpers\Url::to(['user/edit','id'=>$user->id])?>" class="btn btn-outline btn-primary btn-sm">编辑</a>
                                <a href="#" class="btn btn-outline btn-danger btn-sm" onclick="remove(<?= $user->id;?>)">删除</a>
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
            text: "是否删除管理员？",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确定",
            cancelButtonText: '取消',
            closeOnConfirm: false
        }, function () {
            var url = "<?= \yii\helpers\Url::to(['user/remove'])?>";
            var data = {id: id};
            $.get(url,data,function (res) {
                if(res.code == 200){
                    swal("删除成功", res.msg, "success");
                    window.location.href = "<?= \yii\helpers\Url::to(['user/index'])?>";
                }else{
                    swal("删除失败", res.msg, "error");
                }
            });
        });
    }

</script>