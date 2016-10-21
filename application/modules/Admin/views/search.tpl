<!-- begin gloabl search -->
<div class="widget">
    <div class="widget-title">
        <h4><i class="icon-search"></i>查找用户</h4>
    </div>
    <div class="widget-body">
        <table class="table table-bordered table-hover">
            <tr>
                <td width="85%">
                <li>用户手机号 : <input class="search-inp" type="text" name="telephone" id="telephone" value="{$search['telephone']}"></li>
                    <li>用户姓名 : <input class="search-inp" type="text" name="uname" id='uname' value="{$search['uname']}"></li>
                    <li>盒子设备号 : <input class="search-inp" type="text" name="sn" id='sn' value="{$search['sn']}"></li>
                    <li>盒子IMEI : <input class="search-inp" type="text" name="imei" id='imei' value="{$search['imei']}"></li>
                    <li>SIM卡号 : <input class="search-inp" type="text" name="simtelephone" id='simtelephone' value="{$search['simtelephone']}"></li>
                    <li>SIM的CCID : <input class="search-inp" type="text" name="ccid" id='ccid' value="{$search['ccid']}"></li>
                </td>
                <td>
                    <p style="margin:5px 0 0 0;text-align: center"><a href="#" class="btn btn-large btn-primary btn-block" id="search_user">搜索用户</a></p>
                    <p style="margin:10px 0 0 0;text-align: center"><a href="#" class="btn btn-large btn-success btn-block" id="search_order">查寻订单</a></p>
                </td>
            </tr>
        </table>
    </div>

</div>
<!-- end gloabl search -->
