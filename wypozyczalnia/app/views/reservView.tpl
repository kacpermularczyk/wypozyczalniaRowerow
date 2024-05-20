{extends file="reserv.tpl"}

{block name=header}

<!-- Banner -->
<section id="banner">
<header>
	<h2>Dzień dobry, <strong>Kacper</strong></h2>
	<p>
		W tej sekcji możesz dokonać rezerwacji interesującego Cię roweru.
	</p>
</header>
</section>

{/block}

{block name=panel}

<div class="wrapper style1">

	<div class="container">
		<article id="main" class="special">
			<header>
				<h2><a href="">Rezerwacja</a></h2>
				<p>
					Wybierz typ roweru i termin rezerwacji.
				</p>
			</header>
			<form id="optionsForm">
				<select>
					<option>Model 1</option>
					<option>Model 2</option>
					<option>Model 3</option>
					<option>Model 4</option>
					<option>Model 5</option>
					<option>Model 6</option>
					<option>Model 7</option>
					<option>Model 8</option>
					<option>Model 9</option>
					<option>Model 10</option>
					</select>
					<p id="left"> od kiedy<br> <input type="date"> </p>
					<p id="right"> do kiedy<br> <input type="date"> </p>
				<button>Cena</button>
				<button>Zamów</button>
			</form>
	</div>
</div>

{/block}