<!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a href="{$conf->action_root}mainView">Strona główna</a></li>
            <li><a href="{$conf->action_root}reservationView">Rezerwacje</a></li>
            {if count($conf->roles) == 0}
                <li><a href="{$conf->action_root}loginView">Logowanie</a></li>
                <li><a href="{$conf->action_root}registerView">Rejestracja</a></li>
            {/if}
            {if \core\RoleUtils::inRole('worker')}
                <li><a href="{$conf->action_root}addBikeView">Dodaj rower</a></li>
                <li><a href="{$conf->action_root}acceptRentalsView">Akceptuj zamówienia</a></li>
                <li><a href="{$conf->action_root}rentalsView">Rezerwacje</a></li>
            {/if}
            {if \core\RoleUtils::inRole('admin')}
                <li><a href="{$conf->action_root}adminPanelView">Panel admina</a></li>
            {/if}
            {if count($conf->roles) > 0}
            <li><a href="{$conf->action_root}userRentalsView">Twoje rezerwacje</a></li>
                <li><a href="{$conf->action_root}logout">Wyloguj</a></li>
            {/if}
        </ul>
    </nav>