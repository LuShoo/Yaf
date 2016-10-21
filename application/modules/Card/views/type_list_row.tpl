{loop $list $key $row}
<tr class="odd">
	<td>{$row['id']}</td>
	<td>{$row['name']}</td>
	<td>{$row['comment']}</td>
	<td>
    {if $row['provider'] == 1} 移动 {elseif $row['provider'] == 2} 联通 {elseif $row['provider'] == 3} 电信 {/if}
    </td>

    <td>{if $row['status'] == 0}不可用{elseif $row['status'] == 1} 可用 {elseif $row['status'] == 9} 已删除  {/if}</td>

    <td>{$row['created_at']}</td>

</tr>
{/loop}
