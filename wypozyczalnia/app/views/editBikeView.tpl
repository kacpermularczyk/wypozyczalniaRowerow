{extends file="log.tpl"}

{block name=header}

<!-- Inner -->
<div class="inner" id="log">
    <form action="{$conf->action_root}editBike" method="post">
        <header>
            <h1><a href="" id="logo">{$title|default:"Title"}</a></h1>
            <hr />
            <input placeholder="Model roweru" type="text" name="model"><br>
            <select name="bikeType">
                <option value="" selected disabled hidden>Wybierz typ roweru</option>
                {foreach $types as $t}
                    <option value="{$t["id_type"]}">{$t["type"]}</option>
                {/foreach}                
            </select><br>
            <input placeholder="Cena" type="text" name="price"><br>
            <textarea name="description"></textarea><br>
            <input type="file" name="picture" accept="image/png, image/jpg, image/jpeg">
        </header>
        <footer>
            <button>{$buttonText|default:"OK"}</button>
        </footer>


        {include file='messages.tpl'}

    </form>
</div>

{include file='nav.tpl'}

{/block}