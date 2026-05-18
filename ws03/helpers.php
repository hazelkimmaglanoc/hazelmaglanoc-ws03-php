<?php

/**
 * Get the base path
 *
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * Load a view
 *
 * @param string $name
 * @param array  $data
 * @return void
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "View '{$name}' not found.";
    }
}

/**
 * Load a partial
 *
 * @param string $name
 * @return void
 */
function loadPartial($name, $data = [])
{
    $partialPath = basePath("App/views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        extract($data);
        require $partialPath;
    } else {
        echo "Partial '{$name}' not found.";
    }
}

/**
 * Format a salary value as Philippine Peso
 *
 * @param mixed $salary
 * @return string
 */
function formatSalary($salary)
{
    return '₱' . number_format(floatval($salary));
}

/**
 * Set a one-time flash message in the session
 *
 * @param string $type    'success' | 'error' | 'warning'
 * @param string $message
 * @return void
 */
function setFlashMessage($type, $message): void
{
    \Framework\Session::setFlash($type, $message);
}

/**
 * Get and clear the flash message from the session
 *
 * @return array|null
 */
function getFlashMessage(): ?array
{
    return \Framework\Session::getFlash();
}
function inspectAndDie($value)
{
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
}

/**
 * Redirect to a URL and exit
 */
function redirect($url): void
{
    header('Location: ' . $url);
    exit;
}

/**
 * Check if a user is currently logged in
 */
function isAuthenticated(): bool
{
    return \Framework\Session::has('user');
}

/**
 * Redirect to login if not authenticated (uses Authorize middleware)
 */
function requireAuth(): void
{
    $authorize = new \Framework\Middleware\Authorize();
    $authorize->handle('auth');
}

/**
 * Get the current logged-in user from session
 */
function currentUser(): ?array
{
    return \Framework\Session::get('user');
}
