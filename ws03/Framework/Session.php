<?php

namespace Framework;

class Session
{
    /**
     * Start a session
     *
     * @return void
     */
    public static function start(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set a session key/value
     *
     * @param string $key
     * @param mixed  $value
     * @return void
     */
    public static function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get a session value by key
     *
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * Check if session key exists
     *
     * @param string $key
     * @return bool
     */
    public static function has($key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Clear session by key
     *
     * @param string $key
     * @return void
     */
    public static function clear($key): void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Clear all session data and expire the session cookie
     *
     * @return void
     */
    public static function clearAll(): void
    {
        session_unset();

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }

    /**
     * Set a one-time flash message
     *
     * @param string $type    'success' | 'error' | 'warning'
     * @param string $message
     * @return void
     */
    public static function setFlash($type, $message): void
    {
        self::set('flash_message', ['type' => $type, 'message' => $message]);
    }

    /**
     * Get and immediately clear the flash message
     *
     * @return array|null
     */
    public static function getFlash(): ?array
    {
        if (self::has('flash_message')) {
            $flash = self::get('flash_message');
            self::clear('flash_message');
            return $flash;
        }
        return null;
    }
}
