<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorization
{
    /**
     * Check if the current user owns the given resource
     *
     * @param object $resource  Any object with a user_id property
     * @return bool
     */
    public function isOwner($resource): bool
    {
        $user = Session::get('user');

        if (!$user) {
            return false;
        }

        return (int)$resource->user_id === (int)$user['id'];
    }

    /**
     * Deny access if the current user is not the owner
     *
     * @param object $resource
     * @param string $message
     * @return void
     */
    public function handleOwner($resource, $message = 'You are not authorized to perform this action.'): void
    {
        if (!$this->isOwner($resource)) {
            Session::setFlash('error', $message);
            redirect(BASE_URL . 'listings/' . $resource->id);
        }
    }
}
