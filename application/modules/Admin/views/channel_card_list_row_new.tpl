<!--{loop $list $key $user_info}-->
	<tr class="odd">
		<td>{$user_info['iccid']}</td>
		<td>{$user_info['type_name']}</td>
		<td>{$user_info['telephone']}</td>
		<td>{$user_info['batch']}</td>
		<td>{if $user_info['is_active']!=0}<span style="color:#f00;">已激活</span>{else}未激活{/if}</td>
		<td>{if $user_info['is_binding']!=0}<span style="color:#f00;">已绑定</span>{else}未绑定{/if}</td>
		<td>{if $user_info['is_recharge']!=0}<span style="color:#f00;">已充值</span>{else}未充值{/if}</td>
		<td>{$user_info['cid']}</td>
		<td>{$user_info['user_name']}</td>
		<td>{$user_info['expire_time']}</td>
		<td>
            <!--<button  onclick="delConfig({$user_info['id']})"  class="btn btn-small btn-primary">删除</button>-->
            <a  class="btn btn-small btn-primary" href="/admin/channelcard/detail.html?id={$user_info['id']}">查看详情</a>
		</td>
	</tr>
<!--{/loop}-->

