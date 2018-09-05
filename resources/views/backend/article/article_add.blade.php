<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>表单组合</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ URL::asset('backend/layui/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ URL::asset('backend/style/admin.css') }}" media="all">
    <link rel="stylesheet" href="{{ URL::asset('backend/style/editormd.min.css') }}" />
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-header">发布文章</div>
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" action="" lay-filter="component-form-group">
                <div class="layui-form-item">
                    <label class="layui-form-label">文章标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="请输入标题"
                               class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">作者</label>
                        <div class="layui-input-inline">
                            <input type="text" name="author" lay-verify="required" autocomplete="off" placeholder=""
                                   value="ichenkun" class="layui-input">
                        </div>

                        <label class="layui-form-label">文章分类</label>
                        <div class="layui-input-inline">
                            <select name="category_id" lay-verify="required" lay-search="">
                                <option value="">直接选择或搜索选择</option>
                                <option value="1">layer</option>
                                <option value="2">form</option>
                                <option value="3">layim</option>
                                <option value="4">element</option>
                                <option value="5">laytpl</option>
                                <option value="6">upload</option>
                                <option value="7">laydate</option>
                                <option value="8">laypage</option>
                                <option value="9">flow</option>
                                <option value="10">util</option>
                                <option value="11">code</option>
                                <option value="12">tree</option>
                                <option value="13">layedit</option>
                                <option value="14">nav</option>
                                <option value="15">tab</option>
                                <option value="16">table</option>
                                <option value="17">select</option>
                                <option value="18">checkbox</option>
                                <option value="19">switch</option>
                                <option value="20">radio</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">文章标签</label>
                    <div class="layui-input-block">
                        <input type="text" name="tags" lay-verify="required" autocomplete="off"
                               class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <div class="editormd" id="article">
                        <textarea name="content">### 在此输入文章!</textarea>
                    </div>
                </div>




                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="description" placeholder="请输入描述" class="layui-textarea"></textarea>
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">关键字</label>
                    <div class="layui-input-block">
                        <textarea name="keywords" placeholder="请输入关键字" class="layui-textarea"></textarea>
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">封面图</label>
                    <div class="layui-input-block">
                        <div class="layui-card-body">
                            <div class="layui-upload">
                                <button type="button" class="layui-btn" id="cover">上传图片</button>
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img" style="max-width:400px;" id="cover-img">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">是否置顶</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="is_top" lay-skin="switch"
                               lay-filter="component-form-switch" lay-text="ON|OFF">
                    </div>
                </div>

                <div class="layui-form-item layui-layout-admin">
                    <div class="layui-input-block">
                        <div class="layui-footer" style="left: 0;">
                            <button class="layui-btn" lay-submit="" lay-filter="component-form-demo1">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="{{ URL::asset('backend/layui/layui.js') }}"></script>
<script src="{{ URL::asset('backend/lib/editormd/jquery.min.js') }}"></script>
<script src="{{ URL::asset('backend/lib/editormd/editormd.min.js') }}"></script>

<script>
    var testEditor;

    $(function() {
        testEditor = editormd("article", {
            width   : "100%",
            height  : 640,
            syncScrolling : "single",
            path    : "{{ URL::asset('backend/lib/editormd') }}/",
            watch: true,
            emoji: true
        });
    });

    layui.config({
        base: "{{ URL::asset('backend/') }}/" //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form', 'laydate','upload'], function () {
        var $ = layui.$
            , admin = layui.admin
            , element = layui.element
            , layer = layui.layer
            , laydate = layui.laydate
            , form = layui.form
            , upload = layui.upload;


        var uploadInst = upload.render({
            elem: '#cover'
            ,url: '/upload/'
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#cover-img').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败');
                }
                //上传成功
            }
            ,error: function(){
                layer.msg('上传失败');
            }
        });


        form.render(null, 'component-form-group');

        laydate.render({
            elem: '#LAY-component-form-group-date'
        });


        /* 监听指定开关 */
        form.on('switch(component-form-switch)', function (data) {
            layer.msg('开关checked：' + (this.checked ? 'true' : 'false'), {
                offset: '6px'
            });
        });

        /* 监听提交 */
        form.on('submit(component-form-demo1)', function (data) {
            parent.layer.alert(JSON.stringify(data.field), {
                title: '最终的提交信息'
            })
            return false;
        });
    });
</script>
</body>
</html>
