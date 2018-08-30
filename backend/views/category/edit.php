<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>编辑分类</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= \yii\helpers\Url::to(['index/index'])?>">主页</a>
            </li>
            <li>
                <a>分类管理</a>
            </li>
            <li class="active">
                <strong>编辑分类</strong>
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
                    <form method="post" id="category-add" class="form-horizontal" action="<?= \yii\helpers\Url::to(['category/edit'])?>">
                        <div class="form-group"><label class="col-sm-2 control-label">分类名称</label>

                            <div class="col-sm-10">
                                <input type="text" id="cate_name" name="cate_name" value="<?= $category->cate_name?>" class="form-control">
                                <?php if(!empty($errors['cate_name'][0])):?>
                                    <label id="cate_name-error" class="error" for="cate_name"><?= $errors['cate_name'][0];?></label>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">分类描述</label>

                            <div class="col-sm-10"><input type="text" id="cate_desc" value="<?= $category->cate_desc?>" name="cate_desc" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <input type="hidden" name="id" value="<?= $category->id;?>">
                                <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->csrfToken?>">
                                <a href="javascript:;" onclick="javascript :history.back(-1);" class="btn btn-white" >返回</a>
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
        $('#category-add').validate({
            rules: {
                cate_name: {
                    required: true,
                    rangelength: [2,20],
                },
                cate_desc: {
                    maxlength: 255
                },

            },
            messages:{
                cate_name: {
                    required: "分类名称不能为空",
                    rangelength: "名称长度为2-20个字符",
                },
                cate_desc: {
                    maxlength: "分类描述最大长度为255个字符"
                },
            }
        });
    });
</script>
