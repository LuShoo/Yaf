{loop $list $key $row}
<tr class="odd">
	<!--<td>{$row['id']}</td>-->
	<td>{$row['type_name']}</td>
	<td>{$row['iccid']}</td>
	<td>{$row['telephone']}</td>
    <td>{$row['batch']}</td>
	<td>{$row['init_package']}</td>
     <td>{if $row['status'] == 1}<label style="font-size: 30px;">×</label> {elseif $row['status'] == 2} <label style="font-size: 20px;color:#CC3333;">√</label> {/if}</td>
    <td>{$row['expire_time']}</td>
    <td>{$row['created_at']}</td>
	<td>{$row['remark']}</td>
	<td>{$row['verify_code']}</td>
	<td>
	<a class="btn btn-small btn-success"href="/card/cardinfo/setview.html?id=$row['id']"><iclass="  icon-edit icon-white"></i>编辑</a>
	</td>
</tr>
{/loop}
