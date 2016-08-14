function close_tip(){
    $('#windown-close').click();
}



var index_cd_move = "";
var index_cd_cur = 1;
function ztlistMoveleft(){
    $("#ztlist_style1_item_ww").animate({"margin-left":"0px"},600,function(){
        $("#ztlist_style1_item_ww .ztlist_style1_item_w1").last().prependTo($("#ztlist_style1_item_ww"));
        $("#ztlist_style1_item_ww").css("margin-left","-988px");
        $("#index_cd_leftarrow_mask").hide();
        index_cd_cur = index_cd_cur - 1;
        if(index_cd_cur == -1){
            index_cd_cur = 2;
        }
        setztlistCur();
    });
}
function ztlistMoveright(){
    $("#ztlist_style1_item_ww").animate({"margin-left":"-1976px"},600,function(){
        $("#ztlist_style1_item_ww .ztlist_style1_item_w1").first().appendTo($("#ztlist_style1_item_ww"));
        $("#ztlist_style1_item_ww").css("margin-left","-988px");
        $("#index_cd_rightarrow_mask").hide();
        index_cd_cur = index_cd_cur + 1;
        if(index_cd_cur == 3){
            index_cd_cur = 0;
        }
        setztlistCur();
    });

}
function setztlistCur(){
    $("#ztlist_cur span").removeClass("current");
    $("#ztlist_cur span").eq(parseInt(index_cd_cur)).addClass("current");
}


$(function(){


    if($('#ztlist_style1_item_w').length > 0){
        //index_cd_move = setInterval(function(){ztlistMoveright();},5000);
        $("#index_cd_leftarrow").click(function(){
            $("#index_cd_leftarrow_mask").show();
            ztlistMoveleft();
        });
        $("#index_cd_rightarrow").click(function(){
            $("#index_cd_rightarrow_mask").show();
            ztlistMoveright();
        });
        $("#index_cd_leftarrow").mouseenter(function(){
            clearInterval(index_cd_move);
        });
        $("#index_cd_leftarrow").mouseleave(function(){
            //index_cd_move = setInterval(function(){ztlistMoveright();},5000);
        });
        $("#index_cd_rightarrow").mouseenter(function(){
            clearInterval(index_cd_move);
        });
        $("#index_cd_rightarrow").mouseleave(function(){
            //index_cd_move = setInterval(function(){ztlistMoveright();},5000);
        });


        $("#ztlist_style1_item_w").mouseenter(function(){
            clearInterval(index_cd_move);
        });
        $("#ztlist_style1_item_w").mouseleave(function(){
            //index_cd_move = setInterval(function(){ztlistMoveright();},5000);
        });
    }
    $("#ztlist_style1_index li").hover(function(){
        $(this).siblings().removeClass("current");
        $(this).addClass("current");
    },function(){});

    //鼠标一如轮播图
    $("#index_zzw_main").mouseenter(function(){
        $("#zzw_prev_btn").trigger("mouseenter");
        $("#zzw_next_btn").trigger("mouseenter");
        $("#timedot_c").show();
    });
    $("#index_zzw_main").mouseleave(function(){
        $("#zzw_prev_btn").trigger("mouseleave");
        $("#zzw_next_btn").trigger("mouseleave");
        $("#timedot_c").hide();
    });
    $("#index_zzw .prev_btn").click(function(){
        $(".zzw_item_3 h3").hide();
        $("#index_zzw_main").animate({left:'-990px'},"600",function(){

            $("#index_zzw_main .zzw_item").last().prependTo($("#index_zzw_main"));


            $.each($("#index_zzw_main .zzw_item"),function(){
                var _this = $(this);
                var po = parseInt($(this).attr("po"));
                if(po == 5){po = 0}
                $(this).removeClass().addClass("zzw_item").addClass("zzw_item_"+String(po+1)).attr("po",String(po+1));
                $("#zzw_prev_btn").trigger("mouseover");

            });
            var i = $("#index_timelinebox span.timex_current");
            if(i.prev().length >0 ){
                i.removeClass("timex_current").prev().addClass("timex_current");
            }else{
                i.removeClass("timex_current");
                $("#index_timelinebox span.timex").last().addClass("timex_current");
            }
            $("#index_zzw_main").mouseenter();
            $(".zzw_item h3").hide();
            $(".zzw_item_3 h3").fadeIn();
            $("#index_zzw_main").css("left","-1980px");

        });
    });
    $("#index_zzw .next_btn").click(function(){
        $(".zzw_item_3 h3").hide();
        $("#index_zzw_main").animate({left:'-2970px'},"600",function(){

            $("#index_zzw_main .zzw_item").first().appendTo($("#index_zzw_main"));


            $.each($("#index_zzw_main .zzw_item"),function(){
                var _this = $(this);
                var po = parseInt($(this).attr("po"));
                if(po == 1){po = 6}
                $(this).removeClass().addClass("zzw_item").addClass("zzw_item_"+String(po-1)).attr("po",String(po-1));
                $("#zzw_next_btn").trigger("mouseover");
            });
            var i = $("#index_timelinebox span.timex_current");
            if(i.next().length >0 ){
                i.removeClass("timex_current").next().addClass("timex_current");
            }else{
                i.removeClass("timex_current");
                $("#index_timelinebox span.timex").first().addClass("timex_current");
            }
            $("#index_zzw_main").mouseenter();
            $(".zzw_item h3").hide();
            $(".zzw_item_3 h3").fadeIn();
            $("#index_zzw_main").css("left","-1980px");

        });
    });
    $("#zzw_prev_btn").hover(function(){
        var now = parseInt($(".zzw_item_3").attr("c"));
        if(now == 1){now = 6}
        $(this).css("background-position","0px "+(6-(now-1)*74)+"px");
    },function(){
        $(this).css("background-position","0px 6px");
    });
    $("#zzw_next_btn").hover(function(){
        var now = parseInt($(".zzw_item_3").attr("c"));
        if(now == 5){now = 0}
        $(this).css("background-position","-174px "+(6-(now+1)*74)+"px");
    },function(){
        $(this).css("background-position","-174px 6px");
    });
});







