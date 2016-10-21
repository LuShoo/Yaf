{loop $list $key $app_info}
<tr class="odd">
	<td width="6%">{$app_info['id']}</td>
	<td width="10%">{$app_info['partnerid']}</td>
	<td width="10%">{$app_info['app_key']}</td>
	<td width="16%">{$app_info['master_secret']}</td>
	{if $app_info['status'] == 1}
	<td width="8%">正常</td>
	{else}
	<td width="8%">删除</td>
	{/if}
	<td width="16%">{$app_info['created_at']}</td>
	<td width="8%">{$app_info['updated_at']}</td>
	<td width="22%">
		<a href="/push/app/editApp.html?id={$app_info['id']}" class="btn btn-small btn-primary">编辑</a>
		<a href="javascript:void(0);" class="btn btn-small btn-primary delapp" data-id="{$app_info['id']}">删除</a>
	</td>
</tr>
{/loop}