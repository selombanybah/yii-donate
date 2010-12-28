yii-donate is run just like a normal extension

ex. 
<?php
--view--

  $this->widget('application.extensions.donate.Donate', 
 		array(
 		 'email',   //your paypal email address
		 'item',    // the description of what the donation is going for
	         'currency' //the currency to accept (defaults to usd)
		 'amt'      // the amount to donate
		 'type' // type of donation 'paypal,moneybookers,alertpay'\
		 'item_code' // for use with moneybookers and aertpay
		 'language' // EN,SP etc
		 'quantity' //quantity 
 		 '$beforeform' // place divs heere or whatever you want to appera before the form
		 'rid'='5413099' //use with moneybookers
 		 'userbid'       // allow the user to set the donation amount     
		));
?>

