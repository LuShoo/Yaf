{loop $list $key $user_info}
	<tr class="odd" >
		<td style="vertical-align: middle;">{$user_info['id']}</td>
		<td style="vertical-align: middle;">{$user_info['name']}</td>
		<td style="vertical-align: middle;">{$user_info['star']}</td>
		<td style="vertical-align: middle;">{$user_info['sort']}</td>
		<td style="vertical-align: middle;">{if $user_info['is_free'] == 1}免费{else}收费{/if}</td>
		<td style="vertical-align: middle;">{$user_info['start_at']}</td>
		<td style="vertical-align: middle;">{$user_info['end_at']}</td>
        <td style="vertical-align: middle;">{if $user_info['status'] == 1}正常{elseif $user_info['status'] == 2}暂停{elseif $user_info['status'] == 10}删除{/if}</td>
        <td style="vertical-align: middle;">
        <table>
        {loop $user_info['taglist'] $key $tag}
        <tr>
        <td style="border: 0px; "> {$tag['tag_code']}</td>
         <td style="border:0px; ">{$tag['tag_name']}</td>
        </tr>
        {/loop}
       </table>
        
        </td>
		<td style="vertical-align: middle;">
            <a href="/ad/object/setview.html?id={$user_info['id']}" class="btn btn-small btn-primary">编辑</a>
		</td>
	</tr>
{/loop}