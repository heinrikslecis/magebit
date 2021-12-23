<?php

namespace App\Models;

use App\Libraries\Database;

class Email {
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }

    // Register User
    public function subscribe($data) {
        $this->db->query('INSERT INTO emails (email) VALUES (:email)');
        // Bind values
        $this->db->bind(':email', $data['email']);

        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Gets all emails from database
    public function getEmails() {
        $this->db->query('SELECT * FROM emails ORDER BY created_at DESC');
    
        $results = $this->db->resultSet();

        return $results;
    }

    // Gets all emails by id from database
    public function getEmailById($id) {
        $this->db->query('SELECT * FROM emails WHERE id = :id ORDER BY created_at DESC');
        // Bind value
        $this->db->bind(':id', $id);
    
        $results = $this->db->single();

        return $results;
    }

    // Find email by email
    public function findByEmail($email) {
        $this->db->query('SELECT * FROM emails WHERE email = :email');
        // Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Find emails by search term
    public function searchEmails($keyword) {
        $this->db->query('SELECT * FROM emails WHERE email LIKE :keyword ');
        // Bind value
        $this->db->bind(':keyword', '%' . $keyword . '%');

        $results = $this->db->resultSet();

        return $results;
    }

    public function deleteEmail($id) {
        $this->db->query('DELETE FROM emails WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}