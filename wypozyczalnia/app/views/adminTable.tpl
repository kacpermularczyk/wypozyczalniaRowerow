<table>
    <tr>
        <th>User</th>
        <th>Rola</th>
        <th>Czy aktywna</th>
        <th>Od kiedy</th>
        <th>Do kiedy</th>
        <th>Dodaj rolę</th>
        <th>Usuń rolę</th>
        <th>Usuń usera</th>
    </tr>
    {foreach $data as $d}
    <tr>
        <td>

        {$d["login"]}
        {if $d["is_active"] == 1}
                (aktywne)
            {else}
                (nieaktywne)
            {/if}

        </td>
        <td>{$d["role"]}</td>

            {if $d["is_activated"] == 1}
                <td>Tak</td>
            {else}
                <td>Nie</td>
            {/if}

        <td>{$d["active_since"]}</td>


        
            {if $d["active_until"] == NULL}
                <td>Ciągle aktywna</td>
            {else}
                <td>{$d["active_until"]}</td>
            {/if}
        

        <td>
            <form action="{$conf->action_root}addRoleToUser" method="post">
                <select name="roles">
                    {foreach $roles as $r}
                        <option value="{$r["id_role"]}">{$r["role"]}</option>
                    {/foreach}
                </select>

                <button value="{$d["id_user"]}" name="userId">Dodaj</button>
            </form>
        </td>

        <td>
            <form action="{$conf->action_root}disableRoleToUser" method="post">
                <select name="roles">               
                        <option value="{$d["id_role"]}">{$d["role"]}</option>
                </select>

                <button value="{$d["id_user"]}" name="userId">Usuń</button>
            </form>
        </td>

        <td>
            <form action="{$conf->action_root}deleteUser" method="post">
                <button value="{$d["id_user"]}" name="userId">Usuń</button>
            </form>
        </td>
        
            
    </tr>
    {/foreach}
    
</table>