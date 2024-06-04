{extends file="log.tpl"}

{block name=header}

<!-- Inner -->
<div class="inner" id="log">
    <form action="{$conf->action_root}login" method="post">
        <header>
            <h1><a href="" id="logo">{$title|default:"Title"}</a></h1>
            <hr />
            <input placeholder="Model roweru" type="text"><br>
            <select>
                <option>Gorski</option>
                <option>Miejski</option>
                <option>Szosowy</option>
                <option>BMX</option>
            </select><br>
            <input placeholder="Cena" type="text"><br>
            <textarea></textarea><br>
            <input type="file">
        </header>
        <footer>
            <button>{$buttonText|default:"OK"}</button>
        </footer>


        {include file='messages.tpl'}

    </form>
</div>

{include file='nav.tpl'}

{/block}