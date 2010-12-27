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
	public $type='paypal';
	public $email;
	public $item='A Good Cause';
	public $code;
	public $language='EN';
	public $quantity;
	public $currency='USD';
	public $amt;
	protected $form;
        
       
    function init()
     {
	switch($this->type)
	{
	    case 'paypal':
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
	    break;
	    
	    case 'alertpay':
		$this->form='
		<div id="donate_alertpay" class="donate">
		<form method="post" action="https://www.alertpay.com/PayProcess.aspx" target="_blank" class="payment_form alertpay" >
		<input type="hidden" name="ap_purchasetype" value="item"/>
		<input type="hidden" name="ap_merchant" value="'.$this->email.'"/>
		<input type="hidden" name="ap_itemname" value="'. $this->item .'"/>
		<input type="hidden" name="ap_itemcode" value="'. $ithis->code .'"/> 
		<input type="hidden" name="ap_quantity" value="'.$this->quantity.'"/>
		<input type="hidden" name="ap_returnurl" value=""/>
		<input type="hidden" name="ap_currency" value="<?php print.' $this->currency.'; ?>"/>
		<label>' $this->currency.' <input type="text" name="'.$this->amt.'" value="'.$this->amt.'" size="3" /></label><br/>
		<input type="image" name="ap_image" src="<?php print $this->uri; ?>/images/alertpay_logo.png" width="90" height="60" alt="Donate with AlertPay" style="border: none; background: none;" />
		</form>
		</div>';
	    break;
	    
	    case 'moneybookers':
		$this->form='
		<div id="donate_moneybookers" class="donate">
		<form action="https://www.moneybookers.com/app/payment.pl" method="post" target="_blank" class="payment_form moneybookers" >
		<input type="hidden" name="pay_to_email" value="'. $this->email.'" />
		<input type="hidden" name="language" value="'.$this->language.'" />
		<input type="hidden" name="rid" value="5413099" />
		<label >'.$this->currency.' <input type="text" name="amount" value="'. $this->amt.'" size="3" /></label><br/>
		<input type="hidden" name="currency" value="'. $this->currency .'" />
		<input type="hidden" name="detail1_description" value="'.$this->code .'" />
		<input type="hidden" name="detail1_text" value="'.$this->item .'" />
		<input type="image" src="<?php print $this->uri; ?>/images/mb_orange_donate_with.gif" width="90" height="60" border="0" name="submit" alt="Donate with Moneybookers" style="border: none; background: none;" />
		</form>
		</div>';
	    break;
	}
    }
	
    public function run()
    {
	echo $this->form;
    }
    
}
