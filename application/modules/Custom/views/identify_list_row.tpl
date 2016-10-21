<!--{loop $user_list $key $user_info}-->
	<tr class="odd">
		<td  style="width:120px;">{$user_info['nick_name']}</td>
		<td >
           <div style="padding-left:200px;">真实姓名：{$user_info['real_name']}</div>
           <div style="padding-left:200px;"">身份证号：{$user_info['real_nric']}</div>
           <div style="padding-left:200px;margin-bottom: 20px;"">手机号码：{$user_info['mobile']}</div>


           <div  class="customimg">
               <!--<img src="/static/img/{$user_info['front_img']} " onclick="largeFront(this)"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
               <img src="{$user_info['front_img']} " onclick="largeFront(this)"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <img src="{$user_info['back_img']}" onclick="largeFront(this)"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <img src="{$user_info['handheld_img']}" onclick="largeFront(this)"/>&nbsp;&nbsp;&nbsp;
           </div>

        </td>

        <td style="width:280px;">

           {if $user_info['status']==2}
                   已通过
            {else}

               <div style="margin-top:20px;">
                   <input type="radio" name="check_status_{$user_info['id']}" value="2"  onclick="closeReason(this)"/>通过 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name="check_status_{$user_info['id']}" value="1"  {if $user_info['status']==1 }checked {/if}onclick="showReason(this)"/>拒绝
               </div>

               <div style="margin-top: 20px;">
                   {if $user_info['status']==1 }
                       <textarea  onblur="textareablur(this)"  onclick="textareafocus(this)">{$user_info['desc']}</textarea>

                   {else}

                       <textarea  style="display:none" onblur="textareablur(this)"  onclick="textareafocus(this)">请填写拒绝原因！</textarea>
                   {/if}

                   <button style="width:60px;height:30px;" onclick="checkSubmit(this,{$user_info['id']})">确定</button>
               </div>


            {/if}

        </td>
		
	</tr>
<!--{/loop}-->
