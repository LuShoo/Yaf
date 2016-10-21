{loop $list $key $row}
<tr class="odd">
	<td>{$row['id']}</td>
	<td>{$row['type_name']}</td>
	<td>{$row['iccid']}</td>
	<td>{$row['telephone']}</td>
    <td>{$row['order_id']}</td>
	<td>{$row['pack_name']}</td>
    <td>{if $row['pack_type'] == 0}其他 {elseif $row['pack_type'] == 1}月套餐  {elseif $row['pack_type'] == 2}季度包{elseif $row['pack_type'] == 3}半年包{elseif $row['pack_type'] == 4}年包{elseif $row['pack_type'] == 5}加油包{/if}</td>
    <td>{if $row['status'] == 0}未激活 {elseif $row['status'] == 1}未生效 {elseif $row['status'] == 2}已生效 {/if}</td>
    <td>{$row['pack_price']}</td>
    <td>{$row['effective_time']}</td>
	<td>{$row['expire_time']}</td>
	<td>
	<a class="btn btn-small btn-success"href="/card/cardpackage/setview.html?id=$row['id']"><iclass="  icon-edit icon-white"></i>查看详情</a>
	</td>
</tr>
{/loop}