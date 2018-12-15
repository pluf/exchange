<?php

class Exchange_Trade extends Pluf_Model
{

    /**
     *
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'exchange_trades';
        $this->_a['verbose'] = 'Exchange_Trades';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'lower_limit' => array(
                'type' => 'Pluf_DB_Field_Float',
                'is_null' => false,
                'editable' => true,
                'readable' => true
            ),
            'upper_limit' => array(
                'type' => 'Pluf_DB_Field_Float',
                'is_null' => true,
                'editable' => true,
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
            'unit_price' => array(
                'type' => 'Pluf_DB_Field_Float',
                'blank' => true,
                'default' => 0,
                'editable' => true,
                'readable' => true
            ),
            'type' => array( // sell or buy
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => false,
                'size' => 64,
                'default' => 'sell',
                'editable' => false,
                'readable' => true
            ),
            'status' => array( // for example: deleted, closed, active and ... (may be used in workflow)
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => false,
                'default' => '',
                'size' => 128,
                'editable' => false,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 512,
                'editable' => true,
                'readable' => true
            ),
            'creation_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            'modif_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            // relations
            'trader' => array( // seller or buyer
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'User_Account',
                'blank' => false,
                'is_null' => false,
                'relate_name' => 'seller',
                'editable' => true,
                'readable' => true
            )
        );
    }

    /**
     * \brief پیش ذخیره را انجام می‌دهد
     *
     * @param $create حالت
     *            ساخت یا به روز رسانی را تعیین می‌کند
     */
    function preSave($create = false)
    {
        if ($this->id == '') {
            $this->creation_dtime = gmdate('Y-m-d H:i:s');
            if ($this->type == '') { // Default value for type is sell
                $this->type = 'sell';
            }
        }
        $this->modif_dtime = gmdate('Y-m-d H:i:s');
    }
    
}
