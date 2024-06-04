{extends file="reserv.tpl"}

{block name=offer}
    <section id="features" class="container special">
        <header>
            {block name=filtering}{/block}
        </header>
        <div id="rentalsToAcceptReload">
            {include file="rentalToAcceptTable.tpl"}
        </div>
    </section>
{/block}

{block name=filtering}
    <form id="filterForm" class="rentForm" onsubmit="ajaxPostForm('filterForm','{$conf->action_root}rentalsToAcceptOnly','rentalsToAcceptReload'); return false;">
        <select name="filter">
            <option value="100" selected="true" hidden="true" disabled>Wybierz ilość wierszy</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="5">5</option>
            <option value="15">15</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="75">75</option>
            <option value="100">100</option>
        </select>
        <br><button>Szukaj</button>
    </form><br><br>
{/block}