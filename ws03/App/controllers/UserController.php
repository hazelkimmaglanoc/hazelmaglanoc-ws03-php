<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;

class UserController
{
    protected Database $db;

    public function __construct()
    {
        $config   = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show registration form (GET /auth/register)
     */
    public function create()
    {

        loadView('users/create', [
            'errors' => [],
            'fields' => [],
        ]);
    }

    /**
     * Handle registration submission (POST /auth/register)
     */
    public function store()
    {
        $fields = [
            'name'             => trim($_POST['name']             ?? ''),
            'email'            => trim($_POST['email']            ?? ''),
            'city'             => trim($_POST['city']             ?? ''),
            'state'            => trim($_POST['state']            ?? ''),
            'password'         => $_POST['password']              ?? '',
            'password_confirm' => $_POST['password_confirm']      ?? '',
        ];

        $errors = [];

        // Validate
        if (!Validation::string($fields['name'], 2, 100)) {
            $errors['name'] = 'Full name is required (2–100 characters).';
        }
        if (!Validation::email($fields['email'])) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        if (!Validation::string($fields['password'], 6, 100)) {
            $errors['password'] = 'Password must be at least 6 characters.';
        }
        if ($fields['password'] !== $fields['password_confirm']) {
            $errors['password_confirm'] = 'Passwords do not match.';
        }

        // Check if email already exists
        if (empty($errors['email'])) {
            $existing = $this->db->query(
                'SELECT id FROM users WHERE email = :email',
                ['email' => $fields['email']]
            )->fetch();

            if ($existing) {
                $errors['email'] = 'An account with this email already exists.';
            }
        }

        if (!empty($errors)) {
            loadView('users/create', [
                'errors' => $errors,
                'fields' => $fields,
            ]);
            return;
        }

        // Save user
        $this->db->query(
            'INSERT INTO users (name, email, password, city, state)
             VALUES (:name, :email, :password, :city, :state)',
            [
                'name'     => htmlspecialchars($fields['name']),
                'email'    => htmlspecialchars($fields['email']),
                'password' => password_hash($fields['password'], PASSWORD_DEFAULT),
                'city'     => htmlspecialchars($fields['city']),
                'state'    => htmlspecialchars($fields['state']),
            ]
        );

        // Auto-login after register
        $user = $this->db->query(
            'SELECT * FROM users WHERE email = :email',
            ['email' => $fields['email']]
        )->fetch();

        Session::set('user', [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
        ]);

        Session::setFlash('success', 'Welcome, ' . htmlspecialchars($user->name) . '! Your account has been created.');
        header('Location: ' . BASE_URL . 'listings');
        exit;
    }

    /**
     * Show login form (GET /auth/login)
     */
    public function login()
    {

        loadView('users/login', [
            'errors' => [],
            'fields' => [],
        ]);
    }

    /**
     * Handle login submission (POST /auth/login)
     */
    public function authenticate()
    {
        $fields = [
            'email'    => trim($_POST['email']    ?? ''),
            'password' => $_POST['password']       ?? '',
        ];

        $errors = [];

        if (!Validation::email($fields['email'])) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        if (!Validation::string($fields['password'], 1)) {
            $errors['password'] = 'Password is required.';
        }

        if (!empty($errors)) {
            loadView('users/login', [
                'errors' => $errors,
                'fields' => $fields,
            ]);
            return;
        }

        // Find user
        $user = $this->db->query(
            'SELECT * FROM users WHERE email = :email',
            ['email' => $fields['email']]
        )->fetch();

        if (!$user) {
            loadView('users/login', [
                'errors' => ['email' => 'No account found with that email address.'],
                'fields' => $fields,
            ]);
            return;
        }

        // Verify password (supports both hashed and plain-text legacy passwords)
        $valid = password_verify($fields['password'], $user->password)
            || $fields['password'] === $user->password;

        if (!$valid) {
            loadView('users/login', [
                'errors' => ['password' => 'Incorrect password.'],
                'fields' => $fields,
            ]);
            return;
        }

        // Set session
        Session::set('user', [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
        ]);

        Session::setFlash('success', 'Welcome back, ' . htmlspecialchars($user->name) . '!');
        header('Location: ' . BASE_URL . '');
        exit;
    }

    /**
     * Logout (GET /auth/logout)
     */
    public function logout()
    {
        Session::clearAll();
        header('Location: ' . BASE_URL . 'auth/login');
        exit;
    }
}
