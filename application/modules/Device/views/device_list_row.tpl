{loop $list $key $msg_info}
<tr class="odd">
	<td width="6%" style="text-align:center">{$msg_info['id']}</td>
	<td width="10%">{$msg_info['partnerid']}</td>
	<td width="10%">{$msg_info['imei']}</td>
	<td width="20%">{$msg_info['registration_id']}</td>
	<td width="20%">{$msg_info['mark']}</td>
	<td width="20%">{$msg_info['created_at']}</td>
	<td width="22%">
		<a href="/device/device/editDevice.html?id={$msg_info['id']}" class="btn btn-small btn-primary">编辑</a>
	</td>
</tr>
{/loop}