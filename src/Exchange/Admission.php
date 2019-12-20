<?php

/**
 * مدل داده‌ای برای حواله ارزی
 * 
 * @author hadi
 *
 */
class Exchange_Admission extends Pluf_Model
{

    /**
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'exchange_admissions';
        $this->_a['verbose'] = 'Exchange_Admissions';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'editable' => false,
                'readable' => true
            ),
            'amount' => array(
                'type' => 'Pluf_DB_Field_Float',
                'is_null' => false,
                'default' => 0,
                'editable' => true,
                'readable' => true
            ),
            'currency' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => false,
                'size' => 16,
                'editable' => true,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => true,
                'size' => 512,
                'editable' => true,
                'readable' => true
            ),
            // relations
            'day_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Exchange_Day',
                'is_null' => false,
                'name' => 'day',
                'graphql_name' => 'day',
                'relate_name' => 'admissions',
                'editable' => false,
                'readable' => true
            )
        );
    }

}
