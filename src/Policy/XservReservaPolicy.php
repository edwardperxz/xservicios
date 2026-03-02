<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;

class XservReservaPolicy
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
     * Allow all actions for authenticated users by default
     */
    public function canAccess(IdentityInterface $identity, $resource)
    {
        return (bool)$identity;
    }
    
    /**
     * Check if the user can create a quick reservation
     */
    public function canQuickReserve(IdentityInterface $identity): bool
    {
        return (bool)$identity;
    }
}
