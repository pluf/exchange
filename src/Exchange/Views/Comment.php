<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Exchange_Shortcuts_NormalizeItemPerPage');

class Exchange_Views_Comment
{

    public static function find($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Offer', $match['parentId']);
        $comment = new Exchange_Comment();
        $pag = new Pluf_Paginator($comment);
        if(User_Precondition::isOwner($request)){            
            $pag->forced_where = new Pluf_SQL('offer_id=%s', $parent->id);
        }else{
            $pag->forced_where = new Pluf_SQL('offer_id=%s AND author_id=%s', array(
                $parent->id,
                $request->user->id
            ));
        }
        $pag->list_filters = array(
            'id',
            'author_id',
            'offer_id',
            'mime_type',
            'media_type'
        );
        $search_fields = array(
            'message'
        );
        $sort_fields = array(
            'id',
            'author_id',
            'offer_id',
            'creation_dtime',
            'modif_dtime',
            'mime_type',
            'media_type'
        );
        $pag->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $pag->configure(array(), $search_fields, $sort_fields);
        $pag->setFromRequest($request);
        return $pag;
    }

    /**
     * 
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @throws Pluf_Exception
     * @return Pluf_HTTP_Response_Json
     */
    public static function create($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Offer', $match['parentId']);
        $object = new Exchange_Comment();
        $form = Pluf_Shortcuts_GetFormForModel($object, $request->REQUEST);
        $object = $form->save(false);
        $object->offer_id = $parent;
        $object->author_id = $request->user;
        $object->create();
        return $object;
    }

    public static function get($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Offer', $match['parentId']);
        $comment = Pluf_Shortcuts_GetObjectOr404('Exchange_Comment', $match['modelId']);
        if($comment->offer_id !== $parent->id){
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
    public static function update($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Offer', $match['parentId']);
        $comment = Pluf_Shortcuts_GetObjectOr404('Exchange_Comment', $match['modelId']);
        if($comment->offer_id !== $parent->id){
            throw new Pluf_HTTP_Error404('The Offer has no such Comment.');
        }
        if (self::canAccess($request, $comment)){
            $form = Pluf_Shortcuts_GetFormForUpdateModel($comment, $request->REQUEST);
            $updatedComment = $form->save();
            return $updatedComment;
        }
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    public static function delete($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Offer', $match['parentId']);
        $comment = Pluf_Shortcuts_GetObjectOr404('Exchange_Comment', $match['modelId']);
        if($comment->offer_id !== $parent->id){
            throw new Pluf_HTTP_Error404('The Offer has no such Comment.');
        }
        if (!User_Precondition::isOwner($request) || 
            $request->user->id === $comment->get_author()->id){
            $comment->delete();
            return $comment;
        }
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    /**
     * Checks if user sending request has access to given Exchange_Comment object
     * returns true if current user is sender or receiver of comment
     * 
     * @param Pluf_HTTP_Request $request
     * @param Exchange_Comment $comment
     * @return boolean 
     */
    private static function canAccess($request, $comment){
        if(User_Precondition::isOwner($request)){
            return true;
        }
        $user = $request->user;
        $sender = $comment->get_sender();
        $receiver = $comment->get_receiver();
        // returns true if current user is sender or receiver of comment
        return (isset($user) && ($user->getId() === $sender->getId() || $user->getId() === $receiver->getId()));
    }
}