<? require_once('ui/page.listing.php'); ?>
<div>
	<h2> Your standing offers: </h2>
	<?php
	$count = 0;
	$resource = getOffers($_SESSION['id'], $count);
	if(!$resource) {
		echo '<p> <i> An error has occurred </i> </p>';
	} else {
		if($count == 0) {
			echo '<p> <i> You have no standing offers </i> </p>';
		} else {
			$row = mysql_fetch_row($resource);
			while($row) {
				echo format($row);
				$row = mysql_fetch_row($resource);
			}
		}
	}
	?>
</div>
<div>
	<h2> Your standing bids: </h2>
	<?php
	$count = 0;
	$resource = getBids($_SESSION['id'], $count);
	if(!$resource) {
		echo '<p> <i> An error has occurred </i> </p>';
	} else {
		if($count == 0) {
			echo '<p> <i> You have no standing bids </i> </p>';
		} else {
			$row = mysql_fetch_row($resource);
			while($row) {
				echo format($row);
				$row = mysql_fetch_row($resource);
			}
		}
	}
	?>
</div>
<div>
	<h2> Offer matches: </h2>
	<? // TODO offer matches ?>
</div>
<div>
	<h2> Bid matches: </h2>
	<? // TODO bid matches ?>
</div>