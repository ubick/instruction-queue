<?php

/*
 * (c) Liviu Panainte <liviu.panainte@gmail.com>
 */

use Queue\Message;
use Queue\InstructionQueue;

class Application {

    public function run() {
        $queue = new InstructionQueue();
        $msg1 = new Message(55, 12355, 22, 125, time());
        $msg2 = new Message(5, 12355, 22, 125, time());
        $msg3 = new Message(23, 12355, 22, 125, time());
        $msg4 = new Message(99, 12355, 22, 125, time());

        $queue->addMessage($msg1);
        $queue->addMessage($msg2);
        $queue->addMessage($msg3);
        $queue->addMessage($msg4);

        echo "\nTotal messages: ", $queue->countMessages();
        echo "\n\nDeleting message...";
        echo $msg4;
        
        $queue->removeMessage($msg4);

        echo "\nTotal messages: ", $queue->countMessages();
        
        echo "\n\nShowing last message...";
        echo $queue->pop();
    }

}
