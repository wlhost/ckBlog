


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 管理员 iframe 框</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ URL::asset('backend/layui/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ URL::asset('backend/style/admin.css') }}" media="all">
</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-form-admin" id="layuiadmin-form-admin" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">登录名</label>
        <div class="layui-input-inline">
            <input type="text" name="name" lay-verify="required" value="{{ $admin->name  }}" placeholder="请输入用户名" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">昵称</label>
        <div class="layui-input-inline">
            <input type="text" name="nickname" lay-verify="required" value="{{ $admin->nickname  }}" placeholder="昵称" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline">
            <input type="password" name="password" lay-verify="password" value="" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">邮箱</label>
        <div class="layui-input-inline">
            <input type="text" name="email" lay-verify="email" value="{{ $admin->email  }}" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
        </div>
    </div>
    {{ csrf_field() }}
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="button" class="layui-input layui-bg-green" lay-submit lay-filter="LAY-user-front-submit" id="LAY-user-back-submit" value="确认">
        </div>
    </div>

</div>

<script src="{{ URL::asset('backend/layui/layui.js') }}"></script>
<script>
    layui.config({
        base: "{{ URL::asset('backend/') }}/" //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form'], function(){
        var $ = layui.$
            ,form = layui.form ;


        form.on('submit(LAY-user-back-submit)', function(data){
            var field = data.field; //获取提交的字段
            alert(1);
            //提交 Ajax 成功后，静态更新表格中的数据
            //$.ajax({});
            $.ajax({
                url : "{{  url('/admin/adminUpdate') }}",
                method : 'POST',
                data: field,
                dataType: 'json',
                beforeSend :function() {
                    layer.load(2);
                },
                success: function (res) {
                    layer.closeAll('loading');
                    layer.msg(res.msg,function () {
                        var index=parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    });
                }
            });

            table.reload('LAY-user-front-submit'); //数据刷新
            layer.close(index); //关闭弹层
        });

    })


</script>
</body>
</html>