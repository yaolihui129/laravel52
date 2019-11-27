AllUtil = function(me) {
    return me = {
        init: function(res) {
            me.newInitAll(res)
        },
        newInitAll:function(res){
            if (!res.data) {
                console.log('ALL：没有获取到数据');
                $("#allDoing").text('0');
                $("#allDone").text('0');
                $("#allSum").text('0')
            } else {
                console.table(res.data);
                $("#allDoing").text(res.data.intDoing);
                $("#allDone").text(res.data.intDone);
                $("#allSum").text(res.data.intSum)
            }
        }

    }
}();