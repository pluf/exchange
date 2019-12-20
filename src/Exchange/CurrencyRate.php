<?php

/**
 * مدل داده‌ای به عنوان مرجع برای نرخ تبدیل ارزها
 * 
 * @author hadi
 *
 */
class Exchange_CurrencyRate extends Pluf_Model
{

    /**
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'exchange_currency_rates';
        $this->_a['verbose'] = 'Exchange_CurrencyRate';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'editable' => false,
                'readable' => true
            ),
            'source_currency' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => false,
                'size' => 64,
                'editable' => true,
                'readable' => true
            ),
            'dest_currency' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => false,
                'size' => 64,
                'editable' => true,
                'readable' => true
            ),
            'rate' => array(
                'type' => 'Pluf_DB_Field_Float',
                'is_null' => false,
                'default' => 1.0,
                'editable' => true,
                'readable' => true
            ),
            'modif_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            // relations
        );
    }

    /**
     * @param $create حالت
     *            ساخت یا به روز رسانی را تعیین می‌کند
     */
    function preSave($create = false)
    {
        $this->modif_dtime = gmdate('Y-m-d H:i:s');
    }
    
}
