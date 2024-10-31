<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enrollmentsystemdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize update status flags
    $student_updated = false;
    $contact_updated = false;
    $enrollment_updated = false;
    $parents_updated = false;
    $previous_school_updated = false;

    // Update student_information
    if (isset($_POST['student_info_id'])) {
        $student_info_id = $_POST['student_info_id'];
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
        $middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : null;
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
        $extension_name = isset($_POST['extension_name']) ? $_POST['extension_name'] : null;
        $nickname = isset($_POST['nickname']) ? $_POST['nickname'] : null;
        $lrn_number = isset($_POST['lrn_number']) ? $_POST['lrn_number'] : null;
        $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
        $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
        $religion = isset($_POST['religion']) ? $_POST['religion'] : null;
        $place_of_birth = isset($_POST['place_of_birth']) ? $_POST['place_of_birth'] : null;
        $have_been_hospitalized = isset($_POST['have_been_hospitalized']) ? 1 : 0;
        $reason = isset($_POST['reason']) ? $_POST['reason'] : null;
        $medical_history = isset($_POST['medical_history']) ? $_POST['medical_history'] : null;

        $sql_update_student = "UPDATE student_information SET 
                        first_name = ?, 
                        middle_name = ?, 
                        last_name = ?, 
                        extension_name = ?, 
                        nickname = ?, 
                        lrn_number = ?, 
                        birthdate = ?, 
                        gender = ?, 
                        religion = ?, 
                        place_of_birth = ?, 
                        have_been_hospitalized = ?, 
                        reason = ?, 
                        medical_history = ? 
                        WHERE student_info_id = ?";

        $stmt_update_student = $conn->prepare($sql_update_student);
        $stmt_update_student->bind_param("sssssssssssssi", $first_name, $middle_name, $last_name, $extension_name, $nickname, $lrn_number, $birthdate, $gender, $religion, $place_of_birth, $have_been_hospitalized, $reason, $medical_history, $student_info_id);

        if ($stmt_update_student->execute()) {
            $student_updated = true;
        } else {
            echo "Error updating Student Information: " . $stmt_update_student->error . "<br>";
        }

        $stmt_update_student->close();
    }

    // Update contact_details
    if (isset($_POST['contact_details_id'])) {
        $contact_details_id = $_POST['contact_details_id'];
        $contact_email = isset($_POST['contact_email']) ? $_POST['contact_email'] : null;
        $mobile_number_1 = isset($_POST['mobile_number_1']) ? $_POST['mobile_number_1'] : null;
        $mobile_number_2 = isset($_POST['mobile_number_2']) ? $_POST['mobile_number_2'] : null;
        $student_address = isset($_POST['student_address']) ? $_POST['student_address'] : null;
        $contact_person_name = isset($_POST['contact_person_name']) ? $_POST['contact_person_name'] : null;
        $contact_number = isset($_POST['contact_number']) ? $_POST['contact_number'] : null;
        $contact_person_address = isset($_POST['contact_person_address']) ? $_POST['contact_person_address'] : null;

        $sql_update_contact = "UPDATE contact_details SET 
                        contact_email = ?, 
                        mobile_number_1 = ?, 
                        mobile_number_2 = ?, 
                        student_address = ?, 
                        contact_person_name = ?, 
                        contact_number = ?, 
                        contact_person_address = ? 
                        WHERE contact_details_id = ?";

        $stmt_update_contact = $conn->prepare($sql_update_contact);
        $stmt_update_contact->bind_param("sssssssi", $contact_email, $mobile_number_1, $mobile_number_2, $student_address, $contact_person_name, $contact_number, $contact_person_address, $contact_details_id);

        if ($stmt_update_contact->execute()) {
            $contact_updated = true;
        } else {
            echo "Error updating Contact Details: " . $stmt_update_contact->error . "<br>";
        }

        $stmt_update_contact->close();
    }

    // Update enrollment_details
    if (isset($_POST['enrollment_details_id'])) {
        $enrollment_details_id = $_POST['enrollment_details_id'];
        $grade_level = isset($_POST['grade_level']) ? $_POST['grade_level'] : null;
        $payment_schedule = isset($_POST['payment_schedule']) ? $_POST['payment_schedule'] : null;

        $sql_update_enrollment = "UPDATE enrollment_details SET 
                        grade_level = ?, 
                        payment_schedule = ? 
                        WHERE enrollment_details_id = ?";

        $stmt_update_enrollment = $conn->prepare($sql_update_enrollment);
        $stmt_update_enrollment->bind_param("ssi", $grade_level, $payment_schedule, $enrollment_details_id);

        if ($stmt_update_enrollment->execute()) {
            $enrollment_updated = true;
        } else {
            echo "Error updating Enrollment Details: " . $stmt_update_enrollment->error . "<br>";
        }

        $stmt_update_enrollment->close();
    }
}
    // Update parents_information
    if (isset($_POST['parents_info_id'])) {
        $parents_info_id = $_POST['parents_info_id'];
        $mothers_maiden_name = isset($_POST['mothers_maiden_name']) ? $_POST['mothers_maiden_name'] : null;
        $fathers_name = isset($_POST['fathers_name']) ? $_POST['fathers_name'] : null;
        $reason_for_not_specifying_maidens_name = isset($_POST['reason_for_not_specifying_maidens_name']) ? $_POST['reason_for_not_specifying_maidens_name'] : null;
        $guardian_name = isset($_POST['guardian_name']) ? $_POST['guardian_name'] : null;
        $guardian_contact_no = isset($_POST['guardian_contact_no']) ? $_POST['guardian_contact_no'] : null;
        $guardian_address = isset($_POST['guardian_address']) ? $_POST['guardian_address'] : null;
        $occupation = isset($_POST['occupation']) ? $_POST['occupation'] : null;
        $office_address = isset($_POST['office_address']) ? $_POST['office_address'] : null;
        $ethnicity = isset($_POST['ethnicity']) ? $_POST['ethnicity'] : null;
        $mother_tongue = isset($_POST['mother_tongue']) ? $_POST['mother_tongue'] : null;
        $other_spoken_languages = isset($_POST['other_spoken_languages']) ? $_POST['other_spoken_languages'] : null;

        $sql_update_parents = "UPDATE parents_information SET 
                        mothers_maiden_name = ?, 
                        fathers_name = ?, 
                        reason_for_not_specifying_maidens_name = ?, 
                        guardian_name = ?, 
                        guardian_contact_no = ?, 
                        guardian_address = ?, 
                        occupation = ?, 
                        office_address = ?, 
                        ethnicity = ?, 
                        mother_tongue = ?, 
                        other_spoken_languages = ? 
                        WHERE parents_info_id = ?";

        $stmt_update_parents = $conn->prepare($sql_update_parents);
        $stmt_update_parents->bind_param("sssssssssssi", $mothers_maiden_name, $fathers_name, $reason_for_not_specifying_maidens_name, $guardian_name, $guardian_contact_no, $guardian_address, $occupation, $office_address, $ethnicity, $mother_tongue, $other_spoken_languages, $parents_info_id);

        if ($stmt_update_parents->execute()) {
            $parents_updated = true;
        } else {
            echo "Error updating Parents Information: " . $stmt_update_parents->error . "<br>";
        }

        $stmt_update_parents->close();
    }

    // Update previous_school_details
if (isset($_POST['previous_school_id'])) {
    $previous_school_id = $_POST['previous_school_id'];
    $school_name = isset($_POST['school_name']) ? $_POST['school_name'] : null;
    $school_address = isset($_POST['school_address']) ? $_POST['school_address'] : null;

    $sql_update_previous_school = "UPDATE previous_school_details SET 
                    school_name = ?, 
                    school_address = ?
                    WHERE previous_school_id = ?";

    $stmt_update_previous_school = $conn->prepare($sql_update_previous_school);
    $stmt_update_previous_school->bind_param("ssi", $school_name, $school_address, $previous_school_id);

    if ($stmt_update_previous_school->execute()) {
        $previous_school_updated = true;
    } else {
        echo "Error updating Previous School Details: " . $stmt_update_previous_school->error . "<br>";
    }

    $stmt_update_previous_school->close();
}

// Determine where to redirect based on what was updated
if ($student_updated) {
    header("Location: student-details.php");
    exit();
} elseif ($contact_updated) {
    header("Location: contact-details.php");
    exit();
} elseif ($enrollment_updated) {
    header("Location: enrollment-details.php");
    exit();
} elseif ($parents_updated) {
    header("Location: parent-details.php");
    exit();
} elseif ($previous_school_updated) {
    header("Location: previous-details.php");
    exit();
} else {
    echo "No data updated.";
}

// Close connection
$conn->close();
?>
