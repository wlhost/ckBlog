



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ckadmin-管理员管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ URL::asset('backend/layui/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ URL::asset('backend/style/admin.css') }}" media="all">
</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item" style="text-align: center">
        <img id="uploadAvatar" src="{{ URL::asset('backend/images/logos/editormd-logo-96x96.png') }}" alt="" class="layui-status-img" style="max-width:96px;max-height: 96px;">
        <input type="hidden" name="avatar" id="avatar" value="{{ URL::asset('backend/images/logos/editormd-logo-96x96.png') }}">
    </div>
    
    <div class="layui-form-item">
        <label class="layui-form-label">管理员名称</label>
        <div class="layui-input-inline">
            <input type="text" name="name" lay-verify="required" placeholder="请输入管理员名称" autocomplete="off" class="layui-input">
        </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">昵称</label>
        <div class="layui-input-inline">
            <input type="text" name="nickname" lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline">
            <input type="text" name="password" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">邮箱</label>
        <div class="layui-input-inline">
            <input type="text" name="email" lay-verify="required|email" placeholder="请输入email" autocomplete="off" class="layui-input">
        </div>
    </div>

    {{ csrf_field() }}
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-submit" id="layuiadmin-app-form-submit" value="确认添加">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit" value="确认编辑">
    </div>
</div>

<script src="{{ URL::asset('backend/layui/layui.js') }}"></script>
<script>
    layui.config({
        base:  "{{ URL::asset('backend/') }}/" //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index','upload', 'form'], function(){
        var $ = layui.$
            ,form = layui.form
            ,upload = layui.upload;

        var imgAvatar = '';
        var uploadInst = upload.render({
            elem: '#uploadAvatar'
            ,url: "{{  url('/admin/admin/upload') }}"
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                this.data={'_token':$("input[name='_token']").val()};
                obj.preview(function(index, file, result){
                    $('#uploadAvatar').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                $('#avatar').val(res.url);
                if(res.code == 0){
                    layer.msg('上传成功');
                }
                //上传成功
            }
        });


        //监听提交
        form.on('submit(layuiadmin-app-form-submit)', function(data){
            var field = data.field; //获取提交的字段

            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            $.ajax({
                url : "{{  url('/admin/admin/store') }}",
                method : 'POST',
                data: field,
                dataType: 'json',
                beforeSend :function() {
                    layer.load(2);
                },
                success: function (res) {
                    if (res.code == 0) {
                        layer.closeAll('loading');
                        layer.msg(res.msg,function () {
                            var index=parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                            parent.layui.table.reload('LAY-app-content-list'); //重载表格
                            parent.layer.close(index); //再执行关闭
                        });
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
                                layer.msg(json[item][i],function () {
                                    var index=parent.layer.getFrameIndex(window.name);
                                    parent.layer.close(index);
                                    parent.layui.table.reload('LAY-app-content-list'); //重载表格
                                    parent.layer.close(index); //再执行关闭
                                });
                            }
                        }

                    }
                }
            });

        });
    })
</script>
</body>
</html>