<?php

/**
 * مدل داده‌ای برای یک روز تقویمی
 * 
 * @author hadi
 *
 */
class Exchange_Day extends Pluf_Model
{

    /**
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'exchange_days';
        $this->_a['verbose'] = 'Exchange_Days';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'editable' => false,
                'readable' => true
            ),
            'date' => array(
                'type' => 'Pluf_DB_Field_Date',
                'is_null' => true,
                'unique' => true,
                'editable' => true,
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
        if ($this->id == '' && $this->date == '') {
            $this->date = gmdate('Y-m-d');
        }
    }
    
}
