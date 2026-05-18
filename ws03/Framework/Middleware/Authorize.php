<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize
{
    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return Session::has('user');
    }

    /**
     * Handle the user's request based on role
     *
     * @param string $role
     * @return bool
     */
    public function handle($role): bool
    {
        if ($role === 'guest' && $this->isAuthenticated()) {
            // Logged-in users should not access guest-only pages (login, register)
            header('Location: ' . BASE_URL . 'listings');
            exit;
        }

        if ($role === 'auth' && !$this->isAuthenticated()) {
            // Unauthenticated users cannot access protected pages
            Session::setFlash('error', 'You must be logged in to do that.');
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        return true;
    }
}
