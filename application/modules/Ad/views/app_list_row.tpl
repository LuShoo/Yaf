{loop $list $key $user_info}
	<tr class="odd">
		<td width="6%">{$user_info['id']}</td>
		<td width="20%">{$user_info['app_code']}</td>
		<td width="18%">{$user_info['app_name']}</td>
        <td width="10%">{$user_info['platform']}</td>
        <td width="10%">{if $user_info['status'] == 1}正常{elseif $user_info['status'] == 2}暂停{elseif $user_info['status'] == 10}删除{/if}</td>
        <td width="12%">{$user_info['update_at']}</td>
		<td width="8%">
            <a href="/ad/app/setview.html?id={$user_info['id']}" class="btn btn-small btn-primary">编辑</a>
		</td>
	</tr>
{/loop}