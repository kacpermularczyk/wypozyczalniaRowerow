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
                <li><a href="{$conf->action_root}deleteBikeView">Usuń rower</a></li>
                <li><a href="{$conf->action_root}editBikeView">Edytuj rower</a></li>
            {/if}
            {if \core\RoleUtils::inRole('admin')}
                <li><a href="{$conf->action_root}addRoleToUserView">Dodaj rolę user</a></li>
                <li><a href="{$conf->action_root}disableRoleToUserView">wyłącz rolę user</a></li>
                <li><a href="{$conf->action_root}addRoleView">Dodaj rolę</a></li>
                <li><a href="{$conf->action_root}disableRoleView">wyłącz rolę</a></li>
                <li><a href="{$conf->action_root}deleteUserView">Usuń usera</a></li>
            {/if}
            {if count($conf->roles) > 0}
                <li><a href="{$conf->action_root}logout">Wyloguj</a></li>
            {/if}
        </ul>
    </nav>