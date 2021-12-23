<?php 

namespace App\Controllers;

use App\Libraries\Controller;

class EmailController extends Controller {
    public function __construct()
    {
        $this->emailModel = $this->model('Email');
    }

    // Index page
    public function index() {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),   
                'email_err' => '',
            ];

            // Validate Email
            if(empty($data['email'])) {
                $data['email_err'] = 'Email address is required';
            } else if (preg_match("/(\.co)$/", $data['email'])) {
                $data['email_err'] = 'We are not accepting subscriptions from Colombia
                emails';
            } else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Please provide a valid e-mail address';
            } else if (!filter_input(INPUT_POST, 'checkbox_name', FILTER_SANITIZE_STRING)) {
                $data['email_err'] = 'You must accept the terms and conditions';
            } else {
                if($this->emailModel->findByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already subscribed';
                }
            }

            // Make sure errors are empty
            if(empty($data['email_err'])) {
                // Validated
                
                // Subscribe User
                if($this->emailModel->subscribe($data)) {
                    header("location: " . URLROOT . '/subscribed');
                } else {
                    die('Something went wrong');
                }

            } else {
                // Load view with errors
                $this->view('pages/index', $data);
            }

        } else {
            // Init data
            $data = [
                'email' => '',
                'email_err' => '',
            ];

            // Load view
            $this->view('pages/index', $data);
        }
    }

    // Page for all saved data
    public function data() {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Export as CSV
            if (isset($_POST['checkBoxArray']) && isset($_POST['btnExport'])) {
                $emailsId = $_POST['checkBoxArray'];
                $emails = array();
                foreach( $emailsId as $id) {
                    $result = $this->emailModel->getEmailById($id);
                    array_push($emails, json_decode(json_encode($result), true));
                }
                
                $filename ="data_export_" . date("Y-m-d") . ".csv";
                // disable caching
                $now = gmdate("D, d M Y H:i:s");
                header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
                header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
                header("Last-Modified: {$now} GMT");
                
                // force download  
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                
                // disposition / encoding on response body
                header("Content-Disposition: attachment;filename={$filename}");
                header("Content-Transfer-Encoding: binary");

                

                if (count($emails) == 0) {
                    echo null;
                    die();
                }
                ob_start();
                $df = fopen("php://output", 'w');
                fputcsv($df, array_keys(reset($emails)));
                foreach ($emails as $row) {
                fputcsv($df, $row);
                }
                fclose($df);
                echo ob_get_clean();
                die();     
              }

            if(isset($_POST['btnReset'])) {
                $_POST['filter'] = '';
            }

            // Init data
            $data = [
                'keyword' => trim($_POST['keyword']), 
                'sort' =>   trim($_POST['sort']),
                'filter' => trim($_POST['filter']),
            ];
            
            // Searches for emails by keyword
            $emails = $this->emailModel->searchEmails($data['keyword']);

            // Filter by email provider
            if ($data['filter'] !== '') {
                $results = array(); // Declare array to store emails
                foreach($emails as $email) {
                    $parts = explode('@', $email->email); // Explodes email in two parts seperated by @
                    $parts2 = explode('.', $parts[1]); // Takes second part of email and explode it before domain
                    if ($parts2[0] === $data['filter']) { // if email Provider is the same as the keyword provided from Filter By then it pushes it to array
                        array_push($results, $email);
                    }
                }
                $emails = $results;
            }
            
            // Get emails
            $emailsList = $this->emailModel->getEmails();
            // Gets current email providers in the table
            $results = array(); // Declare array to store email Providers
            foreach($emailsList as $email) {
                $parts = explode('@', $email->email); // Explodes email in two parts seperated by @
                $parts2 = explode('.', $parts[1]); // Takes second part of email and explode it before domain
                array_push($results, $parts2[0]); // Pushes email Provider to array
            }
            $emailProvider = array_unique($results); // Removes duplicate email Providers
            
            // Sorts emails by date or name
            if ($data['sort'] === 'date') {
                array_multisort(array_map('strtotime',array_column($emails,'created_at')),
                SORT_DESC, 
                $emails);
            } else if ($data['sort'] === 'name') {
                array_multisort(array_map('strtolower',array_column($emails,'email')),
                SORT_ASC, 
                $emails);
            }
                    
            // Set data
            $data = [
                'emails' => $emails,
                'emailProvider' => $emailProvider,
            ];

            // Load view
            $this->view('pages/data', $data);

        } else {
            // Get emails
            $emails = $this->emailModel->getEmails();

            // Gets current email providers in the table
            $results = array(); // Declare array to store email Providers
            foreach($emails as $email) {
                $parts = explode('@', $email->email); // Explodes email in two parts seperated by @
                $parts2 = explode('.', $parts[1]); // Takes second part of email and explode it before domain
                array_push($results, $parts2[0]); // Pushes email Provider to array
            }
            $emailProvider = array_unique($results); // Removes duplicate email Providers
            
            // Set data
            $data = [
                'emails' => $emails,
                'emailProvider' => $emailProvider,
            ];
            
            // Load view
            $this->view('pages/data', $data);
        }
    }

    // Temporary page for deleting email
    public function delete($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if($this->emailModel->deleteEmail($id)) {
                header("location: " . URLROOT . '/data');
            } else {
                die('Something went wrong');
            }
        } else {
            header("location: " . URLROOT . '/data');
        }
    }

    // Shows page on successful email subscription
    public function subscribed() {
        $data = [
            'title' => 'Subscribed',
        ];
        $this->view('pages/subscribed', $data);
    }

}