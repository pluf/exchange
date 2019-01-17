<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Exchange_Shortcuts_NormalizeItemPerPage');

class Exchange_Views_Comment extends Pluf_Views
{

    public function find($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Offer', $match['parentId']);
        if (!self::canAccessOffer($request, $parent)) {
            throw new Pluf_Exception_PermissionDenied("Permission is denied");
        }
        $pag = $this->findManyToOne($request, $match, array(
            'model' => 'Exchange_Comment',
            'parent' => 'Exchange_Offer',
            'parentKey' => 'offer_id'
        ));
        return $pag;
    }

    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @throws Pluf_Exception
     * @return Pluf_HTTP_Response_Json
     */
    public function create($request, $match)
    {
        $object = $this->createManyToOne($request, $match, array(
            'model' => 'Exchange_Comment',
            'parent' => 'Exchange_Offer',
            'parentKey' => 'offer_id'
        ));
        $object->author_id = $request->user;
        $object->file_path = Pluf::f('upload_path') . '/' . $request->tenant->id . '/exchange-offer-comment';
        if (! is_dir($object->file_path)) {
            if (false == @mkdir($object->file_path, 0777, true)) {
                throw new Pluf_Form_Invalid('An error occured when creating the upload path. Please try to send the file again.');
            }
        }
        $extra = array(
            'model' => $object
        );
        $form = new Exchange_Form_CommentUpdate(array_merge($request->REQUEST, $request->FILES), $extra);
        $object->update();
        return $form->save();
    }

    public function get($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Offer', $match['parentId']);
        $comment = Pluf_Shortcuts_GetObjectOr404('Exchange_Comment', $match['modelId']);
        if ($comment->offer_id !== $parent->id) {
            throw new Pluf_HTTP_Error404('The Offer has no such Comment.');
        }
        if (self::canAccess($request, $comment))
            return $comment;
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @throws Pluf_Exception_PermissionDenied
     * @return Pluf_HTTP_Response_Json
     */
    public function update($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Offer', $match['parentId']);
        $comment = Pluf_Shortcuts_GetObjectOr404('Exchange_Comment', $match['modelId']);
        if ($comment->offer_id !== $parent->id) {
            throw new Pluf_HTTP_Error404('The Offer has no such Comment.');
        }
        if ($comment->author_id === $request->user->id) {
            $form = Pluf_Shortcuts_GetFormForUpdateModel($comment, $request->REQUEST);
            $updatedComment = $form->save();
            return $updatedComment;
        }
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    public function delete($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Offer', $match['parentId']);
        $comment = Pluf_Shortcuts_GetObjectOr404('Exchange_Comment', $match['modelId']);
        if ($comment->offer_id !== $parent->id) {
            throw new Pluf_HTTP_Error404('The Offer has no such Comment.');
        }
        if ($request->user->id === $comment->author_id) {
            $comment->delete();
            return $comment;
        }
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    /**
     * Checks if user sending request has access to given Exchange_Comment object
     * returns true if current user is offere of the offer which comment is on it
     * or advertiser of the advertisement which related offer of the comment is on it.
     *
     * @param Pluf_HTTP_Request $request
     * @param Exchange_Comment $comment
     * @return boolean
     */
    private static function canAccess($request, $comment)
    {
        if (User_Precondition::isOwner($request)) {
            return true;
        }
        $user = $request->user;
        $advertiserId = $comment->get_offer()->get_advertisement()->advertiser_id;
        $offererId = $comment->get_offer()->offerer_id;
        // returns true if current user is advertiser of advertisement of offer of comment or offerer of offer of the comment
        return (isset($user) && ($user->getId() === $advertiserId || $user->getId() === $offererId));
    }
    
    /**
     * Checks if user sending request has access to given Exchange_Offer object.
     * returns true if current user is offerer of the offer or advertiser of the advertisement of the offer.
     *
     * @param Pluf_HTTP_Request $request
     * @param Exchange_Offer $offer
     * @return boolean
     */
    private static function canAccessOffer($request, $offer)
    {
        if (User_Precondition::isOwner($request)) {
            return true;
        }
        $user = $request->user;
        $advertiserId = $offer->get_advertisement()->advertiser_id;
        $offererId = $offer->offerer_id;
        // returns true if current user is advertiser of advertisement of offer or offerer of offer
        return (isset($user) && ($user->getId() === $advertiserId || $user->getId() === $offererId));
    }

    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Pluf_HTTP_Response_File
     */
    public function download($request, $match)
    {
        // GET data
        if (!array_key_exists('modelId', $match)) {
            throw new Pluf_Exception_BadRequest('id of comment is not determined');
        }
        Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
        $comment = Pluf_Shortcuts_GetObjectOr404('Exchange_Comment', $match['modelId']);
        $offer = Pluf_Shortcuts_GetObjectOr404('Exchange_Offer', $match['offerId']);
        if($offer->id != $comment->get_offer()->id){
            throw new Pluf_Exception_DoesNotExist('the given comment is not blong to the given order');
        }
        $response = new Pluf_HTTP_Response_File($comment->getAbsloutPath(), $comment->mime_type);
        $response->headers['Content-Disposition'] = sprintf('attachment; filename="%s"', $comment->file_name);
        return $response;
    }

    /**
     * Upload a file as comment
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return object
     */
    public function updateFile($request, $match)
    {
        // TODO: hadi 1397-10-25: prevent update file if comment has file already.
        $content = Pluf_Shortcuts_GetObjectOr404('Exchange_Comment', $match['modelId']);
        if (array_key_exists('file', $request->FILES)) {
            return $this->upload($request, $match);
        } else {
            // Do
            $myfile = fopen($content->getAbsloutPath(), "w") or die("Unable to open file!");
            $entityBody = file_get_contents('php://input', 'r');
            fwrite($myfile, $entityBody);
            fclose($myfile);
            $content->update();
        }
        return $content;
    }
    
    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Exchange_Comment
     */
    public static function upload($request, $match)
    {
        // تعیین داده‌ها
        $comment = Pluf_Shortcuts_GetObjectOr404('Exchange_Comment', $match['modelId']);
        // اجرای درخواست
        $extra = array(
            'model' => $comment
        );
        $form = new Exchange_Form_CommentUpdate(array_merge($request->REQUEST, $request->FILES), $extra);
        return $form->save();
    }
    
}