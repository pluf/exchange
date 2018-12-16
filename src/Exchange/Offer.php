<?php

class Exchange_Offer extends Pluf_Model
{

    /**
     *
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'exchange_offers';
        $this->_a['verbose'] = 'Exchange_Offers';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'amount' => array(
                'type' => 'Pluf_DB_Field_Float',
                'blank' => false,
                'is_null' => false,
                'default' => 0,
                'editable' => true,
                'readable' => true
            ),
            'unit_price' => array(
                'type' => 'Pluf_DB_Field_Float',
                'blank' => false,
                'blank' => false,
                'default' => 0,
                'editable' => true,
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
            'offerer_id' => array( 
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'User_Account',
                'blank' => false,
                'is_null' => false,
                'name' => 'offerer',
                'relate_name' => 'offers',
                'graphql_name' => 'offerer',
                'editable' => false,
                'readable' => true
            ),
            'trade_id' => array( 
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Exchange_Trade',
                'blank' => false,
                'is_null' => false,
                'name' => 'trade',
                'relate_name' => 'offers',
                'graphql_name' => 'trade',
                'editable' => false,
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
        }
        $this->modif_dtime = gmdate('Y-m-d H:i:s');
    }
    
}
