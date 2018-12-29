<?php

class Exchange_OfferMetadata extends Pluf_Model
{

    /**
     *
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'exchange_offermetadata';
        $this->_a['verbose'] = 'Exchange_OfferMetadata';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'key' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'is_null' => false,
                'size' => 1024,
                'editable' => true,
                'readable' => true
            ),
            'value' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'is_null' => false,
                'size' => 1024,
                'editable' => true,
                'readable' => true
            ),
            // relations
            'sender_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'User_Account',
                'blank' => false,
                'is_null' => false,
                'name' => 'sender',
                'relate_name' => 'sent_comments',
                'graphql_name' => 'sender',
                'editable' => false,
                'readable' => true
            ),
            'receiver_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'User_Account',
                'blank' => false,
                'is_null' => false,
                'name' => 'receiver',
                'relate_name' => 'received_comments',
                'graphql_name' => 'receiver',
                'editable' => true,
                'readable' => true
            ),
            'advertisement_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Exchange_Advertisement',
                'blank' => false,
                'is_null' => false,
                'name' => 'advertisement',
                'relate_name' => 'comments',
                'graphql_name' => 'advertisement',
                'editable' => false,
                'readable' => true
            )
        );
    }

}
