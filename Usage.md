#usage of yii-donate
# Introduction #
place in protected.extensions.donate directory.

Place code below in your view.
# Details #
```
<?php
  $this->widget('application.extensions.donate.Donate.php', 
 		array(
 		 'email',   //your paypal email address
		 'item',    // the description of what the donation is going for

	         'currency' //the currency to accept (defaults to usd)
		 'amt'      // the amount to donate
		));
?>
```