{extends file="reserv.tpl"}

{block name=offer}
    <section id="features" class="container special">
        <header>
            {block name=searching}{/block}
        </header>
        <div class="row" id="bikesToReload">
            {include file="bikesList.tpl"}
        </div>
        <br><br>
        {if count($conf->roles) > 0}
            {block name=rent}{/block}
        {/if}
    </section>
{/block}

{block name=searching}
    <form id="searchForm" class="rentForm" onsubmit="ajaxPostForm('searchForm','{$conf->action_root}bikesOnly','bikesToReload'); return false;">
        <input type="text" name="search">
        <br><button class="space">Szukaj</button>
        {if count($conf->roles) > 0}
            <button id="scroll" href="#jumpHere" class ="circled scrolly" class="space">W dół</button>
        {/if}
    </form><br><br>
{/block}

{block name=rent}
    <div id="jumpHere"></div>
    <hr>
    <form class="rentForm" action="{$conf->action_root}reservation" method="post">
        <h2>Rezerwacja</h2><br><br>
        <p>Model do wypożyczenia</p>
        <input type="text" id="input" name="modelToReserv"><br>
        <p>Od kiedy</p>
        <input type="datetime-local" name="dateStart"><br><br>
        <p>Do kiedy</p>
        <input type="datetime-local" name="dateEnd">
        <br><br><br><button>Zarezerwuj</button>
    </form>
    {include file='messages.tpl'}
{/block}