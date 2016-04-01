<?php

class modulkonfirmasiDetailKonfirmasiModuleFrontController extends ModuleFrontController{
    public $auth = true;
    public $ssl = true;
	public $a;
    public function setMedia()
    {
        // We call the parent method
        parent::setMedia();
        $this->addCSS(array(
            _THEME_CSS_DIR_.'history.css',
            _THEME_CSS_DIR_.'addresses.css'
        ));
        $this->addJS(array(
            _THEME_JS_DIR_.'history.js',
            _THEME_JS_DIR_.'tools.js' // retro compat themes 1.5
        ));
        $this->addJQueryUI('ui.datepicker');
        $this->addJqueryPlugin(array('scrollTo', 'footable','footable-sort', 'validate'));
        // Save the module path in a variable
        $this->path = __PS_BASE_URI__.'modules/modulkonfirmasi/';
    }

    public function initContent(){
        $this->display_column_left = false;
        $this->display_column_right = false;
        parent::initContent();
        //$this->initList();
        //sumber dari modul mail alert
		$konfirmasis = konfirmasi::getKonfirmasi();
        $orders = Order::getCustomerOrders($this->context->customer->id);
        $this->context->smarty->assign(array(
            'orders' => $orders,
            'konfirmasis' => $konfirmasis,
            'invoiceAllowed' => (int)Configuration::get('PS_INVOICE'),
            'reorderingAllowed' => !(int)Configuration::get('PS_DISALLOW_HISTORY_REORDERING'),
            'slowValidation' => Tools::isSubmit('slowvalidation')
        ));
        $this->setTemplate('detailkonfirmasi.tpl');
    }

    public function postProcess(){
}