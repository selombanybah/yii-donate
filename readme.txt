yii-donate is run just like a normal extension

ex. 
<?php
--view--

  $this->widget('application.extensions.donate.Donate.php', 
 		array(
 		 'email',   //your paypal email address
		 'item',    // the description of what the donation is going for
	         'currency' //the currency to accept (defaults to usd)
		 'amt'      // the amount to donate
		));
?>

