<?php 
/**
 * This is a M! pagecontroller.
 *
 */
// Include the essential config-file which also creates the $mfact variable with its defaults.
include(__DIR__.'/config.php'); 


// Do it and store it all in variables in the M! container.
$mfact['title'] = "Me";

$mfact['main'] = 
"<h1>About me</h1>
<br>
<p>Mads heter jag.</p>
<p>Är 26 år och har studerat Civilingenjör - Computer Science - Software Engineering på LTH.<br>
Kamsport är ett stort intresse och varit aktiv tränande de senaste 15 åren, där jag även driver klubben jag tränar i.<br>
Bor i en liten by Svalöv (ca 3600 invånare) i skåne med nära till allt.</p>

<h2>History</h2>
<p>Anledningen till den konstiga stavningen på namnet beror helt och hållet på att jag är dansk :)</p>
<p>Har utvecklat och designat hemsidor som hobby under flera års tid och anledningen till 
att jag läser denna kurs är för att mina kunskaper innom området är helt självlärda, tanken är 
att se hur väl mina kunskaper står sig gentemot en kurs på högskolan.</p>";

// Finally, leave it all to the rendering phase of M!.
include(MFACT_THEME_PATH);
