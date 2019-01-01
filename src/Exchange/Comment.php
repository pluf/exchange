<?php

class Exchange_Comment extends Pluf_Model
{

    /**
     *
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'exchange_comments';
        $this->_a['verbose'] = 'Exchange_Comments';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'message' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 1024,
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
            /*
             * Binary Model Feilds
             */
            'mime_type' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 64,
                'default' => 'application/octet-stream',
                'verbose' => 'mime type',
                'help_text' => 'content mime type',
                'editable' => true
            ),
            'media_type' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 64,
                'default' => 'application/octet-stream',
                'editable' => true
            ),
            'file_path' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 250,
                'editable' => false,
                'readable' => false
            ),
            'file_name' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 250,
                'default' => 'unknown',
                'editable' => false
            ),
            'file_size' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'default' => 'no title',
                'editable' => false
            ),
            /*
             * Relations
             */
            'parent_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Exchange_Comment',
                'blank' => true,
                'is_null' => true,
                'name' => 'parent',
                'relate_name' => 'child_comments',
                'graphql_name' => 'parent',
                'editable' => true,
                'readable' => true
            ),
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
            'offer_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Exchange_Offer',
                'blank' => false,
                'is_null' => false,
                'name' => 'offer',
                'relate_name' => 'comments',
                'graphql_name' => 'offer',
                'editable' => false,
                'readable' => true
            )
        );

        // $this->_a['idx'] = array(
        // 'content_mime_filter_idx' => array(
        // 'col' => 'mime_type',
        // 'type' => 'normal', // normal, unique, fulltext, spatial
        // 'index_type' => '', // hash, btree
        // 'index_option' => '',
        // 'algorithm_option' => '',
        // 'lock_option' => ''
        // )
        // );
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
        // File path
        $path = $this->getAbsloutPath();
        // file size
        if (file_exists($path)) {
            $this->file_size = filesize($path);
        } else {
            $this->file_size = 0;
        }
        // mime type (based on file name)
        $mime_type = $this->mime_type;
        if (! isset($mime_type) || $mime_type === 'application/octet-stream') {
            $fileInfo = Pluf_FileUtil::getMimeType($this->file_name);
            $this->mime_type = $fileInfo[0];
        }
    }

    /**
     * \brief عملیاتی که قبل از پاک شدن است انجام می‌شود
     *
     * عملیاتی که قبل از پاک شدن است انجام می‌شود
     * در این متد فایل مربوط به است حذف می شود. این عملیات قابل بازگشت نیست
     */
    function preDelete()
    {
        // remove related file
        $filename = $this->file_path . '/' . $this->id;
        if (is_file($filename)) {
            unlink($filename);
        }
    }
    
    /**
     * مسیر کامل محتوی را تعیین می‌کند.
     *
     * @return string
     */
    public function getAbsloutPath()
    {
        return $this->file_path . '/' . $this->id;
    }
}
