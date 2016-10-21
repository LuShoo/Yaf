<!--{loop $list $key $user_info}-->
	<tr class="odd">
		<td width="6%">{$user_info['id']}</td>
		<td width="20%">{$user_info['title']}</td>
		<td width="18%">{$user_info['card_type']}</td>
        <td width="10%">{$user_info['rate']}</td>
        <td width="12%">{$user_info['created_at']}</td>
		<td width="8%">
            <button  onclick="delConfig({$user_info['id']})"  class="btn btn-small btn-primary">删除</button>
		</td>
	</tr>
<!--{/loop}-->