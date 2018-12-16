<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');

class Exchange_Views_Offer
{

    /**
     * Creates and adds new offer to a trade
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @param array $p
     */
    public function addOffer($request, $match)
    {
        $parent = Pluf_Shortcuts_GetObjectOr404('Exchange_Trade', $match['parentId']);
        $object = new Exchange_Offer();
        $form = Pluf_Shortcuts_GetFormForModel($object, $request->REQUEST);
        $object = $form->save(false);
        $object->trade_id = $parent;
        $object->offerer_id = $request->user;
        $object->create();
        return $object;
    }
}