<?php

require_once __DIR__ .'/google-api-php-client/src/Google_Client.php';
require_once __DIR__ .'/google-api-php-client/src/contrib/Google_YouTubeService.php';
ini_set('max_execution_time', 3000);

// Set your cached access token. Remember to replace $_SESSION with a real database or memcached.
session_start();

// Connect to the Account you want to upload the video to (Note: When Remembering your access code you only need to do this once)
$client = new Google_Client();
$client->setApplicationName('video-qbix');
$client->setClientId('1037725546862-ku2pkm6cnhl3g9dnf20118fsq2n4fo51.apps.googleusercontent.com');
$client->setClientSecret('aF_IrpexQdGYfd0C6liW4qzG');
$client->setRedirectUri('http://localhost/video-qbix/videos/upload.php');
$client->setDeveloperKey('AIzaSyBeaaH8-Nltbr0zQpE2bdcBt2vsaJQlD1U');

// Load the Youtube Service Library
$youtube = new Google_YouTubeService($client);

// Authenticate the user when he comes back with the access code
if (isset($_GET['code']))
{
    $client->authenticate();
    $_SESSION['token'] = $client->getAccessToken();
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

// Check if the Token is set in the Session. If so set it to the client
if (isset($_SESSION['token']))
{
    $client->setAccessToken($_SESSION['token']);
}

// Check if the client has an access Token elke Give him a login Link
if ($client->getAccessToken())
{
    // Upload the youtube Video
    try
    {
        $path_to_video_to_upload = 'D:\\xampp\\htdocs\\video-qbix\\videos\\sample\\en.mp4';

        // Get the Mimetype of your video
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $path_to_video_to_upload);

        // Build the Needed Video Information
        $snippet = new Google_VideoSnippet();
        $snippet->setTitle('Title Of Video');
        $snippet->setDescription('Description Of Video');
        $snippet->setTags(array('Tag 1', 'Tag 2'));
        $snippet->setCategoryId(22);

        // Build the Needed video Status
        $status = new Google_VideoStatus();
        $status->setPrivacyStatus('private'); // or public, unlisted

        // Set the Video Info and Status in the Main Tag
        $video = new Google_Video();
        $video->setSnippet($snippet);
        $video->setStatus($status);

        // Send the video to the Google Youtube API
        $created_file = $youtube->videos->insert("status,snippet", $video, array(
            'data' => file_get_contents($path_to_video_to_upload),
            'mimeType' => $mime_type,
        ));

        // Get the information of the uploaded video
        print_r($createdFile);
    }
    catch (Exception $ex)
    {
        echo $ex;
    }

    // We're not done yet. Remember to update the cached access token.
    // Remember to replace $_SESSION with a real database or memcached.
    $_SESSION['token'] = $client->getAccessToken();
}
else
{
    $authUrl = $client->createAuthUrl();
    print "<a href='$authUrl'>Connect Me!</a>";
}

?>