{extends file="log.tpl"}

{block name=header}

<!-- Inner -->
<div class="inner" id="log">
    <form action="{$conf->action_root}login" method="post">
        <header>
            <h1><a href="" id="logo">{$title|default:"Title"}</a></h1>
            <hr />
            <select>
                <option>user1</option>
                <option>user2</option>
                <option>user3</option>
                <option>user4</option>
            </select><br>
            <select>
                <option>worker</option>
                <option>admin</option>
                <option>user</option>
                <option>rola 4</option>
            </select>
        </header>
        <footer>
            <button>{$buttonText|default:"OK"}</button>
        </footer>


        {include file='messages.tpl'}

    </form>
</div>

{include file='nav.tpl'}

{/block}