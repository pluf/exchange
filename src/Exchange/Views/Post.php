<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Exchange_Shortcuts_NormalizeItemPerPage');

class Exchange_Views_Post
{

    public static function find($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Trade', $match['parentId']);
        $post = new Exchange_Post();
        $pag = new Pluf_Paginator($post);
        if(User_Precondition::isOwner($request)){            
            $pag->forced_where = new Pluf_SQL('trade_id=%s', $parent->id);
        }else{
            $pag->forced_where = new Pluf_SQL('trade_id=%s AND (sender_id=%s OR receiver_id=%s)', array(
                $parent->id,
                $request->user->id,
                $request->user->id
            ));
        }
        $pag->list_filters = array(
            'id',
            'sender_id',
            'receiver_id',
            'trade_id'
        );
        $search_fields = array(
            'message'
        );
        $sort_fields = array(
            'id',
            'sender_id',
            'receiver_id',
            'trade_id',
            'creation_dtime',
            'modif_dtime'
        );
        $pag->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $pag->configure(array(), $search_fields, $sort_fields);
        $pag->setFromRequest($request);
        return $pag->render_object();
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
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Trade', $match['parentId']);
        $object = new Exchange_Post();
        $form = Pluf_Shortcuts_GetFormForModel($object, $request->REQUEST);
        $object = $form->save(false);
        $object->trade_id = $parent;
        $object->sender_id = $request->user;
        $object->create();
        return $object;
    }

    public static function get($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Trade', $match['parentId']);
        $post = Pluf_Shortcuts_GetObjectOr404('Exchange_Post', $match['modelId']);
        if($post->trade_id !== $parent->id){
            throw new Pluf_HTTP_Error404('The Trade has no such Post.');
        }
        if (self::canAccess($request, $post))
            return $post;
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
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Trade', $match['parentId']);
        $post = Pluf_Shortcuts_GetObjectOr404('Exchange_Post', $match['modelId']);
        if($post->trade_id !== $parent->id){
            throw new Pluf_HTTP_Error404('The Trade has no such Post.');
        }
        if (self::canAccess($request, $post)){
            $form = Pluf_Shortcuts_GetFormForUpdateModel($post, $request->REQUEST);
            $updatedPost = $form->save();
            return $updatedPost;
        }
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    public static function delete($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Trade', $match['parentId']);
        $post = Pluf_Shortcuts_GetObjectOr404('Exchange_Post', $match['modelId']);
        if($post->trade_id !== $parent->id){
            throw new Pluf_HTTP_Error404('The Trade has no such Post.');
        }
        if (!User_Precondition::isOwner($request) || 
            $request->user->id === $post->get_sender()->id){
            $post->delete();
            return $post;
        }
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    /**
     * Checks if user sending request has access to given Exchange_Post object
     * returns true if current user is sender or receiver of post
     * 
     * @param Pluf_HTTP_Request $request
     * @param Exchange_Post $post
     * @return boolean 
     */
    private static function canAccess($request, $post){
        if(User_Precondition::isOwner($request)){
            return true;
        }
        $user = $request->user;
        $sender = $post->get_sender();
        $receiver = $post->get_receiver();
        // returns true if current user is sender or receiver of post
        return (isset($user) && ($user->getId() === $sender->getId() || $user->getId() === $receiver->getId()));
    }
}