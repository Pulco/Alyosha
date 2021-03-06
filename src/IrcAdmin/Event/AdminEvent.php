<?php

namespace Alyosha\IrcAdmin\Event;

use Alyosha\IRC\Event\IrcEvent;
use Alyosha\IrcAdmin\IrcAdminModule;

class AdminEvent extends IrcEvent
{
    /**
     * @return string
     */
    public function getName()
    {
        return IrcAdminModule::NAME.'.admin.'.$this->name;
    }
}
