<!--{loop $list $key $row}-->
<tr class="odd">
    <td>{$row['card_type_name']}</td>
    <td>{if $row['provider'] == 'CM'}中国移动{elseif $row['provider'] == 'CN'}中国联通{elseif $row['provider'] == 'CT'}中国电信{/if}</td>
    <td>{$row['code']}</td>
    <td>{$row['pack_name']}</td>
    <td>{if $row['pack_type']==1}月套餐{elseif $row['pack_type']==2}季度包{elseif $row['pack_type']==3}半年包{elseif $row['pack_type']==4}年包{elseif $row['pack_type']==5}加油包{/if}</td>
    <td>{$row['pack_flow']}</td>
    <td>{$row['pack_duration']}</td>
    <td>{$row['cost_price']}</td>
    <td>{if $row['monthly_clearning'] == 0} 否{elseif $row['monthly_clearning'] == 1}是{/if}</td>
    <td>{if $row['effective_type'] == 0} 未指定{elseif $row['effective_type'] == 1}当月生效{elseif $row['effective_type'] == 2}下月生效{/if}</td>
    <td>{$row['created_at']}</td>
    <td>
        {if $_SESSION['user_info']['user_id'] == 1}
            <a class="btn btn-small btn-primary" href="/provider/product/editView.html?id={$row['id']}">编辑</a>
        {/if}
        <a class="btn btn-small btn-primary" href="/provider/product/detail.html?id={$row['id']}">查看详情</a>
    </td>
</tr>
<!--{/loop}-->

