{extends file="log.tpl"}

{block name=header}

<!-- Inner -->
<div class="inner" id="log">
    <form>
        <header>
            <h1><a href="" id="logo">{$title|default:"Title"}</a></h1>
            <hr />
            <input placeholder="Imie" type="text"><br>
            <input placeholder="Nazwisko" type="text"><br>
            <input placeholder="Login" type="text"><br>
            <input placeholder="Hasło" type="password"><br>
            <input placeholder="Powtórz hasło" type="password">
        </header>
        <footer>
            <button>{$buttonText|default:"OK"}</button>
        </footer>
    </form>
</div>

<!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a href="{$conf->action_root}hello">Strona główna</a></li>
            <li><a href="{$conf->action_root}login">Logowanie</a></li>
            <li><a href="{$conf->action_root}register">Rejestracja</a></li>
        </ul>
    </nav>

</div>

{/block}