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

    public function form($settings)
    {
        $form = '<label>Display messages in list:  <input name="messageList" type="checkbox" ';
        if  ($this->displayAsList($settings)) {
          $form .= 'checked="checked"';
        }
        $form .= '></label><small class="form-help">If checked will display the messages in a long list. <br>
          <strong>Warning:</strong> Might overflow the visable area</small>';
        return $form;
    }

    public function view($settings, Screen $screen)
    {
        $messages = MessageQuery::create()->filterByScreen($screen)->filterCurrent()->find();

        if  ($this->displayAsList($settings)) {
          $parentDivClass = '';
          $messagesData = '';
          $messageClass = 'hero-unit';

        } else {
          $parentDivClass = 'hero-unit';
          $messagesData = 'data-cycle-slides="> div.message" data-cycle-timeout="6000" data-cycle-auto-height=container';
          $messageClass = 'message';
        }

        $view = '<div class="' . $parentDivClass . '">';

        if ($messages->count() > 0 ) {
            $view .= '<div id="messages" ' . $messagesData . '>';
            foreach ($messages as $message) {
                $view .= '<div class="' . $messageClass . '"><h1>' . $message->getTitle() . ' <small>' . $message->getAuthor() . '</small></h1>';
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

    protected function displayAsList($settings) {
      return (isset($settings['messageList']) && $settings['messageList'] == 'on');

    }
} 
