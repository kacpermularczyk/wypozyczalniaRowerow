{extends file="log.tpl"}

{block name=header}

<!-- Inner -->
<div class="inner" id="log">
    <form action="{$conf->action_root}addRole" method="post">
        <header>
            <h1><a href="" id="logo">{$title|default:"Title"}</a></h1>
            <hr />
           <input placeholder="nowa Rola" type="text" name="newRole">
        </header>
        <footer>
            <button>{$buttonText|default:"OK"}</button>
        </footer>


        {include file='messages.tpl'}

    </form>
</div>

{include file='nav.tpl'}

{/block}