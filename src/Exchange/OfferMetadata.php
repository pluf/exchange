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
           /*
            * Relations
            */
            'offer_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Exchange_Offer',
                'blank' => false,
                'is_null' => false,
                'name' => 'offer',
                'relate_name' => 'metadata',
                'graphql_name' => 'offer',
                'editable' => false,
                'readable' => true
            )
        );
    }

}
