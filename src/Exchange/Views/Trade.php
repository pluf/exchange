<?php
Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');

class Exchange_Views_Advertisement
{

    /**
     * Creates a new advertisement
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Pluf_HTTP_Response_Json
     */
    public static function create($request, $match)
    {
        $user = $request->user;
        if (isset($user)) {
            $request->REQUEST['advertisementr'] = $user->id;
        }
        $form = Pluf_Shortcuts_GetFormForModel(Pluf::factory('Exchange_Advertisement'), $request->REQUEST);
        /**
         *
         * @var Exchange_Advertisement $advertisement
         */
        $advertisement = $form->save();
        if (isset($user)) {
            $advertisement->advertisementr_id = $user;
        }
        $advertisement->update();
//         $manager = $advertisement->getManager();
//         $manager->apply($advertisement, 'create');
//         return array_merge($advertisement->jsonSerialize(), array(
//             'secureId' => $advertisement->secureId
//         ));
        return $advertisement;
    }
}
