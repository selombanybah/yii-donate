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
	public $email='mithereal@gmail.com';
	public $item='A Good Cause';
	public $item_code;
	public $language='EN';
	public $quantity=1;
	public $beforeform;
	public $currency='USD';
	public $amt='$10.00';
	public $rid='5413099';
	public $userbid;
	protected $form;
	protected $assets; 
        
       
    function init()
     {
	   if($this->assets===null)
        {
            $file=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
            $this->assets=Yii::app()->getAssetManager()->publish($file);
	    $this->registerClientScript();
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
	$this->form='<div id="donate_paypal" class="donate">
	<div id="paypal_logo" class="donate_logo"></div>';
		if(isset($this->beforeform))
	$this->form .= $this->beforeform;	    
	$this->form .='<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="'.$this->email.'">
		<input type="hidden" name="item_name" value="'.$this->item.'">
		<input type="hidden" name="currency_code" value="'.$this->currency.'">';
	    if($this->userbid==null)
	    {
	$this->form .='<input type="hidden" name="amount" value="'.$this->amt.'">';
	    }else{
	$this->form .='<input type="text" name="amount" value="$'.$this->amt.'"><br><br>';
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
		<div id="alertpay_logo" class="donate_logo"></div>';
		if(isset($this->beforeform))
	$this->form .= $this->beforeform;
	$this->form .=	'<form method="post" action="https://www.alertpay.com/PayProcess.aspx" target="_blank" class="payment_form alertpay" >
		<input type="hidden" name="ap_purchasetype" value="item"/>
		<input type="hidden" name="ap_merchant" value="'.$this->email.'"/>
		<input type="hidden" name="ap_itemname" value="'. $this->item .'"/>
		<input type="hidden" name="ap_itemcode" value="'. $ithis->item_code .'"/> 
		<input type="hidden" name="ap_quantity" value="'.$this->quantity.'"/>
		<input type="hidden" name="ap_returnurl" value=""/>';
		 if($this->userbid==null)
		{
		$this->form .='<input type="hidden" name="ap_currency" value="'. $this->currency.'"/><label>'. $this->currency .'<input type="text" name="'.$this->amt.'" value="'.$this->amt.'" size="3" /></label>';
		}else{
		$this->form .='<input name="ap_currency" value="'. $this->currency.'"/><label>'. $this->currency .'<input type="text" name="'.$this->amt.'" value="'.$this->amt.'" size="3" /></label>><br><br>';

		}
		$this->form .='<br/>
		<input type="image" name="ap_image" src="'.$this->assets.'/button_alertpay.png" width="90" height="60" alt="Donate with AlertPay" style="border: none; background: none;" />
		</form>
		</div>';
    }
    
    protected function moneybookers()
    {
	$this->form='
		<div id="donate_moneybookers" class="donate">
		<div id="moneybookers_logo" class="donate_logo"></div>';
		if(isset($this->beforeform))
	$this->form .= $this->beforeform;
	$this->form .=	'<form action="https://www.moneybookers.com/app/payment.pl" method="post" target="_blank" class="payment_form moneybookers" >
		<input type="hidden" name="pay_to_email" value="'. $this->email.'" />
		<input type="hidden" name="language" value="'.$this->language.'" />
		<input type="hidden" name="rid" value="'.$this->rid.'" />
		<label>'.$this->currency.' <input type="text" name="amount" value="'. $this->amt.'" size="3" /></label><br/>
		<input type="hidden" name="currency" value="'. $this->currency .'" />
		<input type="hidden" name="detail1_description" value="'.$this->item_code .'" />
		<input type="hidden" name="detail1_text" value="'.$this->item .'" />
		<input type="image" src="'.$this->assets.'/button_moneybookers.gif" width="90" height="60" border="0" name="submit" alt="Donate with Moneybookers" style="border: none; background: none;" />
		</form>
		</div>';
    }
}
