<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$prod = new CProducts($db);

$prodId = isset($_GET['pid']) && !empty($_GET['pid'])? $_GET['pid'] : null;
$cat = isset($_GET['cat']) && !empty($_GET['cat'])? $_GET['cat'] : null;

$perPage  = isset($_GET['perPage']) && is_numeric($_GET['perPage'])? $_GET['perPage'] : 8;
$page  = isset($_GET['page']) && is_numeric($_GET['page'])? $_GET['page'] : 1;
$order = isset($_GET['order'])? $_GET['order'] : 'category';
$o     = isset($_GET['o'])? $_GET['o'] : 'asc';

in_array($order, array('prod_name', 'category', 'price', 'manufacture')) or die('Check: Not valid column.');
in_array($o, array('asc', 'desc')) or die('Check: Not valid sort order.');

$mfact['title'] = "Hardware";

$prod->setup($perPage, $page, $order, $o);

if($prodId) {
	$ret = $prod->getProduct($prodId);
	$mfact['main'] =
	"<div class='hardware'>
	<div class='breadCrumb left20'>
	<a href='hw.php'>Hardware</a> /
	<a href='hw.php?cat=".$ret['category']."'>".$ret['category']."</a> / ".$ret['type']."
	</div>
	<div class='prodTop'>
	<div class='left'><img src='img.php?src=prod/".$ret['img']."&height=150'></div>
	<div class='left left20'><span class='prodName'>".$ret['prodName']."</span><br>
	<span class='prodNameInfo'>".$ret['cpu'].", ".$ret['clock'].", ".$ret['ram'].", ".$ret['hdd']."<br><br>
	Price: ".$ret['price']." / month</span></div>
	</div>
	<div class='spec'>
	<table>
	<tr>
	<td>Manufacture: ".$ret['manufacture']."</td><td class='middle'>HDD: ".$ret['hdd']."</td><td>OS: ".$ret['os']."</td>
	</tr>
	<tr>
	<td>CPU: ".$ret['cpu']."</td><td class='middle'>RAM: ".$ret['ram']."</td><td>".$ret['scr']."</td>
	</tr>
	<tr>
	<td>CPU frequency: ".$ret['clock']."</td><td class='middle'>GPU: ".$ret['gpu']."</td><td>".$ret['res']."</td>
	</tr>
	</table>
	</div>
	<div class='info'>".$ret['info']."</div>
	</div>";
} else {
	$ret = $prod->listProducts($cat);
	$mfact['main'] = "";
	if($cat) {
		$mfact['main'] .=
		"<div class='news'>
		<div class='breadCrumb'><a href='hw.php'>Hardware</a> / <a href='hw.php?cat=".$cat."&p=1'>".$cat."</a> / </div>
		</div>";
	} else {
		$mfact['main'] .=
		"<div class='category'>
		<table>
		<td><a href='".$prod->oldQuery(array('cat' => 'Server', 'p' => 1))."'>Server</a></td>
		<td><a href='".$prod->oldQuery(array('cat' => 'Desktop', 'p' => 1))."'>Desktop</a></td>
		<td><a href='".$prod->oldQuery(array('cat' => 'Laptop', 'p' => 1))."'>Laptop</a></td>
		</table>
		</div>";
	}

	$mfact['main'] .= "<div class='right right20 noLink'>Found ".$ret[0]['max']." products. Products per page: ".$ret[0]['perPageNav']."<br>
		Order by: Manufacture <a href='".$ret[0]['oldQuery']."&amp;order=manufacture&amp;o=asc'>&#8659;</a><a href='".$ret[0]['oldQuery']."&amp;order=manufacture&amp;o=desc'>&#8657;</a> Name <a href='".$ret[0]['oldQuery']."&amp;order=prod_name&amp;o=asc'>&#8659;</a><a href='".$ret[0]['oldQuery']."&amp;order=prod_name&amp;o=desc'>&#8657;</a> Category <a href='".$ret[0]['oldQuery']."&amp;order=category&amp;o=asc'>&#8659;</a><a href='".$ret[0]['oldQuery']."&amp;order=category&amp;o=desc'>&#8657;</a> Price <a href='".$ret[0]['oldQuery']."&amp;order=price&amp;o=asc'>&#8659;</a><a href='".$ret[0]['oldQuery']."&amp;order=price&amp;o=desc'>&#8657;</a>
		</div>
		<table class='hardwareList'>";

	foreach ($ret[1] as $row) {
		$mfact['main'] .=
			"<tr>
			<td class='first bottom'><a href='hw.php?pid=".$row['id']."'><img src='img.php?src=prod/".$row['img']."&height=150'></a></td>
			<td class='bottom w520'><a href='hw.php?pid=".$row['id']."'>".$row['manufacture']." ".$row['prodName']."</a><br><br>
			<div class='left w200'>
			CPU: ".$row['cpu']."<br>
			Frequency: ".$row['clock']."
			</div>
			<div class='left w200 left20'>
			HDD: ".$row['hdd']."<br>
			RAM: ".$row['ram']."
			</div>
			</td>
			<td class='bottom left20'>
			Price: <br>".$row['price']." / month
			</td>
			</tr>";
	}

	$mfact['main'] .= "</table>
		<div class='noLink'>".$ret[0]['pageNav']."</div>";
}

include(MFACT_THEME_PATH);
