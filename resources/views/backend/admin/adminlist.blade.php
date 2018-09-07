<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 后台管理员</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ URL::asset('backend/layui/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ URL::asset('backend/style/admin.css') }}" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">登录名</label>
                    <div class="layui-input-block">
                        <input type="text" name="loginname" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn layuiadmin-btn-admin" lay-submit lay-filter="LAY-user-back-search">
                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <button class="layui-btn layuiadmin-btn-admin" data-type="batchdel">删除</button>
                <button class="layui-btn layuiadmin-btn-admin" data-type="add">添加</button>
            </div>

            <table id="LAY-user-back-manage" lay-filter="LAY-user-back-manage"></table>
            <script type="text/html" id="buttonTpl">

                <button class="layui-btn layui-btn-xs">已审核</button>

                <button class="layui-btn layui-btn-primary layui-btn-xs">未审核</button>

            </script>
            <script type="text/html" id="table-useradmin-admin">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                            class="layui-icon layui-icon-edit"></i>编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                            class="layui-icon layui-icon-delete"></i>删除</a>
            </script>
        </div>
    </div>
</div>

<script src="{{ URL::asset('backend/layui/layui.js') }}"></script>


<script>
    layui.config({
        base: "{{ URL::asset('backend/') }}/" //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index','useradmin', 'table'], function () {
        var $ = layui.$
            , form = layui.form
            , table = layui.table;

        table.render({
            elem: "#LAY-user-back-manage",
            url: '/admin/jsonAdminlist',
            cols: [[{
                type: "checkbox",
                fixed: "left"
            }, {
                field: "id",
                width: 80,
                title: "ID",
                sort: !0
            }, {
                field: "name",
                title: "登录名"
            }, {
                field: "nickname",
                title: "昵称"
            }, {
                field: "email",
                title: "邮箱"
            }, {
                field: "avatar",
                title: "头像"
            }, {
                field: "created_at",
                title: "加入时间",
            }, {
                title: "操作",
                width: 150,
                align: "center",
                fixed: "right",
                toolbar: "#table-useradmin-admin"
            }]],
            text: "对不起，加载出现异常！",
            page: true,

            parseData: function (res) { //将原始数据解析成 table 组件所规定的数据
                return {
                    "code": res.code, //解析接口状态
                    "msg": res.msg, //解析提示文本
                    "count": res.count, //解析数据长度
                    "data": res.data.data //解析数据列表
                };
            }
        })


        //监听搜索
        form.on('submit(LAY-user-back-search)', function (data) {
            var field = data.field;

            //执行重载
            table.reload('LAY-user-back-manage', {
                where: field
            });
        });

        //事件
        var active = {
            batchdel: function () {
                var checkStatus = table.checkStatus('LAY-user-back-manage')
                    , checkData = checkStatus.data; //得到选中的数据

                if (checkData.length === 0) {
                    return layer.msg('请选择数据');
                }

                layer.prompt({
                    formType: 1
                    , title: '敏感操作，请验证口令!'
                }, function (value, index) {
                    alert(value);
                    layer.close(index);

                    layer.confirm('确定删除吗？', function (index) {
                        //执行 Ajax 后重载
                        /*
                        admin.req({
                          url: 'xxx'
                          //,……
                        });
                        */
                        table.reload('LAY-user-back-manage');
                        layer.msg('已删除');
                    });
                });
            }
            , add: function () {
                layer.open({
                    type: 2
                    , title: '添加管理员'
                    , content: "{{ URL('admin/adminAdd') }}"
                    , area: ['420px', '350px']
                    , yes: function (index, layero) {

                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-back-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        submit.trigger('click');
                    }
                });
            }
        }
        $('.layui-btn.layuiadmin-btn-admin').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });


        table.on("tool(LAY-user-back-manage)", function (e) {

            if ("del" === e.event) layer.prompt({
                formType: 1,
                title: "敏感操作，请验证口令"
            }, function (t, i) {
                if (t = 'ichenkun') {
                    layer.close(i), layer.confirm("真的删除行么", function (t) {

                        layer.close(t)
                    })
                }else {
                    layer.close(i)
                }

            });
            else if ("edit" === e.event) {

                layer.open({
                    type: 2,
                    title: "编辑用户",
                    content: "/admin/adminUpdate/" + e.data.id,
                    area: ['420px', '350px']
                    , yes: function (index, layero) {

                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-back-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        submit.trigger('click');
                    }
                })
            }
        })
    });
</script>
</body>
</html>

