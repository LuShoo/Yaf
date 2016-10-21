<!--{loop $list $key $user_info}-->
	<tr class="odd">

		<td >{if $user_info['business_type']==1 }渠道{elseif $user_info['business_type']==2}大客户{elseif $user_info['business_type']==3}虚商{/if}</td>
		<td >{$user_info['bid']}</td>
        <td >{$user_info['iden_name']}</td>
        <td >{$user_info['iden_nric']}</td>
        <td >{$user_info['corp_name']}</td>
        <td >{$user_info['corp_no']}</td>
        <td >{$user_info['corp_licencer']}</td>
        <td >{$user_info['mobile']}</td>

        <td>
            <!--<button  onclick="delConfig({$user_info['id']})"  class="btn btn-small btn-primary">删除</button>-->
            <a  class="btn btn-small btn-primary" href="/corp/identify/edit.html?id={$user_info['id']}">编辑</a>
        </td>


	</tr>
<!--{/loop}-->


