<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

class XservUsuario extends Entity
{
    protected array $_accessible = [
        'username'   => true,
        'password'   => true,
        'rol'        => true,
        'estado'     => true,
        'created_at' => true,
        'updated_at' => true,
    ];

    protected array $_hidden = [
        'password',
    ];

    /**
     * Hash automático del password
     */
    protected function _setPassword(?string $password): ?string
    {
        if (strlen((string)$password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
        return null;
    }
}
