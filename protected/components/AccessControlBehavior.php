<?php
/**
 * Created by PhpStorm.
 * User: september
 * Date: 5/3/15
 * Time: 1:01 AM
 */

class ApplicationBehavior extends CBehavior {
    private $_owner;

    public function events()
    {
        return array(
            'onBeginRequest' => 'handleBeginRequest'
        );
    }

    public function handleBeginRequest()
    {
        $owner = $this->getOwner();

        if($owner->user->isGuest) {
            $owner->catchAllRequest = array("site/login");
        }
    }
}