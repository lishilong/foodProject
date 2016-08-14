var preview ={
    type:"",//大题的题型
    subItem_id:0, //小题id
    selNum:100,//备选项序列(ueditor实例化)
    fillNum:200,//填空题序列(ueditor实例化)
    showType:1,//类型
    subTypes:'<option showtypeid="30020" value="9">判断题</option><option showtypeid="30007" value="1">单选题</option> <option showtypeid="30005" value="2">多选题</option> <option showtypeid="30017" value="3">填空题</option><option showtypeid="30018" value="5">解答题</option>',
    id:"1",
    content:"",//Q:题目内容
    textContent:'',//题目内容文本
    answerContent:'',// 1判断题:1:0   3填空题:["asdfsfsfsf","sfssf"]
    answerOptionJson:[
    ],
    analytical:'',//解析
    explanation:'',
    childQuesJson:[],

//----------------------------------------------------------------------------

    //生成备选项html
    createSelHtml:function(OptionJson,showType,j){
        var showType=showType || this.showType;
        var sel=  OptionJson;
        var html='';//备选项内容
        var html2='';//备选项答案
        var ue='';
        var name='';
        var names='';
        j!=undefined?name='child['+j+'][sub][]':name='sel[]';
        j!=undefined?names='child['+j+'][que][]':names='single[]';
        if(sel.length>0){//如果大题有选项,显示选项
            for(var i=0, len=sel.length; i<len; i++){
                this.selNum++;
                html+='<div class="row">';
                html+='<div class="formL"><label>备选项<em>'+(i+1)+'</em></label></div>';
                html+='<div class="formR">';
                html+='<textarea name='+name+' id="sel_'+this.selNum+'" class="ue_textarea sub" style=" height:150px;" >'+sel[i].content+'</textarea>';
                html+='<span class="del_btn delSelBtn">删除</span>';
                html+='</div>';
                html+='</div>';
                html2+='<span><input  name='+names+'   '+ (sel[i].right==1 ? 'checked' : '')+' value="'+i+'" type="'+ (showType==1 ? "radio" : "checkbox")+'" > <label>备选项<em>'+(i+1)+'</em></label></span>';
            }
        }else{//录入状态:没有数据
            html+='<div class="row">';
            html+='<div class="formL"><label>备选项<em>1</em></label></div>';
            html+='<div class="formR"><textarea name="sel[]" id="sel_'+this.selNum+'" class="ue_textarea sub" style=" height:150px;"></textarea></div>';
            html+='</div>';

            html2+='<span><input value="0" name="single[]" type="'+ (showType==1 ? "radio" : "checkbox")+'" data-validation-engine= "validate[minCheckbox[1]] checkbox" data-errormessage-value-missing="答案不能为空" > <label>备选项<em>1</em></label></span>';
            var ue=UE.getEditor('sel_'+this.selNum);
        }
        var selHtml=[html,html2];//备选项数组:[0]备选项  [1]备选项答案
        return selHtml;

    },

    //初始化小题

    onloadChildQues:function(){
        $('.Box').html('<div class="IBox"></div>');
        if(this.childQuesJson.length>0){
            for(var i=0; i<this.childQuesJson.length; i++){
                this.addItem(this.childQuesJson[i],i);//对象传入
                //对应显示题型

                switch(this.childQuesJson[i].showType){
                    case 1:
                        $('.subItem:eq('+i+') select option[value=1]').attr('selected',true);
                        break;
                    case 2:
                        $('.subItem:eq('+i+') select option[value=2]').attr('selected',true);
                        break;
                    case 3:
                        $('.subItem:eq('+i+') select option[value=3]').attr('selected',true);
                        break;
                    case 5:
                        $('.subItem:eq('+i+') select option[value=5]').attr('selected',true);
                        break;
                    case 9:
                        $('.subItem:eq('+i+') select option[value=9]').attr('selected',true);
                        break;
                };
            }
        }else{ this.addSub() }
        $('.Box').append('<div class="btnBar"><button type="button" class="btn btn-primary addSubBtn">添加小题</button></div>');
        //富文本
        var textareas=$('.Box .IBox .I_SBox textarea');
        textareas.each(function(){
            var id=$(this).attr('id');
            UE.getEditor(id)
        });
        var contents=$('.Box .I_QBox textarea');
        contents.each(function(){
            var id=$(this).attr('id');
            UE.getEditor(id)
        });
        var contents=$('.Box .I_ABox textarea');
        contents.each(function(){
            var id=$(this).attr('id');
            UE.getEditor(id)
        });
    },
    //填空题多个答案
    multiAnswer:function(answerContent,j){
        var name='';
        j!=undefined?name='child['+j+'][answer][]':name='subItem[]';
        var html="";
        if(answerContent instanceof Array)	{
            for(var i=0; i<answerContent.length; i++){
                html+='<div class="row">';
                html+='<div class="formL">答案:</div>';
                html+='<div class="formR"><textarea name='+name+'  id="answer'+j+'_'+i+'"   class="ue_textarea answer" style=" height:150px;">'+answerContent[i]+'</textarea><span class="del_btn delSelBtn">删除</span></div>';
                html+='</div>';
            }
        }else{
            html+='<div class="row">';
            html+='<div class="formL">答案:</div>';
            html+='<div class="formR"><textarea name="subItem[]" id="answer" class="ue_textarea answer" style=" height:150px;">'+answerContent+'</textarea><span class="del_btn delSelBtn">删除</span></div>';
            html+='</div>';
        }
        return html;
    },
    //加载题目
    onloadType:function(){
        //判断大题的题型
        var showType=this.showType;

        if(showType==1 || showType==2){// 大题单选题/多选题
            var html='';
            var selHtml=this.createSelHtml(this.answerOptionJson);
            if(this.childQuesJson.length==0){//没有小题
                html+='<div class="mBox">';
                html+='<div class="SBox">'+selHtml[0]+'</div>';
                html+='<div class="ABox">';
                html+='<div class="row">';
                html+='<div class="formL">答案:</div>';
                html+='<div class="formR">'+selHtml[1]+'</div>';
                html+='</div>';
                html+=' </div>';
                html+='<div class="btnBar">';
                html+='<div class="row">';
                html+='<div class="formL"></div>';
                html+='<div class="formR">';
                html+='<button type="button" class="btn btn-primary addSelBtn">添加备选项</button>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                html+='<div class="show_subItem">';
                html+='<div class="row">';
                html+='<div class="formL"></div>';
                html+='<div class="formR">';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                $('.Box').html(html);
                //富文本
                var textareas=$('.Box .ue_textarea');
                textareas.each(function(){
                    var id=$(this).attr('id');
                    UE.getEditor(id)
                })
            }
            else{//有小题
                this.onloadChildQues();
            }
        }else if(showType==3){//大题为填空题
            var html='<div class="mBox">';
            html+='<div class="ABox">';
            if(this.childQuesJson.length==0){//没有小题
                html+=this.multiAnswer(this.answerContent);//多个答案
                html+='</div>';
                html+='<div class="btnBar">';
                html+='<div class="row">';
                html+='<div class="formL"><label></label></div>';
                html+='<div class="formR">';
                html+='<button type="button" class="btn btn-primary addBtn bg_gray_d addMultiAnswerBtn">添加多个答案</button>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                html+='<div class="show_subItem">';
                html+='<div class="row">';
                html+='<div class="formL"></div>';
                html+='<div class="formR">';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                $('.Box').append(html);
                $(".ue_textarea").each(function(index, element) {
                    var id=$(this).attr('id');
                    var ue=UE.getEditor(id);//初始化富文本
                });
            } else{//有小题
                this.onloadChildQues();
            }
        }else if(showType==5){//大题为解答题
            if(this.childQuesJson.length==0){//没有小题
                if(this.answerContent!=undefined) var a_cont=this.answerContent;
                var html='<div class="mBox">';
                html+='<div class="ABox">';
                html+='<div class="row">';
                html+='<div class="formL">答案:</div>';
                html+='<div class="formR">';
                html+='<textarea id="answer" name="answer" class="ue_textarea" style=" height:150px;">'+a_cont+'</textarea>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                html+='<div class="show_subItem">';
                html+='<div class="row">';
                html+='<div class="formL"></div>';
                html+='<div class="formR">';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                $('.Box').html(html);
                var ue=UE.getEditor('answer');//初始化富文本
                ue.ready(function(){
                    if(!ue.hasContents()){
                        ue.setContent('<span style="color:#ccc">内容不能为空</span>')
                    };
                    ue.addListener('focus',function(){
                        if(this.getContent()=='<p><span style="color:#ccc">内容不能为空</span></p>'){
                            ue.setContent('');
                            this.focus();
                        };
                        ue.addListener('blur',function(){
                            if(!ue.hasContents()){
                                ue.setContent('<span style="color:#ccc">内容不能为空</span>');
                            };
                        })
                    });
                })

            }else{//有小题
                this.onloadChildQues();
            }
        }

        else if(showType==9){//大题为判断题
            if(this.childQuesJson.length==0){//没有小题
                var html='<div class="mBox">';
                html+='<div class="ABox">';
                html+='<div class="row">';
                html+='<div class="formL">答案:</div>';
                if(this.answerContent==1){
                    html+='<div class="formR"><input type="radio" name="decide" checked value="1"> 正确&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0" name="decide"> 错误</div>';
                }
                else{
                    html+='<div class="formR"><input type="radio" name="decide" value="1"> 正确&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0" name="decide" checked> 错误</div>';
                }
                html+='</div>';
                html+='<div class="row">';
                html+='</div>';
                html+="</div>";
                html+='</div>';
                html+='<div class="show_subItem">';
                html+='<div class="row">';
                html+='<div class="formL"></div>';
                html+='<div class="formR">';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                $('.Box').html(html);
                var ue=UE.getEditor('answer');//初始化富文本
                var ue=UE.getEditor('explanation');
                ue.ready(function(){
                    if(!ue.hasContents()){
                        ue.setContent('<span style="color:#ccc">内容不能为空</span>')
                    };
                    ue.addListener('focus',function(){
                        if(this.getContent()=='<p><span style="color:#ccc">内容不能为空</span></p>'){
                            ue.setContent('');
                            this.focus();
                        };
                        ue.addListener('blur',function(){
                            if(!ue.hasContents()){
                                ue.setContent('<span style="color:#ccc">内容不能为空</span>');
                            };
                        })
                    });
                })
            }else{//有小题
                this.onloadChildQues();
            }
        }
    },
    //改变小题题型
    changeType:function(sel){
        this.subItem_id++;
        this.selNum++;
        this.fillNum++;
        var type=sel.find('option:selected').val();
        var pa=sel.parents('.I_type').next('.I_Box');
        var i=sel.parents('.subItem').index();
        pa.empty();
        if(type==1 ||type==2){//选择题
            var html='';
            var html3='';
            html+='<div class="I_QBox">';
            html+='<div class="row">';
            html+='<div class="formL">题目:</div>';
            html+='<div class="formR"><textarea name="child['+i+'][sel]" id="sel_Q'+this.subItem_id+'"  class="ue_textarea sel" style=" height:150px;"></textarea></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_SBox">';
            html+='<div class="row">';
            html+='<div class="formL"><label>备选项<em>1</em></label></div>';
            html+='<div class="formR"><textarea name="child['+i+'][sub][]" id="sel_'+this.subItem_id+'" class="ue_textarea sub" style=" height:150px;"></textarea></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_ABox">';
            html+='<div class="row">';
            html+='<div class="formL">答案:</div>';
            html+='<div class="formR"><span><input value="0" name="child['+i+'][que][]" type="'+ (type==1 ? "radio" : "checkbox")+'"> <label>备选项<em>1</em></label></span></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="btnBar">';
            html+='<div class="row">';
            html+='<div class="formL"></div>';
            html+='<div class="formR"><button class="btn btn-primary addSelBtn" type="button">添加备选项</button></div>';
            html+='</div>';
            html+='</div>';
            pa.html(html);
            UE.getEditor('sel_Q'+this.subItem_id);
            UE.getEditor('sel_'+this.subItem_id);
        }else if(type==3){//填空题
            var html='';
            html+='<div class="I_QBox">';
            html+='<div class="row">';
            html+=' <div class="formL">题目:</div>';
            html+='<div class="formR"><textarea name="child['+i+'][content]" id="content'+this.fillNum+'" class="ue_textarea content" style=" height:150px;"></textarea></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_ABox">';
            html+='<div class="row">';
            html+='<div class="formL">答案:</div>';
            html+='<div class="formR"><textarea name="child['+i+'][answer][]" id="answerContent'+this.fillNum+'" class="ue_textarea answer" style=" height:150px;"></textarea></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_IBox"></div>';//预留给插入填空小题
            var html2='<div class="btnBar">';
            html2+='<div class="row">';
            html2+='<div class="formL"><label></label></div>';
            html2+='<div class="formR">';
            html2+='<button type="button" class="btn btn-primary addBtn sub_addMultiAnswerBtn">添加多个答案</button>';
            html2+='</div>';
            html2+='</div>';
            html2+=' </div>';
            pa.html(html+html2);
            UE.getEditor('content'+this.fillNum);
            UE.getEditor('answerContent'+this.fillNum);
        } else if(type==5){//解答题
            var html='';
            html+='<div class="I_QBox">';
            html+='<div class="row">';
            html+='<div class="formL">题目:</div>';
            html+='<div class="formR"><textarea name="child['+i+'][con]" id="content'+this.selNum+'" class="ue_textarea content" style=" height:150px;"></textarea></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_ABox">';
            html+='<div class="row">';
            html+='<div class="formL">答案:</div>';
            html+='<div class="formR"><textarea name="child['+i+'][ans]" id="answerContent'+this.selNum+'" class="ue_textarea answerContent" style=" height:150px;"></textarea></div>';
            html+='</div>';
            html+='</div>';
            pa.html(html);
            uq=UE.getEditor('content'+this.selNum);
            UE.getEditor('answerContent'+this.selNum)
        }else if(type==9){//判断题
            var html='';
            html+='<div class="I_QBox">';
            html+='<div class="row">';
            html+='<div class="formL">题目:</div>';
            html+='<div class="formR"><textarea name="child['+i+'][text]" id="content'+this.selNum+'" class="ue_textarea" style=" height:150px;"></textarea></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_ABox">';
            html+='<div class="row">';
            html+='<div class="formL">答案:</div>';
            html+='<div class="formR"><input type="radio" value="1" name="child['+i+'][decide]" checked> 正确&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0" name="child['+i+'][decide]"> 错误</div>';
            html+='</div>';
            html+='<div class="row">';
            html+='</div>';
            html+='</div>';
            pa.html(html);
            uq=UE.getEditor('content'+this.selNum);
            UE.getEditor('answerContent'+this.selNum)
        }
    },

    //点击添加小题按钮,添加小题
    addSub:function(){
        this.subItem_id++;
        this.fillNum++;
        this.selNum++;
        var i=$('.IBox .subItem').size();
        var html='';
        var html3='';//选择题题目
        html3+='<div class="I_QBox">';
        html3+='<div class="row">';
        html3+=' <div class="formL">题目:</div>';
        html3+=' <div class="formR"><textarea name="child['+i+'][text]" id="sel_Q'+this.subItem_id+'" class="ue_textarea" style=" height:150px;"></textarea></div>';
        html3+='</div>';
        html3+='</div>';
        html+='<div class="subItem I_'+i+'" data-item="'+i+'" >';
        html+='<h5>小题<em>'+(i+1)+'</em>:</h5>';
        html+='<span class="del_btn delSubBtn">删除</span>';
        html+='<div class="I_type">';
        html+='<div class="row">';
        html+='<div class="formL">题型:</div>';
        html+='<div class="formR"><select name="child['+i+'][showType]"  >'+this.subTypes+'</select></div>';
        html+='</div>';
        html+='</div>';
        $('.IBox').append(html);
        //判断小题题型
        var subType=$('.I_type select').find('option:first').val();
        //var subType=4; // 测试小题类型
        if(subType==9){
            var html='';
            html+='<div class="I_Box">';
            html+=html3;
            html+='<div class="I_ABox">';
            html+='<div class="row">';
            html+='<div class="formL">答案:</div>';
            html+='<div class="formR"><input type="radio" value="1" name="child['+i+'][decide]" checked> 正确&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0" name="child['+i+'][decide]" > 错误</div>';
            html+='</div>';
            html+='<div class="row">';
            html+='</div>';
            html+='</div>';
        }
        $('.I_'+i).append(html);
        UE.getEditor('sel_Q'+this.subItem_id);//题目
        if(subType==1){
            UE.getEditor('explanation'+i);//说明
        }
    },

    //onload添加小题
    addItem:function(child,i,j){//i小题的序列 j:小题索引
        var defaultVal={
            "showType":"1",//小题的类型
            "content":"小题的题目内容",//小题的题目
            "answerContent":"0",//小题答案
            "explanation":'说明说明说明说明说明说明',
            "answerOptionJson":[//sel:小题的备选项
                {
                    "id":"001",
                    "content":"小题备选项144444444444内容",
                    "right":"1"//1正确答案，0错误答案
                },
                {
                    "id":"002",
                    "content":"小题备选项2内容",
                    "right":"1"//1正确答案，0错误答案
                }
            ]
        };
        var obj=$.extend({},defaultVal,child);
        var itemType=obj.showType;


        //小题为选择题
        if(itemType==1||itemType==2){

            var selHtml=this.createSelHtml(obj.answerOptionJson, itemType,i);//创建多选项
            var html='';
            html+='<div class="subItem I_'+i+'">';
            html+='<h5>小题<em>'+(i+1)+'</em>:</h5>';
            html+='<span class="del_btn delSubBtn">删除</span>';
            html+='<div class="I_type">';
            html+='<div class="row">';
            html+='<div class="formL">题型:</div>';
            html+='<div class="formR"><select name="child['+i+'][showType]" >'+this.subTypes+'</select></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_Box">';
            html+='<div class="I_QBox">';
            html+='<div class="row">';
            html+='<div class="formL">题目:</div>';
            html+='<div class="formR"><textarea name="child['+i+'][sel]"  id="content'+i+'" class="ue_textarea sel" style=" height:150px;">'+obj.content+'</textarea></div>';
            html+='</div>';
            html+='</div>';

            html+='<div class="I_SBox">';
            html+=selHtml[0];   //备选项列表
            html+='</div>';
            html+='<div class="I_ABox">';
            html+='<div class="row">';
            html+='<div class="formL">答案:</div>';
            html+='<div class="formR">';
            html+=selHtml[1]; //备选项答案
            html+='</div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="btnBar">';
            html+='<div class="row">';
            html+='<div class="formL"></div>';
            html+='<div class="formR">';
            html+='<button class="btn btn-primary addSelBtn" type="button">添加备选项</button>';
            html+='</div>';
            html+=' </div>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            $('.IBox').append(html);
        }
        //小题为填空题
        else if(itemType==3){
            var html="";
            html+='<div class="subItem I_'+i+'">';
            html+='<h5>小题<em>'+(i+1)+'</em>:</h5>';
            html+='<span class="del_btn delSubBtn">删除</span>';
            html+='<div class="I_type">';
            html+='<div class="row">';
            html+='<div class="formL">题型:</div>';
            html+='<div class="formR"><select name="child['+i+'][showType]" >'+this.subTypes+'</select></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_Box">';
            html+='<div class="I_QBox">';
            html+='<div class="row">';
            html+=' <div class="formL">题目:</div>';
            html+='<div class="formR"><textarea name="child['+i+'][content]" id="content'+i+'" class="ue_textarea content" style=" height:150px;">'+obj.content+'</textarea></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_SBox"></div>';
            html+='<div class="I_ABox">';
            html+=this.multiAnswer(obj.answerContent,i);
            html+='</div>';
            html+='<div class="I_IBox"></div>';
            html+='<div class="btnBar">';
            html+='<div class="row">';
            html+='<div class="formL"><label></label></div>';
            html+='<div class="formR">';
            html+='<button type="button" class="btn btn-primary sub_addMultiAnswerBtn">添加多个答案</button>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            $('.IBox').append(html);
            UE.getEditor('answerContent'+i);
        }
        //小题为解答题
        else if(itemType==5){
            var html="";
            html+='<div class="subItem I_'+i+'">';
            html+='<h5>小题<em>'+(i+1)+'</em>:</h5>';
            html+='<span class="del_btn delSubBtn">删除</span>';
            html+='<div class="I_type">';
            html+='<div class="row">';
            html+='<div class="formL">题型:</div>';
            html+='<div class="formR"><select name="child['+i+'][showType]" >'+this.subTypes+'</select></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_Box">';
            html+='<div class="I_QBox">';
            html+='<div class="row">';
            html+='<div class="formL">题目:</div>';
            html+='<div class="formR"><textarea name="child['+i+'][con]"  id="content'+i+'" class="ue_textarea content" style=" height:150px;">'+obj.content+'</textarea></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_SBox"></div>';
            html+='<div class="I_ABox">';
            html+='<div class="row">';
            html+='<div class="formL">答案:</div>';
            html+='<div class="formR"><textarea name="child['+i+'][ans]" id="answerContent'+i+'" class="ue_textarea answerContent" style=" height:150px;">'+obj.answerContent+'</textarea></div>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            html+=' </div>';
            $('.IBox').append(html);
            UE.getEditor('content'+i);
            UE.getEditor('answerContent'+i);
        }else if(itemType==9){
            var html="";
            html+='<div class="subItem I_'+i+'">';
            html+='<h5>小题<em>'+(i+1)+'</em>:</h5>';
            html+='<span class="del_btn delSubBtn">删除</span>';
            html+='<div class="I_type">';
            html+='<div class="row">';
            html+='<div class="formL">题型:</div>';
            html+='<div class="formR"><select name="child['+i+'][showType]" >'+this.subTypes+'</select></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_Box">';
            html+='<div class="I_QBox">';
            html+='<div class="row">';
            html+='<div class="formL">题目:</div>';
            html+='<div class="formR"><textarea name="child['+i+'][text]"  id="content'+i+'" class="ue_textarea" style=" height:150px;">'+obj.content+'</textarea></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="I_SBox"></div>';
            html+='<div class="I_ABox">';
            html+='<div class="row">';
            html+='<div class="formL">答案:</div>';
            if(obj.answerContent==1){
                html+='<div class="formR"><input type="radio" name="child['+i+'][decide]" value="1" checked> 正确&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0" name="child['+i+'][decide]"> 错误</div>';
            }
            else{
                html+='<div class="formR"><input type="radio" name="child['+i+'][decide]" value="1"> 正确&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="child['+i+'][decide]" value="0" checked> 错误</div>';
            }
            html+='</div>';
            html+='<div class="row">';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            html+=' </div>';
            $('.IBox').append(html);
            UE.getEditor('content'+i);
            UE.getEditor('answerContent'+i);
        }
    },
    //-----------------------------------------------------------------------------------------
    //添加备选项
    addSelItem:function(btn){
        this.selNum++;
        var html='';
        var pa=btn.parents('[class$="Box"]');
        var i=pa.children('[class$="SBox"]').children('.row').size();
        var type=pa.children('[class$="ABox"]').find('input').attr('type');
        var name=pa.children('[class$="ABox"]').find('input').attr('name');
        var sel='';
        var single='';
        var item=btn.parents('.subItem').index();
        item>=0?sel='child['+item+'][sub][]':sel='sel[]';
        item>=0?single='child['+item+'][que][]':single='single[]';
        html+='<div class="row">';
        html+='<div class="formL">备选项<em>'+(i+1)+'</em></div>';
        html+='<div class="formR">';
        html+='<textarea name='+sel+' id="sel_'+this.selNum+'" class="ue_textarea sub" style=" height:150px;"></textarea>';
        html+='<span class="del_btn delSelBtn">删除</span>';
        html+='</div>';
        html+='</div>';
        var html2='<span><input name='+single+' value="'+i+'" type="'+ type+'"> <label>备选项<em>'+(i+1)+'</em></label></span>';
        pa.children('[class$="SBox"]').append(html);
        pa.children('[class$="ABox"]').find('.formR').append(html2);
        UE.getEditor('sel_'+this.selNum);
    },
    //排序
    Sequence:function(pa,tag,attr){
        pa.find(tag).each(function(index) {
            $(this).text(index+1)
        });
        if(attr){
            pa.find(tag).each(function(index) {
                $(this).attr(attr,index)
            });
        }
    },
    //--------------------------------------------------------------------------------------
    /*删除UE对象*/
    del_UE_obj:function(pa){//父级
        var IDs=pa.find('textarea');
        IDs.each(function(index, element) {
            var id=$(this).attr('id');
            UE.delEditor(id);
        })
    }
};

$(function(){
    id=$('[name=typeid]').val();
    preview.showType=id;
    $('#analytical').text(preview.analytical);
    //页面初始化
    preview.onloadType();

    //有小题
    $('.haveSubBtn').click(function(){
        if($(this).is(':checked')){
            $('.mBox').hide();
            var pa=$(this).parents('.Box');
            var i=pa.children('.IBox').children().size();
            if($('.IBox .subItem').size()==0 && IBoxHtml==""){//如果没有小题,添加空白小题
                $('.Box').append('<div class="IBox"></div>');
                preview.selNum++;
                preview.addSub();
                $('.Box').append('<div class="addSubBtn_bar"><button type="button" name="xiao" value="1" class="btn btn-primary addSubBtn">添加小题</button></div>');
                //富文本
                var textareas=$('.Box .IBox .I_SBox textarea');
                textareas.each(function(){
                    var id=$(this).attr('id');
                    UE.getEditor(id)
                });
                var contents=$('.Box .I_QBox textarea');
                contents.each(function(){
                    var id=$(this).attr('id');
                    UE.getEditor(id)
                });
                var contents=$('.Box .I_ABox textarea');
                contents.each(function(){
                    var id=$(this).attr('id');
                    UE.getEditor(id)
                });
            }else{
                $('.IBox, .addSubBtn_bar').show();
            }
        }else{
            $('.mBox').show();
            $('.IBox, .addSubBtn_bar').hide();

        }

    });
    var mBoxHtml="";
    var IBoxHtml="";
    $('.haveSubBtn').click(function(){
        if($(this).is(':checked')){
            mBoxHtml=$('.mBox').html();
            $('.mBox').empty().hide();
            var pa=$(this).parents('.Box');
            var i=pa.children('.IBox').children().size();

            if($('.IBox .subItem').size()==0 && IBoxHtml==""){//如果没有小题,添加空白小题
                $('.Box').append('<div class="IBox"></div>');
                preview.selNum++;
                preview.addSub();
                $('.Box').append('<div class="addSubBtn_bar"><button type="button" class="btn btn-primary addSubBtn">添加小题</button></div>');
                //富文本
                var textareas=$('.Box .IBox .I_SBox textarea');
                textareas.each(function(){
                    var id=$(this).attr('id');
                    UE.getEditor(id)
                });

                var contents=$('.Box .I_QBox textarea');
                contents.each(function(){
                    var id=$(this).attr('id');
                    UE.getEditor(id)
                });
                var contents=$('.Box .I_ABox textarea');
                contents.each(function(){
                    var id=$(this).attr('id');
                    UE.getEditor(id)
                });
            }
            else{
                if(IBoxHtml!=""){
                    $('.IBox').show().html(IBoxHtml)
                }
                else{
                    $('.IBox').show();
                }
                $('.IBox, .addSubBtn_bar').show();
            }
        }
        else{
            IBoxHtml=$('.IBox').html();
            $('.IBox').empty();
            $('.mBox').html(mBoxHtml).show();
            $('.IBox, .addSubBtn_bar').hide();
        }

    });



    //添加小题

    $('.Box').on('click','.addSubBtn',function(){
        preview.addSub();
    });
    //删除小题
    $('.Box').on('click','.delSubBtn',function(){
        var pa=$(this).parent('.subItem');
        $(this).parent('.subItem').remove();
        preview.Sequence($('.IBox .subItem h5'),"em");//小题号排序
        $('.IBox .subItem').each(function(index, element) {
            $(this).attr('class',"subItem I_"+index);
            //题型
            $(this).find('select').attr('name','child['+index+'][showType]');
            //根据题型调整小题的结构顺序
            var type = $(this).find('select').val();
            if(type == 1 || type == 2){
                //题目
                $(this).find('.sel').attr('name','child['+index+'][sel]');
                //备选项
                $(this).find('.sub').attr('name','child['+index+'][sub][]');
                //单选题，多选题 ，答案
                $(this).find('input').attr('name','child['+index+'][que][]');
            }else if(type == 3){
                //题目
                $(this).find('.content').attr('name','child['+index+'][content]');
                //答案
                $(this).find('.answer').attr('name','child['+index+'][answer][]');
            }else if(type == 5){
                //题目
                $(this).find('.content').attr('name','child['+index+'][con]');
                //答案
                $(this).find('.answerContent').attr('name','child['+index+'][ans]');
            }else{
                //题目
                $(this).find('textarea').attr('name','child['+index+'][text]');
                //答案
                $(this).find('input').attr('name','child['+index+'][decide]');
            }
        });
        preview.del_UE_obj(pa);
    });
    //添加备选项
    $('.Box').on('click','.addSelBtn',function(){
        preview.addSelItem($(this));
        preview.selNum++;
    });
    //删除备选项
    $('.Box').on('click','.delSelBtn',function(){
        var pa=$(this).parents("[class$='SBox']");
        var index=$(this).parents('.row').index();
        pa.next().find('span').eq(index).remove();
        $(this).parents('.row').remove();
        preview.Sequence(pa,"em");//备选项排序
        preview.Sequence(pa.next(),"em");//备选项答案排序
        preview.Sequence(pa.next(),"input","value");//input(radio checkbox)value值
        preview.del_UE_obj($(this).parent('div'));

    });
    //添加多个答案
    $('.Box').on('click','.addMultiAnswerBtn',function(){
        preview.selNum++;
        var pa_ABox=$(this).parents('.Box').find('.ABox');
        var	html='<div class="row">';
        html+='<div class="formL">答案:</div>';
        html+='<div class="formR">';
        html+='<textarea name="subItem[]" id="subItem_'+(preview.selNum)+'" class="ue_textarea" style=" height:150px;"></textarea>';
        html+='<span class="del_btn delLevel3Btn">删除</span>';
        html+='</div>';
        html+='</div>';
        pa_ABox.append(html);
        var ue = UE.getEditor('subItem_'+(preview.selNum));
    });

    $('.Box').on('click','.sub_addMultiAnswerBtn',function(){
        preview.selNum++;
        var pa_ABox=$(this).parents('.I_Box').find('.I_ABox');
        var i=$(this).parents('.subItem').index();
        var	html='<div class="row">';
        html+='<div class="formL">答案:</div>';
        html+='<div class="formR">';
        html+='<textarea name="child['+i+'][answer][]" id="subItem_'+(preview.selNum)+'" class="ue_textarea answer" style=" height:150px;"></textarea>';
        html+='<span class="del_btn delLevel3Btn">删除</span>';
        html+='</div>';
        html+='</div>';
        pa_ABox.append(html);
        var ue = UE.getEditor('subItem_'+(preview.selNum));
    })
    //删除填空小小题
    $('.Box').on('click','.delLevel3Btn',function(){
        var pa=$(this).parents('.I_IBox');
        $(this).parents('.row').remove();
        preview.Sequence(pa,"em");//小小题排序
        preview.del_UE_obj($(this).parent('div'));

    });
    //删除填空小题
    $('.Box').on('click','.delStype3Btn',function(){
        var pa=$(this).parents('.IBox');
        $(this).parents('.row').remove();
        preview.Sequence(pa,"em");//小题号排序
        preview.del_UE_obj($(this).parent('div'));
    });

    //修改题型
    $('.Box').on('change','select',function(){
        var I_SBox_pa=$(this).parents('.subItem').find('.I_SBox');
        var I_ABox_pa=$(this).parents('.subItem').find('.I_ABox');
        if(I_SBox_pa) preview.del_UE_obj(I_SBox_pa);
        if(I_ABox_pa) preview.del_UE_obj(I_ABox_pa);
        preview.changeType($(this));

    });
    //图片居中
    baidu.editor.commands['img_vertical'] = {execCommand: function() {
        var ss= this.getContent();
        var tt=ss.replace(/img/g,'img style="vertical-align: middle"');
        this.setContent(tt)
    }, queryCommandState: function() { } };
});


