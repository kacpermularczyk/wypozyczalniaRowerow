{extends file="log.tpl"}

{block name=header}

<!-- Inner -->
<div class="inner" id="log">
    <form action="{$conf->action_root}register" method="post">
        <header>
            <h1><a href="" id="logo">{$title|default:"Title"}</a></h1>
            <hr />
            <input placeholder="Imie" type="text" name="firstName"><br>
            <input placeholder="Nazwisko" type="text" name="surname"><br>
            <input placeholder="E-mail" type="text" name="email"><br>
            <input placeholder="Login" type="text" name="login"><br>
            <input placeholder="Hasło" type="password" name="password"><br>
            <input placeholder="Powtórz hasło" type="password" name="passwordRepeat">
        </header>
        <footer>
            <button>{$buttonText|default:"OK"}</button>
        </footer>

        {include file='messages.tpl'}
    </form>
</div>

{include file='nav.tpl'}

{/block}