ApiUtil = function(me) {
    return me={
        init : function(res) {
            me.newInitApi(res)
        },
        newInitApi:function (res){
            if (!res.data) {
                console.log('没有Api数据');
                $("#pressureFind").text('0');
                $("#pressureResolve").text(0);

                $("#staticFind").text(0);
                $("#staticResolved").text(0);

                $("#safetyFind").text(0);
                $("#safetyResolved").text(0);

                $("#apiSum").text(0);
                $("#apiFind").text(0);
                $("#apiResolved").text(0);
                $("#apidate1").text('[0-0]');
                $("#apidate2").text('[0-0]');

                $("#uiSum").text(0);
                $("#uiFind").text(0);
                $("#uiResolved").text(0);
                $("#uiDate1").text('[0-0]');
                $("#uiDate2").text('[0-0]')
            } else {
                console.log('进入API');
                console.table(res.data);
                console.log(res.data.pressureFind);
                $("#pressureFind").text(res.data.intPressureFind);
                $("#pressureResolve").text(res.data.intPressureResolved);

                $("#staticFind").text(res.data.intStaticFind);
                $("#staticResolved").text(res.data.intStaticResolved);

                $("#safetyFind").text(res.data.intSafetyFind);
                $("#safetyResolved").text(res.data.intSafetyResolved);

                $("#apiSum").text(res.data.intApiSum);
                $("#apiFind").text(res.data.intApiFind);
                $("#apiResolved").text(res.data.intApiResolved);
                $("#apidate1").text(res.data.dateApiDate1);
                $("#apidate2").text(res.data.dateApiDate2);

                $("#uiSum").text(res.data.intUISum);
                $("#uiFind").text(res.data.intUIFind);
                $("#uiResolved").text(res.data.intUIResolved);
                $("#uiDate1").text(res.data.dateUIDate1);
                $("#uiDate2").text(res.data.dateUIDate2)
            }
        }



    }
}();