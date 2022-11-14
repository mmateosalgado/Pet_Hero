<?php 
 include('Views/../../Section/nav.php');
 ?>

<main id="main">
	<section id="left">
		<div id="head">
			<h1>Pet-Hero</h1>
			<p>Lo mejor para ellos </p>
		</div>
		<h3>Monto: $15.000 <br> Del 25/2 al 27/2</h3>
	</section>
	<section id="right">
		<h1>Pagar 50% del total</h1>
		<form action="#">
			<div id="form-card" class="form-field">
				<label for="cc-number">Nro de tarjeta:</label>
				<input id="cc-number" maxlength="19" placeholder="1111 - 2222 - 3333 - 4444 " required>
			</div>

			<div id="form-date" class="form-field">
				<label for="expiry-month">Fecha de expiración:</label>
				<div id="date-val">
					<select id="expiry-month" required>
															<option id="trans-label_month" value="" default="default" selected="selected">Month</option>
															<option value="1">01</option>
															<option value="2">02</option>
															<option value="3">03</option>
															<option value="4">04</option>
															<option value="5">05</option>
															<option value="6">06</option>
															<option value="7">07</option>
															<option value="8">08</option>
															<option value="9">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
													</select>
					<select id="expiry-year" required>
															<option id="trans-label_year" value="" default="" selected="selected">Year</option>
													<option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option><option value="2029">2029</option><option value="2030">2030</option><option value="2031">2031</option><option value="2032">2032</option><option value="2033">2033</option><option value="2034">2034</option><option value="2035">2035</option><option value="2036">2036</option><option value="2037">2037</option><option value="2038">2038</option><option value="2039">2039</option><option value="2040">2040</option><option value="2041">2041</option><option value="2042">2042</option><option value="2043">2043</option><option value="2044">2044</option><option value="2045">2045</option><option value="2046">2046</option><option value="2047">2047</option></select>
				</div>
			</div>
			
			<div id="form-sec-code" class="form-field">
				<label for="sec-code">Codigo seguridad:</label>
				<input type="password" maxlength="3" placeholder="123" required>
			</div>
			
			<button type="submit">Confirmar Reserva</button>
		</form>
	</section>
</main>