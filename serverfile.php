public function upload_company_logo($company_profile_id) {
    $logo_file_name = "";
    if (isset($_FILES["notice"]['name'])) {
        $timg_name = $_FILES['notice']['name'];
        if (!empty($timg_name)) {
            $temp_var = explode(".", strtolower($timg_name));
            $timage_ext = end($temp_var);
            $timage_name_new = "notice_" . $company_profile_id . "." . $timage_ext; 
            $image_enter_data['notice'] = $timage_name_new;

            // Update the image name in the local database
            $imginsertStatus = $this->Common_Model->update_operation(array(
                'table' => 'notice',
                'data' => $image_enter_data,
                'condition' => "id = $company_profile_id"
            ));

            if ($imginsertStatus > 0) {
                // Create local directory if it doesn't exist
                $local_upload_dir = 'assets/uploads/notice';
                if (!is_dir($local_upload_dir)) {
                    mkdir($local_upload_dir, 0777, true);
                }

                // Move uploaded file to the local directory
                if (move_uploaded_file($_FILES['notice']['tmp_name'], "$local_upload_dir/$timage_name_new")) {
                    $logo_file_name = $timage_name_new;

                    // Define the remote upload directory (change this as necessary)
                    $remote_directory = 'assets/uploads/notice/';

                    // Call the function to upload the file to the remote server
                    $response = $this->upload_file_to_remote($timage_name_new, $company_profile_id, $remote_directory);

                    // Handle response from remote upload
                    if ($response['status'] === 'success') {
                        echo "File successfully uploaded to remote server.";
                    } else {
                        echo "Error: " . $response['message'];
                    }
                } else {
                    echo "Error: Failed to move uploaded file locally.";
                }
            } else {
                echo "Error: Failed to update database.";
            }
        } else {
            echo "Error: No file uploaded.";
        }
    } else {
        echo "Error: Invalid file input.";
    }
}

private function upload_file_to_remote($file_name, $company_profile_id, $directory) {
    // Prepare data to send (including directory name and file)
    $data = array(
        'directory' => $directory, // Desired directory structure
        'file' => new CURLFile("assets/uploads/notice/$file_name", $_FILES['notice']['type'], $file_name)
    );

    // Remote server URL
    $remote_url = "https://jnl.collegefaculty.in/company/upload_image"; // Update with your actual URL

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $remote_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute request and handle response
    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Handle response
    if ($http_status === 200) {
        return json_decode($response, true); // Return response for further processing
    } else {
        return ['status' => 'error', 'message' => 'Failed to connect to remote server.'];
    }
}
