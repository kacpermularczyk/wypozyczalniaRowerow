{extends file="reserv.tpl"}

{block name=offer}
    <section id="features" class="container special">
        {block name=searching}{/block}
    </section>
        <div id="dataToReload">
            {include file="adminTable.tpl"}
        </div>
        <br><br>
    <section id="features" class="container special">
        {block name=roles}{/block}
    </section>
{/block}

{block name=roles}
    <div id="jumpHere"></div>
    <hr>
    <form class="rentForm" action="{$conf->action_root}addRole" method="post">
        <br><h2>Operacje na rolach - system</h2><br><br><br>
        <p>Rola do dodania</p>
        <input type="text" name="newRole"><br>
        <button>Dodaj</button>
    </form>

    <form class="rentForm" action="{$conf->action_root}disableRole" method="post">
        <p>Rola do usunięcia</p>
        <select name="roles">
            <option value="" selected="true" hidden="true" disabled>Wybierz role do usunięcia</option>
            {foreach $roles as $r}
                <option value="{$r["id_role"]}">{$r["role"]}</option>
            {/foreach}
        </select>
        <br><button>Usuń</button>
    </form>
    {include file='messages.tpl'}
{/block}

{block name=searching}
    <form id="searchForm" class="rentForm" onsubmit="ajaxPostForm('searchForm','{$conf->action_root}tableOnly','dataToReload'); return false;">
        <input type="text" name="search">
        <br><button class="space">Szukaj</button>
        {if count($conf->roles) > 0}
            <button id="scroll" href="#jumpHere" class ="circled scrolly" class="space">W dół</button>
        {/if}
    </form><br><br>
{/block}