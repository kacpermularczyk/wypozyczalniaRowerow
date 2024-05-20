<!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a href="{$conf->action_root}mainView">Strona główna</a></li>
            {if count($conf->roles) == 0}
                <li><a href="{$conf->action_root}loginView">Logowanie</a></li>
                <li><a href="{$conf->action_root}registerView">Rejestracja</a></li>
            {/if}
            {if count($conf->roles) > 0}
                <li><a href="{$conf->action_root}reservationView">Rezerwacje</a></li>
                <li><a href="{$conf->action_root}logout">Wyloguj</a></li>
            {/if}
        </ul>
    </nav>