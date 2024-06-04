<table>
<tr>
    <th>Rower</th>
    <th>Od kiedy</th>
    <th>Do kiedy</th>
    <th>Czy oddałeś/aś w terminie</th>
</tr>
{foreach $rentals as $r}
<tr>
    <td>{$r["model"]}</td>
    <td>{$r["date_start"]}</td>
    <td>{$r["date_end"]}</td>
    
        {if $r["returned_in_term"] == 1}
            <td>Tak</td>
        {elseif $r["not_returned_in_term"] == 1}
            <td>Nie</td>
        {else}
            <td>Rezerwacja trwa</td>
        {/if}
    
</tr>
{/foreach}

</table>