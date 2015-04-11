<h1>Formulär och validering</h1>
<form method="post" action="?p=kmom03-validate">
<fieldset>
	<legend>Exempel på formulär med validering</legend>
	<p>
	<label for="input1">Användarkonto:</label><br>
	<input id="input1" class="text" type="text" name="account">
	</p>
	<p>
	<label for="input2">Lösenord:</label><br>
	<input id="input2" class="text" type="password" name="password">
	</p>
	<p>
	<input type="submit" name="doLogin" value="Login">
	</p>
</fieldset>
</form>
<p>Du anropade sidan med följande querystring:
<code><?php echo htmlentities($_SERVER['QUERY_STRING']); ?></code></p>
<p><code>$_GET</code> innehåller följande:</p>
<pre><?php print_r($_GET); ?></pre>
<p><code>$_POST</code> innehåller följande:</p>
<pre><?php print_r($_POST); ?></pre>
<?php
if(isset($_POST['account'])) {
	echo "<p>Kontot är definerat.</p>";
	if(empty($_POST['account'])) {
		echo "<p>Kontot är tomt.</p>";
	}
	else {
    	if(is_numeric($_POST['account'])) {
	        echo "<p>Kontot består av enbart numeriska tecken.</p>";
		} else {
		        echo "<p>Kontot består EJ av enbart numeriska tecken.</p>";
		}
		echo "<p>Med strip_tags ser kontot ut: '".strip_tags($_POST['account'])."'</p>";
	}
} else {
    echo "<p>Kontot är EJ definerat.</p>";
}
?>