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
			<p>Använder en server baserad på ett väldigt praktiskt utvecklingspaket <a href='http://www.easyphp.org/'>EasyPHP</a> och är som namnet väldigt enkel att använda det är en utvecklingsserver där PHP, Apache, MySQL, PhpMyAdmin, Xdebug är förinställda och färdiga att använda med minimal behov av inställningar, och med en praktisk administrationspanel.</p>
			
			<h3>Berätta hur det gick att jobba igenom guiden “20 steg för att komma igång PHP”, var något nytt eller kan du det?</h3>
			<p>Har arbetat en hel del med PHP, OO och MySQL innan så det mesta var repetition. Då jag är självlärd dök det upp bitar som jag inte visste att man kunde göra, då jag aldrig haft behovet av det och inte gjort någon riktig genomgång på PHP, som jag dock kommer att dra nytta av i framtida utveckling.</p>
			<p>Problem jag har haft är dock att själva kursmiljön (itslearning) är ganska seg och tar lång tid att bläddra mellan innehållet vilket har lett till lite frustration.</p>

			<h3>Vad döpte du din webbmall Anax till?</h3>
			<p>MFact (M!), orsak why not.</p>

			<h3>Vad anser du om strukturen i Anax, gjorde du några egna förbättringar eller något du hoppade över?</h3>
			<p>Funderade på att göra om filstrukturen så att alla filer ligger under roten. Dvs. Alla filer tillhörande denna sida ligger i samma mapp. Då det kan upplevas rörigt att inte ha alla delar samlade.	Men det skulle i min mening förstöra återanvändbarheten av render för flera sidor, vilket är ett delmål med denna kurs.</p>
			<p>Ändrade några av struktur taggarna till att använda HTML5 taggar istället då det faktiskt är den nya standarden. Gjorde en modifierad dynamisk meny där jag tog bort markeringen av nuvarande sida och lade till submeny för redovisnings sidan.</p>
			<p>Redovisnings sidan är uppbyggd av en switch där beroende på val av uppgift sätter rätt text för visning. Detta är en	återanvändbar förberedelse inför databas momentet där informationen istället hämtas från databasen.</p>
			<p>dump() funtionen är implementerad men ännu ej använd då jag ej stött på problem som krävt den ännu men den är bra att ha. (Bättre att ha ett verktyg du inte behöver, än att sakna ett verktyg du inte kan undvara).</p>

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
			<h3>Hur väl känner du till objektorienterade koncept och programmeringssätt?</h3>
			<p>Har läst flera kurser under min studietid och även färdigställt ett flertal projekt där jag stött på och använt
			objektorienterad programmering dock har dessa varit i java. Skillnaden till PHP är inte jättestor utan det handlar snarare om lite olika syntax.</p>

			<h3>Jobbade du igenom oophp20-guiden eller skumläste du den?</h3>
			<p>Skummade igenom den lite snabbt dock var det mesta bekant (lite syntax skillnad). Dock var spl_autoload_register() väldigt intressant, enkelt och smidigt att inte behöva inkludera alla filerna man behöver varje gång man skall använda en klass utan att detta sköts av PHP automatiskt. Var även en bra referenshjälp när man stötte på problem.</p>

			<h3>Berätta om hur du löste uppgiften med tärningsspelet 100, hur tänkte du och hur gjorde du, hur organiserade du din kod?</h3>
			<p>Byggde upp spelet med klasserna CDie, CDieGame, CDiePlayer. CDie innehåller tärningen som används i spelet och dess värde och antal sidor. CDiePlayer representerar en spelare, dess typ och dess total poäng. CDieGame är själva spelet och innehåller all spel logik och spelets, om än simpla, utseende.</p>
			<p>Det går att spela 1, 2 eller mot datorn. Dator spelaren innehåller en enkel artificiell intelligens där den max slår 5 tärningar i rad eller tills den uppnått ett tillfredsställande poäng nivå. Nivån är byggd så att ju närmare datorn är till mål poängen desto lägre blir tillfredsställande nivån och desto högre chans att dator spelaren sparar sin poäng.</p>
			<p>Tanken från början var att hålla logik och utseende separerat men efter att ha kört på ett tag blev det ändå inte så utan logik och utseende hamnade blandat i samma klass. Detta ledde till att användandet blev enklare då man endast skapar klassen och sedan anropar show() metoden i klassen och sedan fungerar det. Kanske blir att jag separerar de vid ett senare tillfälle men inte idag :)</p>

			<h3>Berätta om hur du löste uppgiften med Månadens Babe, hur tänkte du och hur gjorde du, hur organiserade du din kod?</h3>
			<p>Valde att även göra kalendern då jag gjort ett par av dessa för kunds räkning tidigare, dock inte som objektorienterad utan som metod i deras CMS. Därav valde jag också att inkludera namnsdags namn, röda dagar och flaggdagar. Hur jag lyckades med detta får ni gärna kolla i koden, det var en del jobb men då jag hade själva kalendern, navigering etc. färdigt kändes det mer lämpligt att inkludera dessa.</p>
			<p>Det blev en hel del pillande med PHP date(), mktime() och easter_days(). Namnsdags namnen är enkelt inkluderade som arrayer direkt i klassen, dessa skulle man dock mer lämpligt kunna lägga i en databas då det även med ett enkelt gränssnitt skulle öka editerbarheten av namnen. Även fasta röda dagar och flaggdagar är inkluderade i arrayer medans, den svåra biten, alla rörliga dagar räknas ut beroende på vilket år det är och adderas till arrayerna innan visning.</p>
			<p>Kalendern består av endast en klass då jag åter igen har blandat logik och utseende i klassen dock skulle det vara enkelt att separera dessa då allt är uppdelat i små metoder i klassen. Månadens babe blev istället bilder från olika resmål, för att man skall kunna drömma sig bort i vardagen.</p>
			";
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
