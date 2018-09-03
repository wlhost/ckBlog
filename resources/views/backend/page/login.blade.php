<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登入 - layuiAdmin</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ URL::asset('backend/layui/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ URL::asset('backend/style/admin.css') }}" media="all">
    <link rel="stylesheet" href="{{ URL::asset('backend/style/login.css') }}" media="all">
</head>
<body>

<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>ckadmin</h2>
            <p>后台管理模板系统</p>
        </div>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"
                       for="LAY-user-login-username"></label>
                <input type="text" name="username" id="LAY-user-login-username" lay-verify="required|username" placeholder="用户名"
                       class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                       for="LAY-user-login-password"></label>
                <input type="password" name="password" id="LAY-user-login-password" lay-verify="required|password"
                       placeholder="密码" class="layui-input">
            </div>
            <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-xs7">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-vercode"
                               for="LAY-user-login-vercode"></label>
                        <input type="text" name="code" id="LAY-user-login-vercode" lay-verify="required"
                               placeholder="图形验证码" class="layui-input">
                    </div>
                    <div class="layui-col-xs5">
                        <div style="margin-left: 10px;">
                            <img src="https://www.oschina.net/action/user/captcha" class="layadmin-user-login-codeimg"
                                 id="LAY-user-get-vercode">
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 入</button>
            </div>

        </div>
    </div>

    <div class="layui-trans layadmin-user-login-footer">

        <p>© 2018 <a href="http://www.layui.com/" target="_blank">ckadmin</a></p>
    </div>


</div>

<script src="{{ URL::asset('backend/layui/layui.js') }}"></script>
<script>
    layui.config({
        base: "{{ URL::asset('backend/') }}/" //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form'], function () {
        var $ = layui.$
            , form = layui.form
            ,admin = layui.admin

        // 表单验证， 验证是否符合标准
        form.verify({
            username: function(e, s) {
                return new RegExp("^[a-zA-Z0-9_一-龥\\s·]+$").test(e) ? /(^\_)|(\__)|(\_+$)/.test(e) ? "用户名首尾不能出现下划线'_'" : /^\d+\d+\d$/.test(e) ? "用户名不能全为数字" : void 0 : "用户名不能有特殊字符"
            },
            password: [/^[\S]{6,12}$/, "密码必须6到12位，且不能出现空格"]
        });

        //提交
        form.on('submit(LAY-user-login-submit)', function (obj) {
            //请求登入接口
            admin.req({
                url: layui.setter.base + 'json/user/login.js' //实际使用请改成服务端真实接口
                , data: obj.field
                , done: function (res) {
                    console.log(res);
                    return;
                    //请求成功后，写入 access_token
                    layui.data(setter.tableName, {
                        key: setter.request.tokenName
                        , value: res.data.access_token
                    });

                    //登入成功的提示与跳转
                    layer.msg('登入成功', {
                        offset: '15px'
                        , icon: 1
                        , time: 1000
                    }, function () {
                        location.href = '../'; //后台主页
                    });
                }
            });

        });


    });
</script>
</body>
</html>