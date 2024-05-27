{extends file="log.tpl"}

{block name=header}

<!-- Inner -->
<div class="inner" id="log">
    <form action="{$conf->action_root}addRoleToUser" method="post">
        <header>
            <h1><a href="" id="logo">{$title|default:"Title"}</a></h1>
            <hr />
           <select name="users">
                <option value="" selected disabled hidden>Wybierz usera</option>
                {foreach $users as $u}
                    <option value="{$u["id_user"]}">{$u["login"]}</option>
                {/foreach}                
            </select><br>

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