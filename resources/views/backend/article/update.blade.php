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
    <link rel="stylesheet" href="{{ URL::asset('backend/style/formSelects-v4.css') }}" />

</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">

        <div class="layui-card-header">发布文章</div>
        <input type="hidden" name="id" value="{{ $article['id'] }}">
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" action="" lay-filter="component-form-group">
                <div class="layui-form-item">
                    <label class="layui-form-label">文章标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" value="{{ $article['title'] }}" lay-verify="required" autocomplete="off" placeholder="请输入标题"
                               class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">作者</label>
                        <div class="layui-input-inline">
                            <input type="text" name="author" lay-verify="required"  autocomplete="off" placeholder=""
                                   value="{{ $article['author'] }}" class="layui-input">
                        </div>

                        <label class="layui-form-label">文章分类</label>
                        <div class="layui-input-inline">
                            <select name="category_id" lay-verify="required" lay-search="">
                                <option value="">直接选择或搜索选择</option>
                                @foreach($category as $item)
                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{ csrf_field() }}

                <div class="layui-form-item">
                    <label class="layui-form-label">文章标签</label>
                    <div class="layui-input-block">
                        <select name="tags" xm-select="select7_1" xm-select-search="" xm-select-create="">
                            @foreach($tag as $item)
                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <div class="editormd" id="article">
                        <textarea name="content">{{ $article['markdown']  }}</textarea>
                    </div>
                </div>



                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="description" placeholder="请输入描述" class="layui-textarea">{{ $article['description'] }}</textarea>
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">关键字</label>
                    <div class="layui-input-block">
                        <textarea name="keywords" placeholder="请输入关键字" class="layui-textarea"> {{ $article['keywords'] }}</textarea>
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">封面图</label>
                    <div class="layui-input-block">
                        <div class="layui-card-body">
                            <div class="layui-upload">
                                <button type="button" class="layui-btn" id="upload">上传图片</button>
                                <input type="hidden" value="" name="cover" id="cover">
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img" src="{{ $article['cover'] }}" style="max-width:400px;" id="cover-img">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">是否置顶</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="is_top" lay-skin="switch"
                               lay-filter="component-form-switch" lay-text="置顶|不置顶">
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
    var editor;
    $(function() {
        editor = editormd("article", {
            width   : "100%",
            height  : 640,
            syncScrolling : "single",
            path    : "{{ URL::asset('backend/lib/editormd') }}/",
            watch: true,
            emoji: true,
            saveHTMLToTextarea : true,
            imageUpload    : true,
            imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL : "{{  url('/admin/admin/editorMd') }}",
        });
    });





    layui.config({
        base: "{{ URL::asset('backend/') }}/" //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块,
    }).use(['index','form','formSelects', 'laydate','upload'], function () {
        var $ = layui.$
            , admin = layui.admin
            , element = layui.element
            , layer = layui.layer
            , laydate = layui.laydate
            , form = layui.form
            , upload = layui.upload
            , formSelect = layui.formSelects

        formSelect.value('select7_1', [2, 4]);
        form.val('component-form-group', {
           'category_id' : [1]
        })

        var uploadInst = upload.render({
            elem: '#upload'
            ,url: "{{  url('/admin/admin/upload') }}"
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                this.data={'_token':$("input[name='_token']").val()};
                obj.preview(function(index, file, result){
                    $('#cover-img').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                $('#cover').val(res.url);
                if(res.code == 0){
                    layer.msg('上传成功');
                }
                //上传成功
            }
        });



        form.render(null, 'component-form-group');

        laydate.render({
            elem: '#LAY-component-form-group-date'
        });



        /* 监听提交 */
        form.on('submit(component-form-demo1)', function (data) {
            console.log(data.field);
            $.ajax({
                url : "{{  url('/admin/article/update') }}",
                method : 'POST',
                data: data.field,
                dataType: 'json',
                beforeSend :function() {
                    layer.load(2);
                },
                success: function (res) {
                    if (res.code == 0) {
                        layer.closeAll('loading');
                        layer.msg(res.msg);
                    } else {
                        layer.msg('系统错误');
                    }
                },
                error : function (msg) {
                    if (msg.status == 422) {
                        var json=JSON.parse(msg.responseText);
                        json = json.errors;
                        for ( var item in json) {
                            for ( var i = 0; i < json[item].length; i++) {
                                layer.closeAll('loading');
                                layer.msg(json[item][i]);
                            }
                        }

                    }
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
