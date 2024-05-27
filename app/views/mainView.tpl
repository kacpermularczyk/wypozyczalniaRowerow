{extends file="main.tpl"}

{block name=header}

<!-- Inner -->
<div class="inner">
    <header>
        <h1><a href="" id="logo">{$firstTitle|default:"Title"}</a></h1>
        <hr />
        <p>{$secondTitle|default:"description"}</p>
    </header>
    <footer>
        <a href="#jumpHere" class="button circled scrolly">Start</a>
    </footer>
</div>

{/block}

{block name=main}

<div class="container">

<div class="row gtr-200">
    <div class="col-8 col-12-mobile" id="content">
        <article id="main">
            <header>
                <h2><a href="">Kim jesteśmy?</a></h2>
                <p>
                    Wypożyczalnia mieści się w Sosnowcu na ulicy Ulicowskiej 5.
                </p>
            </header>
            <a href="" class="image featured"><img src="{$conf->app_url}/images/street.jpg" alt="" /></a>
            <p>
                Nasza oferta obejmuje różne typy rowerów, od górskich do wypożyczalni rowerów miejskich. Wypożyczalnia rowerów jest idealnym rozwiązaniem dla tych, którzy chcą wypróbować nowy sposób podróży, czyli jazdą na rowerze. Nasza wypożyczalnia rowerów oferuje komfortowe i bezpieczne korzystanie z rowerów, które są regularnie serwisowane i utrzymywane w odpowiednim stanie. Dzięki naszej wypożyczalni możesz również zdobyć wiedzę o najlepszych trasach i najciekawszych punktach w mieście. Nasze ekipy obsługi są gotowe pomóc w przypadku jakichkolwiek problemów lub pytania.
            </p>
            <section>
                <header>
                    <h3>Oferta</h3>
                </header>
                <p>
                    Nasza wypożyczalnia rowerów oferuje również różne typy usług, które mogą pomóc Ci w wyborze najlepszego rozwiązania dla Twoich potrzeb. Oferujemy wypożyczenie rowerów na godziny, cały dzień lub nawet na kilka dni. W naszej wypożyczalni możesz również zdobyć wiedzę o najlepszych trasach i najciekawszych punktach w mieście, aby mogli Państwo bardziej swobodnie korzystać z naszych rowerów.

                    W naszej ofercie znajdziesz również różne dodatkowe usługi, takie jak wypożyczenie narzędzi i akcesoriów do rowerów, aby mogli Państwo dokładnie sprawdzić swoją cyklizację. Nasza wypożyczalnia rowerów jest również otwarta przez cały rok, co oznacza, że możesz wypłynąć na rowerze niezależnie od pory roku.
                </p>
                <p>
                    Jeśli szukasz nowego sposobu podróży i chcesz zacząć korzystać z rowerem, to nasza wypożyczalnia jest idealnym rozwiązaniem dla Ciebie. Dzięki naszej wypożyczalni możesz zdobyć nowe doświadczenie i zapamiętać szczególne chwile na swoim rowerze.
                </p>
            </section>
            <section>
                <header>
                    <h3>Infomracje kontaktowe</h3>
                </header>
                <p>
                    Jesteśmy aktywni na social mediach, gdzie często umiesczamy różne posty, aby zapoznać się z naszymi aktualnymi informacjami i ofertami. Możesz również skontaktować się z nami za pomocą poczty elektronicznej, wysyłając wiadomość na adres wypozyczalniaSU5@gmail.com. Jeśli preferujesz rozmowę telefoniczną, możesz dzwonić do nas na numer 123-456-789. Nasza recepcja jest otwarta codziennie, aby pomóc Ci w Twoich potrzebach. Kontaktując się z nami, możesz uzyskać więcej informacji o naszym przedsiębiorstwie i ofertach.
                </p>
            </section>
        </article>
    </div>
    <div class="col-4 col-12-mobile" id="sidebar">
        <hr class="first" />
        <section>
            <header>
                <h3><a href="">Jak zarezerwować rower</a></h3>
            </header>
            <p>
                Aby to zrobić najpierw musisz się zalogować lub jeśli nie masz konta zarejestrować. Następnie przejdź do zakładki rezerwacje (będzie aktywna dopiero po zalogowaniu). Wybierz rower i termin który Ci opdowiada. Możesz się zalogować klikając odpowiednią zakładkę w górnym menu.
            </p>
            <footer>
                <a href="#jumpHere3" class="button circled scrolly" class="button">Nasza oferta</a>
            </footer>
        </section>
        <hr />
        <section>
            <header>
                <h3><a href="">Opinie klientów</a></h3>
            </header>
            <p>
                Mieliśmy klientów niemal z całej Polski poniżej kilka wybranych opini.
            </p>
            <div class="row gtr-50">
                <div class="col-4">
                    <a href="" class="image fit"><img src="{$conf->app_url}/images/user.png" alt="" /></a>
                </div>
                <div class="col-8">
                    <h4>{$person1|default:"person1"}</h4>
                    <p>
                        {$description1|default:"description1"}
                    </p>
                </div>
                <div class="col-4">
                    <a href="" class="image fit"><img src="{$conf->app_url}/images/user.png" alt="" /></a>
                </div>
                <div class="col-8">
                    <h4>{$person2|default:"person2"}</h4>
                    <p>
                        {$description2|default:"description2"}
                    </p>
                </div>
                <div class="col-4">
                    <a href="" class="image fit"><img src="{$conf->app_url}/images/user.png" alt="" /></a>
                </div>
                <div class="col-8">
                    <h4>{$person3|default:"person3"}</h4>
                    <p>
                        {$description3|default:"description3"}
                    </p>
                </div>
                <div class="col-4">
                    <a href="" class="image fit"><img src="{$conf->app_url}/images/user.png" alt="" /></a>
                </div>
                <div class="col-8">
                    <h4>{$person4|default:"person4"}</h4>
                    <p>
                        {$description4|default:"description4"}
                    </p>
                </div>
                <div class="col-4">
                    <a href="" class="image fit"><img src="{$conf->app_url}/images/user.png" alt="" /></a>
                </div>
                <div class="col-8">
                    <h4>{$person5|default:"person5"}</h4>
                    <p>
                        {$description5|default:"description5"}
                    </p>
                </div>
            </div>
            <footer>
                <a href="#jumpHere2" class="button circled scrolly" class="button" >Nasze social media</a>
            </footer>
        </section>
    </div>
</div>
</div>

{/block}

{block name=galery}

<!-- Carousel -->
<header id="jumpHere3">
    <h3 id="toCenter">Najczęściej wybierane rowery</h3>
</header>
<section class="carousel">
    <div class="reel">
        {foreach $bikes as $b}
        <article>
            <a href="" class="image featured"><img src="{$conf->app_url}/images/{$b["picture"]}" alt="" /></a>
            <header>
                <h3><a href="">{$b["model"]} ({$b["type"]}) - {$b["price"]}</a></h3>
            </header>
            {if $b@index eq 9}
                {break}
            {/if}
        </article>
        {/foreach}
    </div>
</section>

{/block}