<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\XservUsuario;
use Authorization\IdentityInterface;

class XservUsuarioPolicy
{
    /**
     * Determina si el usuario puede ver su propio perfil
     */
    public function canView(IdentityInterface $user, XservUsuario $usuarioAVer): bool
    {
        // El usuario puede ver su propio perfil
        if ($user->get('id') === $usuarioAVer->id) {
            return true;
        }
        
        // Los admins pueden ver cualquier perfil
        return $user->get('rol') === 'admin';
    }

    /**
     * Determina si el usuario puede editar su propio perfil
     */
    public function canEdit(IdentityInterface $user, XservUsuario $usuarioAEditar): bool
    {
        // El usuario puede editar su propio perfil
        if ($user->get('id') === $usuarioAEditar->id) {
            return true;
        }
        
        // Los admins pueden editar cualquier perfil
        return $user->get('rol') === 'admin';
    }
}
