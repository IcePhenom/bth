<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$prod = new CProducts($db);

$mfact['title'] = "Home";
$mfact['image'] =
"<div id='mainImage'>
<ul class='bjqs'>
<li><img src='img/front/1.jpg'></li>
<li><img src='img/front/2.jpg'></li>
<li><img src='img/front/3.jpg'></li>
<li><img src='img/front/4.jpg'></li>
<li><img src='img/front/5.jpg'></li>
</ul></div>";

$mfact['main'] =
"<div class='category'>
<table>
<td><a href='hw.php?cat=server&p=1'>Server</a></td>
<td><a href='hw.php?cat=desktop&p=1'>Desktop</a></td>
<td><a href='hw.php?cat=laptop&p=1'>Laptop</a></td>
</table>
</div>";

$res = $prod->frontProduct();

$mfact['main'] .=
"<div class='hardwareFront'>
<span class='hardwareName'>Latest hardware</span>
<table>
<tr>";
foreach ($res as $row)
	$mfact['main'] .= "<td class='verticalLine'><a href='hw.php?pid=".$row['id']."'><img src='img.php?src=prod/".$row['img']."&width=220&height=200'></a></td>";
$mfact['main'] .= "</tr><tr>";
foreach ($res as $row)
	$mfact['main'] .= "<td class='verticalLine'><a href='hw.php?pid=".$row['id']."'>".$row['manufacture']." ".$row['prodName']."</a></td>";
$mfact['main'] .= "</tr>
</table>
</div>
<div>
<div class='main_left left'>
Latest news
<table>
<tr>
<td><strong>Head title</strong><br>Short text</td>
</tr>
<tr>
<td><strong>Head title</strong><br>Short text</td>
</tr>
<tr>
<td><strong>Head title</strong><br>Short text</td>
</tr>
<tr>
<td><strong>Head title</strong><br>Short text</td>
</tr>
</table>
</div>
<div class='main_right left'>
<div class='popular'>
Most popular<br>
<img src='img.php?src=front/Acer_predator.png&width=220&height=200'>
Acer Predator
</div>
<div class='rented'>
Latest rented<br>
<img src='img.php?src=front/ASUS_VivoBook_S301LP.png&width=220&height=200'>
ASUS VivoBook S301LP
</div>
</div>
</div>";

include(MFACT_THEME_PATH);
