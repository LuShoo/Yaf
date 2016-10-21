{loop $list $key $msg_info}
<tr class="odd">
	<td width="6%">{$msg_info['id']}</td>
	<td width="10%">{$msg_info['partnerid']}</td>
	<td width="10%">{$msg_info['msg_title']}</td>
	<td width="16%">{$msg_info['msg_data']}</td>
	<td width="8%">{if $msg_info['msg_type'] == 1001}仅展示{elseif $msg_info['msg_type'] == 1002}链接{elseif $msg_info['msg_type'] == 1003}应用{/if}</td>
	{if $msg_info['is_immediate'] == 1}
	<td width="8%">是</td>
	{else}
	<td width="8%">否</td>
	{/if}
	<td width="16%">{$msg_info['created_at']}</td>
	<td width="8%">{if $msg_info['audit_status'] == 0}未审核{else}已审核{/if}</td>
	<td width="22%">
		<a href="javascript:void(0);" class="btn btn-small btn-primary sendMsg" data-id="{$msg_info['id']}">发送</a>
	</td>
</tr>
{/loop}

