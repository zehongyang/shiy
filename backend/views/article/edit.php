<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>编辑文章</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= \yii\helpers\Url::to(['index/index'])?>">主页</a>
            </li>
            <li>
                <a>文章管理</a>
            </li>
            <li class="active">
                <strong>编辑文章</strong>
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
                    <form method="post" id="article-add" action="<?= \yii\helpers\Url::to(['article/edit'])?>" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group"><label class="col-sm-2 control-label">文章标题</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="<?= $article->title;?>" class="form-control">
                                <?php if(!empty($errors['title'][0])):?>
                                    <label id="cate_name-error" class="error" for="title"><?= $errors['title'][0];?></label>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">文章描述</label>
                            <div class="col-sm-10">
                                <input type="text" name="desc" value="<?= $article->desc;?>" class="form-control">
                                <?php if(!empty($errors['desc'][0])):?>
                                    <label id="cate_name-error" class="error" for="desc"><?= $errors['desc'][0];?></label>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">文章封面</label>
                            <div class="col-sm-10"><div class="fileinput fileinput-new" data-provides="fileinput">
    <span class="btn btn-default btn-file"><span class="fileinput-new">上传图片</span>
    <span class="fileinput-exists">更改图片</span><input type="file" name="imageCover"/></span>
                                    <span class="fileinput-filename"></span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                </div>
                                <?php if(!empty($errors['imageCover'][0])):?>
                                    <label id="cate_name-error" class="error" for="imageCover"><?= $errors['imageCover'][0];?></label>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">文章内容</label>
                            <div class="col-sm-10">
                                <textarea id="summernote" name="content">
                                    <?= $article->content;?>
                                </textarea>
                                <?php if(!empty($errors['content'][0])):?>
                                    <label id="cate_name-error" class="error" for="summernote"><?= $errors['content'][0];?></label>
                                <?php endif;?>
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">文章分类</label>

                            <div class="col-sm-10"><select class="form-control m-b" name="cate_id">
                                    <?php foreach ($categories as $category):?>
                                    <option <?= $article->cate_id == $category->id?'selected':'';?> value="<?= $category->id;?>"><?= $category->cate_name;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <input type="hidden" name="id" value="<?= $article->id;?>">
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
        $('#summernote').summernote({
            height: 400,
        });
        $('.note-btn').attr('title','');
        $('#article-add').validate({
            rules: {
                title: {
                    required: true,
                    rangelength: [8,255]
                },
                desc: {
                    required: true,
                    rangelength: [8,255]
                },

            },
            messages: {
                title: {
                    required: '文章标题不能为空',
                    rangelength: '标题长度为8-255个字符',
                },
                desc: {
                    required: '文章描述不能为空',
                    rangelength: '文章描述长度为8-255个字符',
                },
            }
        });
    });
</script>
