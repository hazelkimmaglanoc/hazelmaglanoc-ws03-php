<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class ListingController
{
    protected $db;

    public function __construct()
    {
        $config   = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Search listings by keywords and/or location
     */
    public function search()
    {
        // Sanitize inputs — strip tags + htmlspecialchars to block XSS
        $keywords = htmlspecialchars(strip_tags(trim($_GET['keywords'] ?? '')));
        $location = htmlspecialchars(strip_tags(trim($_GET['location'] ?? '')));

        $query  = 'SELECT * FROM listings WHERE (title LIKE :keywords OR description LIKE :keywords OR tags LIKE :keywords OR company LIKE :keywords)';
        $params = ['keywords' => '%' . $keywords . '%'];

        if (!empty($location)) {
            $query .= ' AND (city LIKE :location OR state LIKE :location)';
            $params['location'] = '%' . $location . '%';
        }

        $listings = $this->db->query($query, $params)->fetchAll();

        loadView('listings/index', [
            'listings' => $listings,
            'keywords' => $keywords,
            'location' => $location,
        ]);
    }

    /**
     * Show all listings
     */
    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC')->fetchAll();

        loadView('listings/index', [
            'listings' => $listings
        ]);
    }

    /**
     * Show the create listing form
     */
    public function create()
    {
        loadView('listings/create');
    }

    /**
     * Store a new listing (POST)
     */
    public function store()
    {

        $fields = [
            'user_id'      => currentUser()['id'],
            'title'        => trim($_POST['title']        ?? ''),
            'description'  => trim($_POST['description']  ?? ''),
            'salary'       => trim($_POST['salary']       ?? ''),
            'tags'         => trim($_POST['tags']         ?? ''),
            'company'      => trim($_POST['company']      ?? ''),
            'address'      => trim($_POST['address']      ?? ''),
            'city'         => trim($_POST['city']         ?? ''),
            'state'        => trim($_POST['state']        ?? ''),
            'phone'        => trim($_POST['phone']        ?? ''),
            'email'        => trim($_POST['email']        ?? ''),
            'requirements' => trim($_POST['requirements'] ?? ''),
            'benefits'     => trim($_POST['benefits']     ?? ''),
        ];

        // --- Validation ---
        $errors = [];

        if (!Validation::string($fields['title'], 2, 255)) {
            $errors['title'] = 'Job title is required (2–255 characters).';
        }
        if (!Validation::string($fields['description'], 10)) {
            $errors['description'] = 'Description is required (at least 10 characters).';
        }
        if (!Validation::string($fields['salary'], 1, 20)) {
            $errors['salary'] = 'Salary is required.';
        }
        if (!Validation::string($fields['company'], 2, 255)) {
            $errors['company'] = 'School / Institution name is required.';
        }
        if (!Validation::string($fields['city'], 2, 100)) {
            $errors['city'] = 'City is required.';
        }
        if (!Validation::string($fields['state'], 2, 100)) {
            $errors['state'] = 'Province / Region is required.';
        }
        if (!empty($fields['email']) && !Validation::email($fields['email'])) {
            $errors['email'] = 'Please enter a valid email address.';
        }

        // If errors exist, re-render the form with messages and old values
        if (!empty($errors)) {
            loadView('listings/create', [
                'errors' => $errors,
                'fields' => $fields,
            ]);
            return;
        }

        // Sanitise before saving
        foreach ($fields as $key => $value) {
            if ($key !== 'user_id') {
                $fields[$key] = htmlspecialchars($value);
            }
        }

        $this->db->query(
            'INSERT INTO listings
                (user_id, title, description, salary, tags, company, address, city, state, phone, email, requirements, benefits)
             VALUES
                (:user_id, :title, :description, :salary, :tags, :company, :address, :city, :state, :phone, :email, :requirements, :benefits)',
            $fields
        );

        \Framework\Session::setFlash('success', 'Job posted successfully!');
        header('Location: ' . BASE_URL . 'listings');
        exit;
    }

    /**
     * Show a single listing
     *
     * @param array $params
     */
    public function show($params)
    {
        $id     = $params['id'] ?? '';
        $params = ['id' => $id];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        loadView('listings/show', [
            'listing' => $listing
        ]);
    }

    /**
     * Show the edit form for a listing
     *
     * @param array $params
     */
    public function edit($params)
    {
        $id      = $params['id'] ?? '';
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        // Only the owner can edit
        (new \Framework\Middleware\Authorization())->handleOwner(
            $listing,
            'You are not authorized to edit this listing.'
        );

        loadView('listings/edit', [
            'listing' => $listing,
            'errors'  => [],
        ]);
    }

    /**
     * Update an existing listing (PUT)
     *
     * @param array $params
     */
    public function update($params)
    {
        $id      = $params['id'] ?? '';
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        // Only the owner can update
        (new \Framework\Middleware\Authorization())->handleOwner(
            $listing,
            'You are not authorized to update this listing.'
        );

        $fields = [
            'title'        => trim($_POST['title']        ?? ''),
            'description'  => trim($_POST['description']  ?? ''),
            'salary'       => trim($_POST['salary']       ?? ''),
            'tags'         => trim($_POST['tags']         ?? ''),
            'company'      => trim($_POST['company']      ?? ''),
            'address'      => trim($_POST['address']      ?? ''),
            'city'         => trim($_POST['city']         ?? ''),
            'state'        => trim($_POST['state']        ?? ''),
            'phone'        => trim($_POST['phone']        ?? ''),
            'email'        => trim($_POST['email']        ?? ''),
            'requirements' => trim($_POST['requirements'] ?? ''),
            'benefits'     => trim($_POST['benefits']     ?? ''),
        ];

        // --- Validation ---
        $errors = [];

        if (!Validation::string($fields['title'], 2, 255)) {
            $errors['title'] = 'Job title is required (2–255 characters).';
        }
        if (!Validation::string($fields['description'], 10)) {
            $errors['description'] = 'Description is required (at least 10 characters).';
        }
        if (!Validation::string($fields['salary'], 1, 20)) {
            $errors['salary'] = 'Salary is required.';
        }
        if (!Validation::string($fields['company'], 2, 255)) {
            $errors['company'] = 'School / Institution name is required.';
        }
        if (!Validation::string($fields['city'], 2, 100)) {
            $errors['city'] = 'City is required.';
        }
        if (!Validation::string($fields['state'], 2, 100)) {
            $errors['state'] = 'Province / Region is required.';
        }
        if (!empty($fields['email']) && !Validation::email($fields['email'])) {
            $errors['email'] = 'Please enter a valid email address.';
        }

        if (!empty($errors)) {
            loadView('listings/edit', [
                'listing' => $listing,
                'errors'  => $errors,
            ]);
            return;
        }

        // Sanitise before saving
        foreach ($fields as $key => $value) {
            $fields[$key] = htmlspecialchars($value);
        }

        $setClauses = implode(', ', array_map(fn($k) => "$k = :$k", array_keys($fields)));
        $fields['id'] = $id;

        $this->db->query("UPDATE listings SET $setClauses WHERE id = :id", $fields);

        \Framework\Session::setFlash('success', 'Listing updated successfully!');
        header('Location: ' . BASE_URL . 'listings/' . $id);
        exit;
    }

    /**
     * Delete a listing (DELETE)
     *
     * @param array $params
     */
    public function destroy($params)
    {
        $id      = $params['id'] ?? '';
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        // Only the owner can delete
        (new \Framework\Middleware\Authorization())->handleOwner(
            $listing,
            'You are not authorized to delete this listing.'
        );

        $this->db->query('DELETE FROM listings WHERE id = :id', ['id' => $id]);

        \Framework\Session::setFlash('success', 'Listing deleted successfully!');
        header('Location: ' . BASE_URL . 'listings');
        exit;
    }
}
