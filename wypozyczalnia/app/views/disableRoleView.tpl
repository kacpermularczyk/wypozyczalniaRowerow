{extends file="log.tpl"}

{block name=header}

<!-- Inner -->
<div class="inner" id="log">
    <form action="{$conf->action_root}disableRole" method="post">
        <header>
            <h1><a href="" id="logo">{$title|default:"Title"}</a></h1>
            <hr />
            <select name="roles">
                <option value="" selected disabled hidden>Wybierz role</option>
                {foreach $roles as $r}
                    <option value="{$r["id_role"]}">{$r["role"]}</option>
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