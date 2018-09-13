



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>网站设置</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ URL::asset('backend/layui/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ URL::asset('backend/style/admin.css') }}" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">网站设置</div>
                <div class="layui-card-body" pad15>

                    <div class="layui-form" wid100 lay-filter="">
                        <div class="layui-form-item">
                            <label class="layui-form-label">网站logo</label>
                            <div class="layui-input-block">
                                <div class="layui-card-body">
                                    <div class="layui-upload">
                                        <div class="layui-upload-list">
                                            <img class="layui-upload-img" src="{{ $config['logo'] or URL('home/images/logo.png') }}" style="max-width: 230px" id="logoPre">
                                            <input type="hidden" name="logo" id="logo" value="{{ $config['logo'] or URL('home/images/logo.png') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="layui-form-item">
                            <label class="layui-form-label">网站标题</label>
                            <div class="layui-input-block">
                                <input type="text" name="sitename" value="{{ $config['sitename'] }}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">连接符</label>
                            <div class="layui-input-block">
                                <input type="text" name="connection"  value="{{ $config['connection'] }}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">网站副标题</label>
                            <div class="layui-input-block">
                                <input type="text" name="sitename2" value="{{ $config['sitename2'] }}" class="layui-input">
                            </div>
                        </div>


                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">META关键词</label>
                            <div class="layui-input-block">
                                <textarea name="keywords" class="layui-textarea" placeholder="多个关键词用英文状态 , 号分割">{{ $config['keywords'] }}
                                </textarea>
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">META描述</label>
                            <div class="layui-input-block">
                                <textarea name="description" class="layui-textarea">{{ $config['description'] }}
                                </textarea>
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">版权信息</label>
                            <div class="layui-input-block">
                                <textarea name="copyright" class="layui-textarea">{{ $config['copyright'] }}
                                </textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="set_website">确认保存</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('backend/layui/layui.js') }}"></script>
<script>
    layui.config({
        base: "{{ URL::asset('backend/') }}/" //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index','form','upload'],function(){
        var $ = layui.jquery
            ,upload = layui.upload
            ,form = layui.form

        form.on("submit(set_website)", function (t) {

            $.ajax({
                url : "{{  url('/admin/website/store') }}",
                method : 'POST',
                data:  t.field,
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
                                layer.msg(json[item][i]);
                            }
                        }
                    }
                }
            });
        })
        //普通图片上传
        var uploadInst = upload.render({
            elem: '#logoPre'
            ,url: "{{  url('/admin/admin/upload') }}"
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                this.data={'_token':$("input[name='_token']").val()};
                obj.preview(function(index, file, result){
                    $('#logoPre').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                $('#logo').val(res.url);
                if(res.code == 0){
                    layer.msg('上传成功');
                }
                //上传成功
            }
        });


    });
</script>
</body>
</html>