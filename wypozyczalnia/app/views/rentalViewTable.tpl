<table>
    <tr>
        <th>User</th>
        <th>Rower</th>
        <th>Od kiedy</th>
        <th>Do kiedy</th>
        <th>Czy w terminie</th>
    </tr>
    {foreach $rentals as $r}
    <tr>
        <td>{$r["login"]}</td>
        <td>{$r["model"]}</td>
        <td>{$r["date_start"]}</td>
        <td>{$r["date_end"]}</td>
        <td>
            <form action="{$conf->action_root}inTerm" method="post">
                <button name="yes" value="{$r["id_rental"]}">TAK</button>
            </form>

            <form action="{$conf->action_root}notInTerm" method="post">
                <button name="no" value="{$r["id_rental"]}">NIE</button>
            </form>
        </td>
    </tr>
    {/foreach}
    
</table>