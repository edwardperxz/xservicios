<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\XservValoracion;
use Authorization\IdentityInterface;

class XservValoracionPolicy
{
    public function canIndex(IdentityInterface $user, $resource): bool
    {
        return $this->isAdmin($user);
    }

    public function canView(IdentityInterface $user, XservValoracion $valoracion): bool
    {
        return $this->isAdmin($user);
    }

    public function canAdd(IdentityInterface $user, XservValoracion $valoracion): bool
    {
        return $this->isAdmin($user);
    }

    public function canEdit(IdentityInterface $user, XservValoracion $valoracion): bool
    {
        return $this->isAdmin($user);
    }

    public function canDelete(IdentityInterface $user, XservValoracion $valoracion): bool
    {
        return $this->isAdmin($user);
    }

    private function isAdmin(IdentityInterface $user): bool
    {
        return $user->get('rol') === 'admin';
    }
}
