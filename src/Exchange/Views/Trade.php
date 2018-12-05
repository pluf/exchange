<?php
Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');

class Exchange_Views_Trade
{

    /**
     * Creates a new trade
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Pluf_HTTP_Response_Json
     */
    public static function create($request, $match)
    {
        $user = $request->user;
        if (isset($user)) {
            $request->REQUEST['trader'] = $user->id;
        }
        $form = Pluf_Shortcuts_GetFormForModel(Pluf::factory('Exchange_Trade'), $request->REQUEST);
        /**
         *
         * @var Exchange_Trade $trade
         */
        $trade = $form->save();
//         if (isset($user)) {
//             $trade->__set('trader', $user);
//         }
//         $trade->update();
//         $manager = $trade->getManager();
//         $manager->apply($trade, 'create');
//         return array_merge($trade->jsonSerialize(), array(
//             'secureId' => $trade->secureId
//         ));
        return $trade;
    }
}
