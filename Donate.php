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
	public $rid='5413099';
	public $userbid=1;
	protected $form;
	protected $assets; 
        
       
    function init()
     {
	   if($this->assets===null)
        {
            $file=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
            $this->assets=Yii::app()->getAssetManager()->publish($file);
        }
	
	$type = $this->type;
	$this->$type();
    }
	
    public function run()
    {
	echo $this->form;
    }
    
    protected function registerClientScript()
    {
        // ...publish CSS or JavaScript file here...
        $cs=Yii::app()->clientScript;
        $cs->registerCssFile($this->assets.'/donate.css');
    }
    protected function paypal()
    {
	$this->form='
		<div id="donate_paypal" class="donate">
		<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="'.$this->email.'">
		<input type="hidden" name="item_name" value="'.$this->item.'">
		<input type="hidden" name="currency_code" value="'.$this->currency.'">';
	    if($this->userbid==null)
	    {
	$this->form .='<input type="hidden" name="amount" value="'.$this->amt.'">';
	    }else{
	$this->form .='<input type="text" name="amount" value="'.$this->amt.'">';
	    }
	$this->form .=	'<input type="image" src="'.$this->assets.'/button_paypal.gif'
.'" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
		</form>
		</div>';
    }

    protected function alertpay()
    {
	$this->form='
		<div id="donate_alertpay" class="donate">
		<form method="post" action="https://www.alertpay.com/PayProcess.aspx" target="_blank" class="payment_form alertpay" >
		<input type="hidden" name="ap_purchasetype" value="item"/>
		<input type="hidden" name="ap_merchant" value="'.$this->email.'"/>
		<input type="hidden" name="ap_itemname" value="'. $this->item .'"/>
		<input type="hidden" name="ap_itemcode" value="'. $ithis->code .'"/> 
		<input type="hidden" name="ap_quantity" value="'.$this->quantity.'"/>
		<input type="hidden" name="ap_returnurl" value=""/>
		<input type="hidden" name="ap_currency" value="'. $this->currency.'"/>
		<label>'. $this->currency .' <input type="text" name="'.$this->amt.'" value="'.$this->amt.'" size="3" /></label><br/>
		<input type="image" name="ap_image" src="'.$this->assets.'/alertpay_logo.png" width="90" height="60" alt="Donate with AlertPay" style="border: none; background: none;" />
		</form>
		</div>';
    }
    
    protected function moneybookers()
    {
	$this->form='
		<div id="donate_moneybookers" class="donate">
		<form action="https://www.moneybookers.com/app/payment.pl" method="post" target="_blank" class="payment_form moneybookers" >
		<input type="hidden" name="pay_to_email" value="'. $this->email.'" />
		<input type="hidden" name="language" value="'.$this->language.'" />
		<input type="hidden" name="rid" value="'.$this->rid.'" />
		<label >'.$this->currency.' <input type="text" name="amount" value="'. $this->amt.'" size="3" /></label><br/>
		<input type="hidden" name="currency" value="'. $this->currency .'" />
		<input type="hidden" name="detail1_description" value="'.$this->code .'" />
		<input type="hidden" name="detail1_text" value="'.$this->item .'" />
		<input type="image" src="'.$this->assets.'/mb_orange_donate_with.gif" width="90" height="60" border="0" name="submit" alt="Donate with Moneybookers" style="border: none; background: none;" />
		</form>
		</div>';
    }
}
