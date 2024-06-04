<table>
    <tr>
        <th>User</th>
        <th>Rower</th>
        <th>Od kiedy</th>
        <th>Do kiedy</th>
        <th>Opcje</th>
    </tr>
    {foreach $rentals as $r}
    <tr>
        <td>{$r["login"]}</td>
        <td>{$r["model"]}</td>
        <td>{$r["date_start"]}</td>
        <td>{$r["date_end"]}</td>
        <td>
            <form action="{$conf->action_root}accept" method="post">
                <button name="acceptButton" value="{$r["id_rental"]}">Accept</button>
            </form>

            <form action="{$conf->action_root}decline" method="post">
                <button name="declineButton" value="{$r["id_rental"]}">Decline</button>
            </form>
        </td>
    </tr>
    {/foreach}
    
</table>