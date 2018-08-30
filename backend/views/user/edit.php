<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>编辑管理员</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= \yii\helpers\Url::to(['index/index'])?>">主页</a>
            </li>
            <li>
                <a>后台管理</a>
            </li>
            <li class="active">
                <strong>编辑管理员</strong>
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
                <div class="ibox-content" style="">
                    <form method="post" id="article-add" action="<?= \yii\helpers\Url::to(['user/edit'])?>" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group"><label class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" value="<?= $user->username;?>" class="form-control">
                                <?php if(!empty($errors['username'][0])):?>
                                    <label id="cate_name-error" class="error" for="username"><?= $errors['username'][0];?></label>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-10">
                                <input type="text" name="password" class="form-control">
                                <?php if(!empty($errors['password'][0])):?>
                                    <label id="cate_name-error" class="error" for="password"><?= $errors['password'][0];?></label>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">头像</label>
                            <div class="col-sm-10"><div class="fileinput fileinput-new" data-provides="fileinput">
    <span class="btn btn-default btn-file"><span class="fileinput-new">上传图片</span>
    <span class="fileinput-exists">更改图片</span><input type="file" id="imageCover" name="imageCover"/></span>
                                    <span class="fileinput-filename"></span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                </div>
                                <?php if(!empty($errors['imageCover'][0])):?>
                                    <label id="cate_name-error" class="error" for="imageCover"><?= $errors['imageCover'][0];?></label>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">昵称</label>
                            <div class="col-sm-10">
                                <input type="text" name="nickname" value="<?= $user->nickname;?>" class="form-control">
                                <?php if(!empty($errors['content'][0])):?>
                                    <label id="cate_name-error" class="error" for="nickname"><?= $errors['content'][0];?></label>
                                <?php endif;?>
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">角色</label>

                            <div class="col-sm-10"><select class="form-control m-b" name="role_id">
                                    <?php foreach ($roles as $role):?>
                                    <option <?= $user->role_id == $role->id ? "selected" : "";?> value="<?= $role->id;?>"><?= $role->role_name;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <input type="hidden" name="id" value="<?= $user->id;?>">
                                <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->csrfToken?>">
                                <button class="btn btn-white" onclick="javascript :history.back(-1);" type="button">返回</button>
                                <button class="btn btn-primary" type="submit">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.note-btn').attr('title','');
        $('#article-add').validate({
            rules: {
                username: {
                    required: true,
                    rangelength: [2,16]
                },
                password:{
                    rangelength: [6,16]
                }
            },
            messages: {
                username: {
                    required: '用户名不能为空',
                    rangelength: '用户名长度位2-16个字符',
                },
                password: {
                    rangelength: '密码长度位6-16个字符',
                },
            }
        });
    });
</script>
