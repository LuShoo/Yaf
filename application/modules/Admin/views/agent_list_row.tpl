<!--{loop $user_list $key $user_info}-->
	<tr class="odd">
		<td width="6%">{$user_info['id']}</td>
		<td width="20%">{$user_info['name']}</td>
		<td width="18%">{$user_info['agentname']}</td>
        <td width="10%">{$user_info['telephone']}</td>
        <td width="16%">{$user_info['address']}</td>
        <td width="12%">{$user_info['created_at']}</td>
		<td width="10%">{if $user_info['status'] == 1}正常{else}冻结{/if}</td>
		<td width="8%">
            <a href="/admin/agent/edit.html?id={$user_info['id']}" class="btn btn-small btn-primary">编辑</a>
		</td>
	</tr>
<!--{/loop}-->