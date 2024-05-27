{extends file="log.tpl"}

{block name=header}

<!-- Inner -->
<div class="inner" id="log">
    <form action="{$conf->action_root}login" method="post">
        <header>
            <h1><a href="" id="logo">{$title|default:"Title"}</a></h1>
            <hr />
            <input placeholder="Login" type="text" name="login" value="{$form->login}"><br>
            <input placeholder="Hasło" type="password" name="password">
        </header>
        <footer>
            <button>{$buttonText|default:"OK"}</button>
        </footer>

        {include file='messages.tpl'}

    </form>
</div>

{include file='nav.tpl'}

{/block}