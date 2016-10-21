{loop $list $key $msg_info}
<tr class="odd">
	<td width="5%" style="text-align:center">{$msg_info['id']}</td>
	<td width="10%" style="text-align:center">{$msg_info['badword']}</td>
	<td width="10%" style="text-align:center">{$msg_info['operatorid']}</td>
	<td width="10%" style="text-align:center">{$msg_info['created_at']}</td>
	
	<td width="5%" style="text-align:center">
		<a href="/push/badword/editMsg.html?id={$msg_info['id']}" class="btn btn-small btn-primary editbadword">编辑</a>
		<a href="javascript:void(0);" class="btn btn-small btn-primary deletebadword" data-id={$msg_info['id']}>删除</a>
		
	
	</td>
</tr>
{/loop}

