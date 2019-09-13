layui.define(['layer', 'form', 'element', 'laydate'], function (exports) {
    var layer = layui.layer,
        element = layui.element,
        table = layui.table,
        laydate = layui.laydate,
        form = layui.form,
        $ = layui.$;

    var teach = {};


    /**
     *监听提普通交
     */
    form.on('submit(layform)', function (data) {
        var self = $(data.elem);
        if (self.attr('disabled')) {
            return false;
        }
        //self.attr('disabled', 'disabled');  //按钮
        self.attr("disabled", true).css("pointer-events", "none");  //超链
        self.css({opacity: 0.2});
        $.ajax({
            url: data.form.action || '',
            type: 'POST',
            dataType: 'json',
            data: data.field
        })
            .done(function (res) {
                if (res.code == 1) {
                    layer.msg(res.msg, {
                        time: 1000,
                        icon: 6
                    }, function () {
                        if (res.url) window.location.href = res.url;
                    });
                } else {
                    layer.msg(res.msg, {
                        time: 1500,
                        icon: 5
                    });
                }
            })
            .fail(function () {
                layer.msg('服务器异常', {
                    time: 1500,
                    icon: 5
                });
            })
            .always(function () {
                //self.removeAttr('disabled');
                self.attr("disabled", false).css("pointer-events", "auto");
                self.css({opacity: 1});
            });
        return false;
    });
    //输出teach接口
    exports('teach', teach);
});