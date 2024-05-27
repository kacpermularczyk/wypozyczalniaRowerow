{extends file="reserv.tpl"}

{block name=offer}
    <section id="features" class="container special">
        <header>
            {block name=filtration}{/block}
        </header>
        <div class="row">
            {foreach $bikes as $b}
            <article class="col-4 col-12-mobile special">
                <a href="#" class="image featured"><img src="{$conf->app_url}/images/{$b["picture"]}" alt="" /></a>
                <header>
                    <h3><a href="#jumpHere" class = "circled scrolly">{$b["model"]} ({$b["type"]}) - {$b["price"]}</a></h3>
                </header>
                <p>
                    {$b["description"]}
                </p>
            </article>
            {/foreach}
        </div>
        <br><br>
        {if count($conf->roles) > 0}
            {block name=rent}{/block}
        {/if}
    </section>
{/block}

{block name=filtration}
    <form class="rentForm">
        <select name="category">
            <option value="" selected disabled hidden>Wybierz typ roweru</option>
            <option value="">Wszystkie rowery</option>
            {foreach $types as $t}
                <option value="{$t["id_type"]}">{$t["type"]}</option>
            {/foreach}
        </select><br>
        <button>Filtruj</button>
    </form><br>
{/block}

{block name=rent}
    <div id="jumpHere"></div>
    <hr>
    <form class="rentForm">
        <h2>Rezerwacja</h2><br>
        <select>
            <option>Model 1</option>
            <option>Model 2</option>
            <option>Model 3</option>
            <option>Model 4</option>
        </select><br>
        <p>Od kiedy</p>
        <input type="date"><br><br>
        <p>Do kiedy</p>
        <input type="date">
        <br><br><button>Zarezerwuj</button>
    </form>
{/block}