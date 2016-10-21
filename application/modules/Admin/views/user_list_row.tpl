<!--{loop $user_list $key $user_info}-->
<tr class="odd">
	<td width="6%">{$user_info['id']}</td>
	<td width="30%">{$user_info['username']}</td>
	<td width="18%">{$user_info['nickname']}</td>

	<td width="12%">{$user_info['branch']}</td>
	<td width="12%">{$user_info['created_at']}</td>
	<td width="6%">{if $user_info['user_type'] == 0}系统管理员{else}渠道管理员{/if}</td>
	<td width="18%">
		{if {$_SESSION['user_info']['user_id']} == 1 && {$user_info['id']} != 1 }
			<a href="/admin/user/edit.html?id={$user_info['id']}" class="btn btn-small btn-primary">编辑</a>
			<a href="/admin/user/power.html?id={$user_info['id']}" class="btn btn-small btn-primary">权限设置</a>
		{elseif {$user_info['id']} != 1 && {$_SESSION['user_info']['level']} < {$user_info['user_level']}}
			{loop $btnInfo $key $val}
			<a href="{$val['btn_url']}?id={$user_info['id']}" class="btn btn-small btn-primary">{$val['btn_name']}</a>
			{/loop}
		{/if}
	</td>
</tr>
<!--{/loop}-->