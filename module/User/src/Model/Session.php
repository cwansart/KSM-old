<?php
namespace User\Model;

use DomainException;
use Zend\InputFilter\InputFilterInterface;

class Session
{
    public $userId;
    public $sessionId;
    public $created_at;

    public function exchangeArray(array $data)
    {
        $this->userId = !empty($data['user_id']) ? $data['user_id'] : null;
        $this->sessionId = !empty($data['session_id']) ? $data['session_id'] : null;
        $this->created_at = !empty($data['created_at']) ? $data['created_at'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(__CLASS__ . ' does not support changing the input filter.');
    }

    public function getArrayCopy()
    {
        return [
            'user_id' => $this->userId,
            'session_id' => $this->sessionId,
            'created_at' => $this->created_at,
        ];
    }

}
