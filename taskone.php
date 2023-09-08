<?php

// Function to get the current UTC time with validation of +/-2 hours
function getValidatedUTC() {
    $currentUTC = gmdate('Y-m-d H:i:s', time());
    $twoHoursAgo = gmdate('Y-m-d H:i:s', time() - 7200); // 7200 seconds = 2 hours ago
    $twoHoursLater = gmdate('Y-m-d H:i:s', time() + 7200); // 7200 seconds = 2 hours later

    if ($currentUTC >= $twoHoursAgo && $currentUTC <= $twoHoursLater) {
        return $currentUTC;
    } else {
        return "UTC time is not within the valid range.";
    }
}

// Function to get the GitHub URL of the source code
function getSourceCodeURL() {
    return "https://github.com/tripletens/BackendZuriStageOne";
}

// Check if Slack name and track query parameters are provided
if (isset($_GET['slack_name']) && isset($_GET['track'])) {
    $slackName = $_GET['slack_name'];
    $currentDay = date('l');
    $utcTime = getValidatedUTC();
    $track = $_GET['track'];
    $sourceCodeURL = getSourceCodeURL();

    // Create the response data array
    $responseData = array(
        "slack_name" => $slackName,
        "current_day" => $currentDay,
        "utc_time" => $utcTime,
        "track" => $track,
        "source_code_url" => $sourceCodeURL,
        "status_code" => "Success"
    );

    // Set the response content type to JSON
    header('Content-Type: application/json');

    // Return the JSON response
    echo json_encode($responseData);
} else {
    // If Slack name and track query parameters are not provided, return an error message
    echo json_encode(array("error" => "Slack name and track parameters are required."));
}

?>
