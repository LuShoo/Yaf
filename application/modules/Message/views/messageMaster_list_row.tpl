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
	<td width="8%">{if $msg_info['status'] == 0}删除{else}正常{/if}</td>
	<td width="22%">

		<a href="javascript:void(0);" class="btn btn-small btn-primary tipsInfo" data-id="{$msg_info['msg_code']}">查看详情</a>
		<a href="javascript:void(0);" class="btn btn-small btn-primary pushInfo" data-id="{$msg_info['msg_code']}">查看发送情况</a>
	</td>
</tr>
{/loop}

