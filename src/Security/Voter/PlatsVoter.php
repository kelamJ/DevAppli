<?php

namespace App\Security\Voter;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PlatsVoter extends Voter
{
    const EDIT = 'PLAT_EDIT';
    const DELETE = 'PLAT_DELEte';

    private $security;

    public function __construct(Security $security)
    {
        $this->security
    }
}