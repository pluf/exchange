<?php

/**
 * ساختار تراکنش انجام شده روی تقاضاها را تعیین می‌کند.
 * 
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *
 */
class DigiDoci_RequestHistory extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'digidoci_requesthistory';
        $this->_a['verbose'] = 'DigiDoci Request History';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'object_type' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 100,
                'editable' => false,
                'readable' => true
            ),
            'object_id' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'action' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 100,
                'editable' => false,
                'readable' => true
            ),
            'subject_type' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 100,
                'editable' => false,
                'readable' => true
            ),
            'subject_id' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 250,
                'editable' => false,
                'readable' => true
            ),
            'creation_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
//             'modif_dtime' => array(
//                 'type' => 'Pluf_DB_Field_Datetime',
//                 'blank' => true,
//                 'editable' => false,
//                 'readable' => true
//             ),
            // relations
            'request' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'DigiDoci_Request',
                'blank' => false,
                'relate_name' => 'request_requesthistory',
                'editable' => false,
                'readable' => true
            )
        );
        
        $this->_a['idx'] = array(
            'requesthistory_idx' => array(
                'col' => 'request',
                'type' => 'normal', // normal, unique, fulltext, spatial
                'index_type' => '', // hash, btree
                'index_option' => '',
                'algorithm_option' => '',
                'lock_option' => ''
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
        // Note: Hadi 1396-04-31: Column modif_dtime is removed so following code should be removed too.
//         $this->modif_dtime = gmdate('Y-m-d H:i:s');
    }

    /**
     * حالت کار ایجاد شده را به روز می‌کند
     *
     * @see Pluf_Model::postSave()
     */
    function postSave($create = false)
    {
        //
    }
}