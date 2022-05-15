<?php
// db file
require 'db.php';
 
if (isset($_POST['submit']))
{
 
    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
 
            // Skip the first line
            fgetcsv($csvFile);
 
            // Parse data from CSV file line by line
             // Parse data from CSV file line by line
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {
                // Get row data
                $name = $getData[0];
                $email = $getData[1];
                $phone = $getData[2];
                 
                // If user already exists in the database with the same email
                $query = "SELECT id FROM members WHERE email = '" . $getData[1] . "'";
 
                $check = mysqli_query($con, $query);
 
                if ($check->num_rows > 0)
                {
                    mysqli_query($con, "UPDATE members SET name = '" . $name . "', phone = '" . $phone . "', WHERE email = '" . $email . "'");
                }
                else
                {
                     mysqli_query($con, "INSERT INTO members (name, email, phone) VALUES ('" . $name . "', '" . $email . "', '" . $phone . "')");
 
                }
            