<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 08/08/14
 * Time: 14:10
 */

class MessageWidget extends AbstractWidget {

    public function __construct()
    {
        parent::__construct('Message','Display the messages for the screen');
    }

    public function view($settings, Screen $screen)
    {
        $view = '<div class="hero-unit">';
        $messages = MessageQuery::create()->filterByScreen($screen)->filterCurrent()->find();
        if ($messages->count() > 0 ) {
            $view .= '<div id="messages" data-cycle-slides="> div.message" data-cycle-timeout="6000" data-cycle-auto-height=container>';
            foreach ($messages as $message) {
                $view .= '<div class="message"><h1>' . $message->getTitle() . ' <small>' . $message->getAuthor() . '</small></h1>';
                $view .= '<p>' . $message->getMessage() . '</p>';
                $view .= '</div>';
            }
            $view .= '<div class="cycle-pager"></div><div id="progress"></div></div>';
        } else {
            $view .= '<h3 style="text-align: center;">No current messages</h3>';
        }
        $view .= '</div>';

        return $view;
    }

    public function scripts()
    {
        return array('jquery.cycle2.min.js','messages.js');
    }
} 