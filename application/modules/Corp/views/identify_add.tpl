<!DOCTYPE html> <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]--> <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]--> <!--[if !IE]><!--> <html lang="en"> <!--<![endif]--> <!-- BEGIN HEAD --> <head>
    <meta charset="utf-8"/>
    <title>showboom - 销售管理平台</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    {include ../../Admin/views/top.tpl}
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
    <!-- BEGIN HEADER -->
    {include ../../Admin/views/header.tpl}
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div id="container" class="row-fluid">
        <!-- BEGIN SIDEBAR -->
        {include ../../Admin/views/menu.tpl}
        <!-- END SIDEBAR -->
        <!-- BEGIN PAGE -->
        <div id="main-content">
            <!-- BEGIN PAGE CONTAINER-->
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN THEME CUSTOMIZER-->
                        <div id="theme-change" class="hidden-phone">
                            <i class="icon-cogs"></i>
                            <span class="settings">
                                <span class="text">Theme:</span>
                                <span class="colors">
                                    <span class="color-default" data-style="default"></span>
                                    <span class="color-gray" data-style="gray"></span>
                                    <span class="color-purple" data-style="purple"></span>
                                    <span class="color-navy-blue" data-style="navy-blue"></span>
                                </span>
                            </span>
                        </div>
                        <!-- END THEME CUSTOMIZER-->

                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                        <!--
                        <h3 class="page-title">
                            渠道管理 <small>添加渠道商</small>
                        </h3>
                        -->
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->


                <!-- BEGIN PAGE CONTENT-->          
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN BORDERED TABLE widget-->
                        <div class="widget">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i>添加实名企业</h4>
                            </div>
                            <div class="widget-body form">
                                <!-- BEGIN FORM-->
                                <form class="form-horizontal">

                                    <div class="control-group">
                                        <label class="control-label">业务类别</label>
                                        <div class="controls">
                                            <select  name="business_type" id="business_type" style="width:100px;">
                                                <option  value="0" selected="selected">请选择</option>
                                                <option  value="1" >渠道</option>
                                                <option  value="2">大客户</option>
                                                <option  value="3">虚商</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">实名企业选择</label>
                                        <div class="controls">
                                            <select  name="bid" id="bid" style="width:100px;">
                                            </select>
                                        </div>
                                    </div>



                                    <div class="control-group">
                                        <label class="control-label">实名人姓名</label>
                                        <div class="controls">
                                            <input type="text" name="iden_name" value="" class="span6  popovers">
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label">企业法人身份证</label>
                                        <div class="controls">
                                            <input type="text" name="iden_nric" value="" class="span6  popovers">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">企业名称</label>
                                        <div class="controls">
                                            <input type="text" name="corp_name" value="" class="span6  popovers"  data-original-title="注意" data-content="必须填写" data-trigger="hover">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">营业执照号</label>
                                        <div class="controls">
                                            <input type="text" name="corp_no" value="" class="span6  popovers" data-original-title="注意" data-content="必须填写" data-trigger="hover">
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label">企业授权人</label>
                                        <div class="controls">
                                            <input type="text" name="corp_licencer" value="" class="span6  popovers" data-original-title="注意" data-content="必须填写" data-trigger="hover">
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label">企业授权人联系方式</label>
                                        <div class="controls">
                                            <input type="text" name="mobile" value="" class="span6  popovers" data-original-title="注意" data-content="必须填写" data-trigger="hover">
                                        </div>
                                    </div>



                                    <div class="form-actions">
                                        <button class="btn btn-success" type="button" onclick="subform();">确认</button>
                                        <button class="btn" type="button" onclick="window.history.go(-1);">取消</button>
                                    </div>
                                </form>
                                <!-- END FORM-->           
                            </div>
                        </div>
                        <!-- END BORDERED TABLE widget-->
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    {include ../../Admin/views/footer.tpl}
    <script>
        jQuery(document).ready(function() {
            // initiate layout and plugins
            App.init();
        });

        $('#business_type').change(function() {
            var type=$(this).val();

           // alert(type);return;
            $.post('/corp/identify/getBid.html',{type:type},function(data) {

                 if(data.code==200){
                     var html='';
                     var len=data.result.length;

                     for(var i=0;i<len;i++){
                         html+='<option  value="'+data.result[i].bid+'">'+data.result[i].name+'</option>';
                     }
                     $('#bid').html(html);

                 }else{
                     alert('数据有误，请联系管理员');
                 }

            },'json');

        });

        function subform()
        {

            var business_type=$('#business_type').val();
            var bid=$('#bid').val();

            var iden_name       = $("input[name='iden_name']").val().trim();
            var iden_nric      = $("input[name='iden_nric']").val().trim();
            var corp_name       = $("input[name='corp_name']").val().trim();
            var corp_no        = $("input[name='corp_no']").val().trim();

            var corp_licencer    = $("input[name='corp_licencer']").val().trim();
            var mobile      = $("input[name='mobile']").val().trim();

            if(business_type<1){
                alert("请选择业务类型");
                return false;
            }

            if(!bid){
                alert("请选择实名企业");
                return false;
            }


            if(iden_name.length < 2)
            {
                alert("实名人姓名不少于两位字符");
                return false;
            }

            if(iden_nric.length < 15)
            {
                alert("企业法人身份证不少于15位");
                return false;
            }

            if(corp_name.length < 2)
            {
                alert("企业名称不少于两位字符");
                return false;
            }
            if(corp_no.length < 1)
            {
                alert("请填写营业执照号");
                return false;
            }


            if(corp_licencer.length < 2)
            {
                alert("企业授权人不少于两位字符");
                return false;
            }


            if(mobile.length < 1)
            {
                alert("请填写联系方式");
                return false;
            }

            //alert(345);return;



            var data = {business_type:business_type,'bid':bid,'iden_name':iden_name,'iden_nric':iden_nric,'corp_name':corp_name,'corp_no':corp_no,'corp_licencer':corp_licencer,mobile:mobile};

            $.post('/corp/identify/create.html',data,function(m){
                if(m.detail == 'ok')
                {
                    alert("操作成功。");
                    location.href = '/corp/identify/index.html';
                }
                else alert(m.detail);
            },"json");
        }
    </script>
</body>
<!-- END BODY -->
</html>