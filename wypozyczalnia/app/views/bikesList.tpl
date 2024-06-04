{foreach $bikes as $b}
<article class="col-4 col-12-mobile special">
    <a href="#" class="image featured"><img src="{$conf->app_url}/images/{$b["picture"]}" alt="" /></a>
    <header>
        {if $b["bike_condition"] == "Dostępny"}
            <button value="{$b["id_bike"]}" name="bikeToRent" onclick="document.getElementById('input').value = '{$b["model"]}';document.getElementById('scroll').click()">{$b["model"]} ({$b["type"]}) - {$b["price"]}</button>
        {/if}

        {if $b["bike_condition"] != "Dostępny"}
            <button>{$b["model"]} ({$b["type"]}) - {$b["price"]}</button>
        {/if}
        <h3>{$b["bike_condition"]}</h3>
    </header>
    {if \core\RoleUtils::inRole('worker')}
        <form action="{$conf->action_root}editBikeView" method="post">
            <button id="left" value="{$b["id_bike"]}" name="bikeToEdit">Edytuj</button>
        </form>

        <form action="{$conf->action_root}deleteBike" method="post">
            <button id="right" value="{$b["id_bike"]}" name="bikeToDel">Usuń</button>
        </form>
    {/if}
    <p>
        {$b["description"]}
    </p>
</article>
{/foreach}