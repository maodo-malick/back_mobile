<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['EDIT', 'VIEW_ALL', 'VIEW','DEL','ADD'])
            && $subject instanceof \App\Entity\User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'ADD':
                // logic to determine if the user can EDIT
                // return true or false
                return $user->getRoles()[0] === "Role_Admin_System" || $user->getRoles()[0] === "Role_Admin_Agence";
                break;
            case 'VIEW':
                // logic to determine if the user can VIEW
                // return true or false
                return $user->getRoles()[0] === "Role_Admin_System" || $user->getRoles()[0] === "Role_Admin_Agence";
                break;
            case 'VIEW_ALL':
                return $user->getRoles()[0] === "Role_Admin_System";
            case 'DEL':
                return $user->getRoles()[0] === "Role_Admin_System";
                break;
            case 'EDIT':
                return $user->getRoles()[0] === "Role_Admin_System" || $user->getRoles()[0]=== "Role_Admin_Agence" ;
                break;
        }

        return false;
    }
}
