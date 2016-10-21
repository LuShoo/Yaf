{loop $list $key $row}
    <tr class="odd">
        <td>{$row['created_at']}</td>
        <td>{$row['desc']}</td>
        <td>{$row['change_score']}</td>
    </tr>
{/loop}
