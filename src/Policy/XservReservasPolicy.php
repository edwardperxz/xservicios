<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;

class XservReservasPolicy
{
    /**
     * Default method for controller-level access
     */
    public function can(IdentityInterface $identity, string $action, $subject = null): bool
    {
        // Allow all authenticated users
        return (bool)$identity;
    }
    
    /**
     * Allow reservaRapida for authenticated users
     */
    public function canReservaRapida(?IdentityInterface $identity = null): bool
    {
        // Permitir a todos los usuarios autenticados
        return $identity !== null;
    }
    
    /**
     * Default method - allow access for authenticated users
     */
    public function canAccess(IdentityInterface $identity, $resource)
    {
        return (bool)$identity;
    }
    
    /**
     * Allow quick reservations for authenticated users
     */
    public function canQuickReserve(IdentityInterface $identity): bool
    {
        return (bool)$identity;
    }
    
    /**
     * Allow index for authenticated users
     */
    public function canIndex(IdentityInterface $identity): bool
    {
        return (bool)$identity;
    }
    
    /**
     * Allow view for authenticated users
     */
    public function canView(IdentityInterface $identity): bool
    {
        return (bool)$identity;
    }
}
