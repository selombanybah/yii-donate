<?php
/**
 * Donate component.
 * This implements a donation component for yii 
 * 
 * 2010 Jason Clark
 *
 */

class Donate extends CWidget
{
	public $email;
	public $item='A Good Cause';
	public $currency='USD';
	public $amt;
	protected $form;
        
       
    function init()
     {
	$this->form='
	<div id="donate_paypal" class="donate">
	<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="'.$email.'">
	<input type="hidden" name="item_name" value="'.$this->item.'">
	<input type="hidden" name="currency_code" value="'.$this->currency.'">
	<input type="hidden" name="amount" value="'.$this->amt.'">
	<input type="image" src="http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
	</form>
	</div>';
    }
	
    public function run()
    {
	echo $this->form;
    }
    
}
