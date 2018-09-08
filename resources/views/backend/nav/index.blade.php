


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 内容系统 - 文章列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ URL::asset('backend/layui/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ URL::asset('backend/style/admin.css') }}" media="all">
    {{ csrf_field() }}
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">

                <div class="layui-inline">
                    <label class="layui-form-label">导航名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-inline">
                    <button class="layui-btn layuiadmin-btn-list" lay-submit lay-filter="LAY-app-contlist-search">
                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <button class="layui-btn layuiadmin-btn-list" data-type="batchdel">删除</button>
                <button class="layui-btn layuiadmin-btn-list" data-type="add">添加</button>
            </div>
            <table id="LAY-app-content-list" lay-filter="LAY-app-content-list"></table>
            <script type="text/html" id="buttonTpl">

                <button class="layui-btn layui-btn-xs">置顶</button>

                <button class="layui-btn layui-btn-primary layui-btn-xs">未置顶</button>

            </script>
            <script type="text/html" id="table-content-list">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
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
    }).use(['index', 'table'], function(){

        var table = layui.table
            ,form = layui.form;


        table.render({
            elem: "#LAY-app-content-list",
            url: "{{  url('/admin/nav/jsonNav') }}",
            cols: [[{
                type: "checkbox",
                fixed: "left"
            }, {
                field: "id",
                width: 50,
                title: "ID",
                sort: !0
            }, {
                field: "name",
                title: "导航名称",
                minWidth: 100
            }, {
                field: "url",
                title: "链接"
            }, {
                field: "sort",
                title: "排序",
                edit: 'text'
            },  {
                field: "created_at",
                title: "创建时间",
                sort: !0
            }, {
                title: "操作",
                minWidth: 150,
                align: "center",
                fixed: "right",
                toolbar: "#table-content-list"
            }]],
            page: !0,
            limit: 10,
            initSort: {
                field: 'sort' //排序字段，对应 cols 设定的各字段名
                ,type: 'asc' //排序方式  asc: 升序、desc: 降序、null: 默认排序
            },
            text: "暂无数据！"
            ,parseData: function (res) { //将原始数据解析成 table 组件所规定的数据
                return {
                    "code": res.code, //解析接口状态
                    "msg": res.msg, //解析提示文本
                    "count": res.count, //解析数据长度
                    "data": res.data.data //解析数据列表
                };
            }
        });

        table.on("tool(LAY-app-content-list)", function (t) {
            var e = t.data;
            "del" === t.event ? layer.confirm("确定删除此导航？", function (index) {
                $.ajax({
                    url : "{{  url('/admin/nav/delete') }}",
                    method : 'GET',
                    data: {
                        'id': e.id
                    },
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
                        layer.close(index);
                        table.reload('LAY-app-content-list');
                    }
                });


            }) : "edit" === t.event && layer.open({
                type: 2,
                title: "编辑文章",
                content:"update/" + e.id,
                maxmin: !0,
                area: ["550px", "550px"],
                btn: ["确定", "取消"],
                yes: function (e, i) {
                    //点击确认触发 iframe 内容中的按钮提交
                    var submit = i.find('iframe').contents().find("#layuiadmin-app-form-submit");
                    submit.click();
                }
            })
        }),


            //监听单元格编辑
            table.on('edit(LAY-app-content-list)', function(obj){
                var value = obj.value //得到修改后的值
                    ,data = obj.data //得到所在行所有键值
                    ,field = obj.field; //得到字段

                $.ajax({
                    url : "{{  url('/admin/nav/update') }}",
                    method : 'POST',
                    data: {
                        'id' : data.id,
                        'name' :data.name,
                        'sort' :data.sort,
                        'url': data.url,
                        '_token' : $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    beforeSend :function() {
                        layer.load(2);
                    },
                    success: function (res) {
                        if (res.code == 0) {
                            layer.closeAll('loading');
                            table.reload('LAY-app-content-list');
                            layer.msg(res.msg);
                        }
                    },
                    error : function (msg) {
                        if (msg.status == 422) {
                            var json=JSON.parse(msg.responseText);
                            json = json.errors;
                            for ( var item in json) {
                                for ( var i = 0; i < json[item].length; i++) {
                                    layer.closeAll('loading');
                                    table.reload('LAY-app-content-list');
                                    layer.msg(json[item][i]);
                                }
                            }

                        }
                    }

                });
            });


        //监听搜索
        form.on('submit(LAY-app-contlist-search)', function(data){
            var field = data.field;

            //执行重载
            table.reload('LAY-app-content-list', {
                where: field
            });
        });

        var $ = layui.$, active = {
            batchdel: function(){
                var checkStatus = table.checkStatus('LAY-app-content-list')
                    ,checkData = checkStatus.data; //得到选中的数据

                if(checkData.length === 0){
                    return layer.msg('请选择数据');
                }

                layer.confirm('确定删除吗？', function(index) {
                    var ids = [];
                    for (var i=0; i<checkData.length; i++) {
                        ids.push(checkData[i].id);
                    }

                    $.ajax({
                        url : "{{  url('/admin/nav/delete') }}",
                        method : 'GET',
                        data: {
                            'id': ids
                        },
                        dataType: 'json',
                        beforeSend :function() {
                            layer.load(2);
                        },
                        success: function (res) {
                            if (res.code == 0) {
                                layer.closeAll('loading');
                                layer.msg(res.msg);
                                table.reload('LAY-app-content-list');
                            } else {
                                layer.msg('系统错误');
                            }

                        }
                    });

                });
            },
            add: function(){
                layer.open({
                    type: 2
                    ,title: '添加导航'
                    ,content: "{{URL('admin/nav/store')}}"
                    ,maxmin: true
                    ,area: ['550px', '550px']
                    ,btn: ['确定', '取消']
                    ,yes: function(index, layero){
                        //点击确认触发 iframe 内容中的按钮提交
                        var submit = layero.find('iframe').contents().find("#layuiadmin-app-form-submit");
                        submit.click();
                    }
                });
            }
        };

        $('.layui-btn.layuiadmin-btn-list').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

    });
</script>
</body>
</html>
