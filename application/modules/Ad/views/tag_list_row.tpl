{loop $list $key $user_info}
	<tr class="odd">
		<td >{$user_info['id']}</td>
		<td >{$user_info['app_code']}</td>
		<td >{$user_info['app_name']}</td>
		<td >{$user_info['tag_code']}</td>
		<td >{$user_info['tag_name']}</td>
        <td >{if $user_info['status'] == 1}正常{elseif $user_info['status'] == 2}暂停{elseif $user_info['status'] == 10}删除{/if}</td>
        <td >{$user_info['update_at']}</td>
		<td width="8%">
            <a href="/ad/tag/setview.html?id={$user_info['id']}" class="btn btn-small btn-primary">编辑</a>
		</td>
	</tr>
{/loop}