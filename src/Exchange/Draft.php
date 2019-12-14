<?php

/**
 * مدل داده‌ای برای حواله ارزی
 * 
 * @author hadi
 *
 */
class Exchange_Draft extends Pluf_Model
{

    /**
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'exchange_drafts';
        $this->_a['verbose'] = 'Exchange_Drafts';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'editable' => false,
                'readable' => true
            ),
            'reference_id' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => true,
                'size' => 64,
                'editable' => true,
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
                'is_null' => true,
                'size' => 16,
                'editable' => true,
                'readable' => true
            ),
            'rate' => array(
                'type' => 'Pluf_DB_Field_Float',
                'is_null' => true,
                'default' => 1.0,
                'editable' => false,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => true,
                'size' => 512,
                'editable' => true,
                'readable' => true
            ),
//             'due_date' => array(
//                 'type' => 'Pluf_DB_Field_Date',
//                 'is_null' => false,
//                 'editable' => false,
//                 'readable' => true
//             ),
//             'creation_dtime' => array(
//                 'type' => 'Pluf_DB_Field_Datetime',
//                 'blank' => true,
//                 'editable' => false,
//                 'readable' => true
//             ),
//             'modif_dtime' => array(
//                 'type' => 'Pluf_DB_Field_Datetime',
//                 'blank' => true,
//                 'editable' => false,
//                 'readable' => true
//             ),
            // relations
            'day_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Exchange_Day',
                'is_null' => false,
                'name' => 'day',
                'graphql_name' => 'day',
                'relate_name' => 'drafts',
                'editable' => false,
                'readable' => true
            )
        );
    }

//     /**
//      * @param $create حالت
//      *            ساخت یا به روز رسانی را تعیین می‌کند
//      */
//     function preSave($create = false)
//     {
//         if ($this->id == '') {
//             $this->creation_dtime = gmdate('Y-m-d H:i:s');
//         }
//         $this->modif_dtime = gmdate('Y-m-d H:i:s');
//     }
    
}
