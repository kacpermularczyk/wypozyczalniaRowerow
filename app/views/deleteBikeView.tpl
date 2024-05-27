{extends file="log.tpl"}

{block name=header}

<!-- Inner -->
<div class="inner" id="log">
    <form action="{$conf->action_root}deleteBike" method="post">
        <header>
            <h1><a href="" id="logo">{$title|default:"Title"}</a></h1>
            <hr />
            <select name="model">
                <option value="" selected disabled hidden>Wybierz model</option>
                {foreach $bikes as $b}
                    <option value="{$b["id_bike"]}">{$b["model"]}</option>
                {/foreach}                
            </select><br>
        </header>
        <footer>
            <button>{$buttonText|default:"OK"}</button>
        </footer>


        {include file='messages.tpl'}

    </form>
</div>

{include file='nav.tpl'}

{/block}