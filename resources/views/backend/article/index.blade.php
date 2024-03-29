


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
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">文章ID</label>
                    <div class="layui-input-inline">
                        <input type="text" name="id" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">作者</label>
                    <div class="layui-input-inline">
                        <input type="text" name="author" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">文章标签</label>
                    <div class="layui-input-inline">
                        <select name="label">
                            <option value="">请选择标签</option>
                            @foreach($tag as $v)
                            <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                            @endforeach
                        </select>
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
            </div>
            <table id="LAY-app-content-list" lay-filter="LAY-app-content-list"></table>

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
            ,form = layui.form


        table.on("tool(LAY-app-content-list)", function (t) {
            var e = t.data;
            "del" === t.event ? layer.confirm("确定删除此文章？", function (index) {
                $.ajax({
                    url : "{{  url('/admin/article/delete') }}",
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

            }) : "edit" === t.event &&  layer.full(layer.open({
                type: 2,
                title: "编辑文章",
                content:"update/" + e.id,
                maxmin: true,
                area: ["550px", "550px"],
            }));

        }),

        table.render({
            elem: "#LAY-app-content-list",
            url: "{{  url('/admin/article/jsonArticle') }}",
            cols: [[{
                type: "checkbox",
                fixed: "left"
            }, {
                field: "id",
                width: 50,
                title: "ID",
                sort: !0
            }, {
                field: "category_id",
                title: "分类",
                minWidth: 100
            }, {
                field: "title",
                title: "文章标题"
            }, {
                field: "author",
                title: "作者"
            }, {
                field: "created_at",
                title: "上传时间",
                sort: !0
            }, {
                field: "is_top",
                title: "是否置顶",
                minWidth: 80,
                align: "center",
            }, {
                title: "操作",
                minWidth: 150,
                align: "center",
                fixed: "right",
                toolbar: "#table-content-list"
            }]],
            page: !0,
            limit: 10,
            text: "对不起，加载出现异常！"
            ,parseData: function (res) { //将原始数据解析成 table 组件所规定的数据
                return {
                    "code": res.code, //解析接口状态
                    "msg": res.msg, //解析提示文本
                    "count": res.count, //解析数据长度
                    "data": res.data.data //解析数据列表
                };
            }
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
                        url : "{{  url('/admin/article/delete') }}",
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
                    ,title: '添加文章'
                    ,content: 'listform.html'
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
