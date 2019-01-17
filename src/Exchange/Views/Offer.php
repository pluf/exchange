<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');

class Exchange_Views_Offer
{

    /**
     * Creates and adds new offer to a advertisement
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @param array $p
     */
    public function addOffer($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Advertisement', $match['parentId']);
        if($parent->advertiser_id === $request->user->id){
            // throw bad request exception because advertiser could not add offer on his own advertisement
        }
        $object = new Exchange_Offer();
        $form = Pluf_Shortcuts_GetFormForModel($object, $request->REQUEST);
        $object = $form->save(false);
        $object->advertisement_id = $parent;
        $object->offerer_id = $request->user;
        $object->create();
        return $object;
    }
}