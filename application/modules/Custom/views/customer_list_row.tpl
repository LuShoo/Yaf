{loop $list $key $row}
    <tr class="odd">
        <td>{$row['id']}</td>
        <td>{$row['uid']}</td>
        <td>{$row['nick_name']}</td>
        <td>{$row['mobile']}</td>
        <!--
        <td>{if $row['status'] == 0}
                <span style="color: green;">未审核</span>
            {elseif $row['status'] == 1}
                <span style="color: red;">已提交，审核失败</span>
            {elseif $row['status'] == 2}
                <span style="color: red;">已实名</span>
            {elseif $row['status'] == 3}
                <span style="color: red;">已删除</span>
            {elseif $row['status'] == 4}
                <span style="color: red;">未实名</span>
            {/if}
        </td>
        -->
        <td><a href="javascript:void(0)" onclick="viewScoreDetail({$row['uid']})">{$row['score']}</a></td>
        <td>
            <a class="btn btn-small btn-success" href="javascript:void(0)" onclick="viewCardDetail({$row['uid']});"><i
                        class="icon-book icon-white"></i>查看详情</a>
        </td>
    </tr>
{/loop}
