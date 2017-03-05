<?php
namespace User\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class SessionTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getSession(int $userId, string $sessionId)
    {
        $rowset = $this->tableGateway->select(['user_id' => $userId, 'session_id' => $sessionId]);
        $row = $rowset->current();

        return $row;
    }

    public function saveSession(Session $session)
    {
        $data = [
            'user_id' => $session->userId,
            'session_id' => $session->sessionId,
        ];

        return $this->tableGateway->insert($data);
    }

    public function deleteSession(int $userId, string $sessionId)
    {
        throw new RuntimeException('Not yet implemented.');
    }

}
