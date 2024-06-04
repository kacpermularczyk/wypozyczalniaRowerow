{extends file="reserv.tpl"}

{block name=offer}
    <section id="features" class="container special">
        {block name=searching}{/block}
        <div id="rentalsToReload">
            {include file="rentalViewTable.tpl"}
        </div>
    </section>
{/block}

{block name=searching}
    <form id="searchForm" class="rentForm" onsubmit="ajaxPostForm('searchForm','{$conf->action_root}rentalsOnly','rentalsToReload'); return false;">
        <input type="text" name="search">
        <br><button class="space">Szukaj</button>
    </form><br><br>
{/block}