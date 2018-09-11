



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ckadmin---标签管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ URL::asset('backend/layui/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ URL::asset('backend/style/admin.css') }}" media="all">
</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">标签名称</label>
        <div class="layui-input-inline">
            <input type="text" name="name" lay-verify="required" placeholder="请输入标签名称" autocomplete="off" class="layui-input">
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
    }).use(['index', 'form'], function(){
        var $ = layui.$
            ,form = layui.form;

        //监听提交
        form.on('submit(layuiadmin-app-form-submit)', function(data){
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            $.ajax({
                url : "{{  url('/admin/tag/store') }}",
                method : 'POST',
                data: field,
                dataType: 'json',
                beforeSend :function() {
                    layer.load(2);
                },
                success: function (res) {
                    if (res.code == 0) {
                        layer.closeAll('loading');
                        var index=parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index); //再执行关闭
                        layer.msg(res.msg);
                        parent.layui.table.reload('LAY-app-content-list'); //重载表格
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
                                layer.msg(json[item][i]);
                                var index=parent.layer.getFrameIndex(window.name);
                                parent.layui.table.reload('LAY-app-content-list'); //重载表格
                                parent.layer.close(index); //再执行关闭
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