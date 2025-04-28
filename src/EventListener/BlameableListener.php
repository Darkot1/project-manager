<?php

namespace App\EventListener;

use Gedmo\Blameable\BlameableListener as BaseBlameableListener;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class BlameableListener extends BaseBlameableListener
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        parent::__construct();
        $this->tokenStorage = $tokenStorage;
        $this->setUserValue($this->getUserValue());
    }

    /**
     * Obtiene el valor del usuario actual
     */
    public function getUserValue()
    {
        if (null === $this->tokenStorage) {
            return null;
        }

        $token = $this->tokenStorage->getToken();
        if (null === $token) {
            return null;
        }

        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return null;
        }

        // Puedes elegir qué valor quieres guardar del usuario (email, id, nombre, etc.)
        return $user->getUserIdentifier(); // o $user->getId() si prefieres guardar el ID
    }

    /**
     * Actualiza el usuario actual cuando cambia el token
     */
    public function updateUser()
    {
        $this->setUserValue($this->getUserValue());
    }
}