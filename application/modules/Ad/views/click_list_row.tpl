{loop $list $key $user_info}
	<tr class="odd">
		<td >{$user_info['id']}</td>
		<td >{$user_info['ad_id']}</td>
		<td >{$user_info['platform']}</td>
        <td >{$user_info['app_code']}</td>
		<td >{$user_info['tag_code']}</td>
		<td >{$user_info['mac']}</td>
		<td >{$user_info['idfa']}</td>
        <td >{$user_info['idfv']}</td>
        	<td >{$user_info['imei']}</td>
		<td >{$user_info['phone']}</td>
        <td >{$user_info['create_at']}</td>
	</tr>
{/loop}