<?php 
/**
 * This is a M! pagecontroller.
 *
 */
// Include the essential config-file which also creates the $mfact variable with its defaults.
include(__DIR__.'/config.php'); 


// Do it and store it all in variables in the M! container.
$mfact['title'] = "Results";
$mfact['main'] = "<h1>Results</h1>";

if(isset($_GET['s'])){
	switch ($_GET['s']) {
		case 'kmom1':
			$mfact['title'] .= " - Kmom01";
			$mfact['main'] .= 
			"<h2>Kmom01</h2>
			
			<h3>Vilken utvecklingsmiljö använder du?</h3>
			<p>Windows 7 x64 som OS, med en modifierad variant av Sublime text 2 (med plugins för webbutveckling).</p>
			<p>Använder en server baserad på ett väldigt praktiskt utvecklingspaket <a href='http://www.easyphp.org/'>EasyPHP</a> och är som namnet
			väldigt enkel att använda det är en utvecklingsserver där PHP, Apache, MySQL, PhpMyAdmin, Xdebug är
			förinställda och färdiga att använda med minimal behov av inställningar, och med en praktisk administrationspanel.</p>
			
			<h3>Berätta hur det gick att jobba igenom guiden “20 steg för att komma igång PHP”, var något nytt eller kan du det?</h3>
			<p>Har arbetat en hel del med PHP, OO och MySQL innan så det mesta var repetition. Då jag är självlärd dök
			det upp bitar som jag inte visste att man kunde göra, då jag aldrig haft behovet av det och inte gjort någon
			riktig genomgång på PHP, som jag dock kommer att dra nytta av i framtida utveckling.</p>
			<p>Problem jag har haft är dock att själva kursmiljön (itslearning) är ganska seg och tar lång tid att bläddra
			mellan innehållet vilket har lett till lite frustration.</p>

			<h3>Vad döpte du din webbmall Anax till?</h3>
			<p>MFact (M!), orsak why not.</p>

			<h3>Vad anser du om strukturen i Anax, gjorde du några egna förbättringar eller något du hoppade över?</h3>
			<p>Funderade på att göra om filstrukturen så att alla filer ligger under roten. Dvs. Alla filer tillhörande denna sida ligger
			i samma mapp. Då det kan upplevas rörigt att inte ha alla delar samlade.	Men det skulle i min mening förstöra återanvändbarheten av render för flera sidor, vilket är ett delmål
			med denna kurs.</p>
			<p>Ändrade några av struktur taggarna till att använda HTML5 taggar istället då det faktiskt är den nya standarden.
			Gjorde en modifierad dynamisk meny där jag tog bort markeringen av nuvarande sida och lade till submeny
			för redovisnings sidan.</p>
			<p>Redovisnings sidan är uppbyggd av en switch där beroende på val av uppgift sätter rätt text för visning. Detta är en
			återanvändbar förberedelse inför databas momentet där informationen istället hämtas från databasen.</p>
			<p>dump() funtionen är implementerad men ännu ej använd då jag ej stött på problem som krävt den ännu men
			den är bra att ha. (Bättre att ha ett verktyg du inte behöver, än att sakna ett verktyg du inte kan undvara).
			</p>

			<h3>Gick det bra att inkludera source.php? Gjorde du det som en modul i ditt Anax?</h3>
			<p>Efter lite små problem gick det bra. Inkluderade den som klass med hjälp av Anax klassladdare.</p>
			<p>Ändrade även lite på utseendet med mörkare ram och blåtonigt fält i källkods visaren.</p>

			<h3>Gjorde du extrauppgiften med GitHub?</h3>
			<p>Har ännu inte gjort GitHub uppgiften då jag av ren vana har allt lokalt med egen FTP och egen backup.</p>
			";
			break;
		case 'kmom2':
			$mfact['title'] .= " - Kmom02";
			$mfact['main'] .= "
			<h2>Kmom02</h2>
			<p>Empty :(</p>";
			break;
		case 'kmom3':
			$mfact['title'] .= " - Kmom03";
			$mfact['main'] .= "
			<h2>Kmom03</h2>
			<p>Empty :(</p>";
			break;
		case 'kmom4':
			$mfact['title'] .= " - Kmom04";
			$mfact['main'] .= "
			<h2>Kmom04</h2>
			<p>Empty :(</p>";
			break;
		case 'kmom5':
			$mfact['title'] .= " - Kmom05";
			$mfact['main'] .= "
			<h2>Kmom05</h2>
			<p>Empty :(</p>";
			break;
		case 'kmom6':
			$mfact['title'] .= " - Kmom06";
			$mfact['main'] .= "
			<h2>Kmom06</h2>
			<p>Empty :(</p>";
			break;
		case 'kmom7':
			$mfact['title'] .= " - Kmom07";
			$mfact['main'] .= "
			<h2>Kmom07</h2>
			<p>Empty :(</p>";
			break;

		default: // BAD INPUT
			header("Location: 404.php");
			break;
	}
}

else{
$mfact['main'] = 
"<h1>Please select assignment from the submenu</h1>";
}

// Finally, leave it all to the rendering phase of M!.
include(MFACT_THEME_PATH);
