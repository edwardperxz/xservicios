<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

class XservUsuario extends Entity
{
    protected array $_accessible = [
        'name'     => true,
        'email'    => true,
        'password' => true,
        'rol'      => true,
        'activo'   => true,
        'created'  => true,
        'modified' => true,
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
