<?php

/*
 * (c) Liviu Panainte <liviu.panainte@gmail.com>
 */

namespace Queue;

use Exception\InvalidMessageException;

class InstructionQueue {

    private $messages = [];

    public function __construct() {
        $this->messages = [
            Priority::HIGH => [],
            Priority::MEDIUM => [],
            Priority::LOW => [],
        ];
    }

    public function addMessage(Message $message) {
        if (!$this->validateMessage($message)) {
            return false;
        }

        $priority = Priority::HIGH;
        $hash = spl_object_hash($message);

        if ($message->getInstructionType() > 90) {
            $priority = Priority::LOW;
        } else if ($message->getInstructionType() > 10) {
            $priority = Priority::MEDIUM;
        }

        $this->messages[$priority][$hash] = $message;
    }

    public function validateMessage($message) {
        $it = $message->getInstructionType();
        $pc = $message->getProductCode();
        $q = $message->getQuantity();
        $uom = $message->getUOM();
        $ts = $message->getTimeStamp();

        if (!is_int($it) || $it <= 0 || $it >= 100) {
            throw new InvalidMessageException("Instruction type must be an int between 1 and 99.");
        }

        if (!is_int($pc) || $pc < 0) {
            throw new InvalidMessageException("Product code must be an int greater than 0.");
        }

        if (!is_int($q) || $q < 0) {
            throw new InvalidMessageException("Quantity must be an int greater than 0.");
        }

        if (!is_int($uom) || $uom < 0 || $uom > 255) {
            throw new InvalidMessageException("Instruction type must be an int between 0 and 255.");
        }

        if (!is_int($ts) || $ts < 0) {
            throw new InvalidMessageException("Timestamp must be an int greater than 0.");
        }

        return true;
    }

    public function countMessages() {
        $total = 0;

        foreach ($this->messages as $msgs) {
            $total += count($msgs);

        }

        return $total;
    }

    public function removeMessage($message) {
        foreach ($this->messages as $priority => $msgs) {
            foreach ($msgs as $hash => $message) {
                if (spl_object_hash($message) === $hash) {
                    unset($this->messages[$priority][$hash]);
                    return;
                }
            }
        }
    }

    public function isEmpty() {
        return ($this->countMessages() === 0);
    }

    public function pop() {
        foreach ($this->messages as $msgs) {
            if (!empty($msgs)) {
                return end($msgs);
            }
        }
        
        return null;
    }

}
