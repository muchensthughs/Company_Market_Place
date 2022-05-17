<?php


require 'constants.php';


// if(isset($_COOKIE['userId'])){
//     //header('Location: home.php');
//     echo "Already Logged in !";
//     exit;
// }
require 'google-api/vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();

// Enter your Client ID
$client->setClientId('548588993899-u5m4ule12b0hl7arkrkmoa4mtha6f51p.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('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');
// Enter the Redirect URL
$client->setRedirectUri('http://localhost:8080/googlelogin.php');

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])):

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token["error"])){

        $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        
      
        // Storing data into database
        $id = mysqli_real_escape_string($database, $google_account_info->id);
        $full_name = mysqli_real_escape_string($database, trim($google_account_info->name));
        $email = mysqli_real_escape_string($database, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($database, $google_account_info->picture);
        
       
        $get_user = mysqli_query($database, "SELECT `google_id` FROM `googleusers` WHERE `google_id`='$id'");
       
        if(mysqli_num_rows($get_user) > 0){

            setcookie('userId',$id); 
            setcookie('userName',$full_name);
            header('Location: index.php');
            exit;

        }
        else{

            //if user not exists we will insert the user
            $insert = mysqli_query($db_connection, "INSERT INTO `googleusers`(`google_id`,`name`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");

            if($insert){
                setcookie('userId',$id); 
                setcookie('userName',$full_name);
                header('Location: index.php');
                exit;
            }
            else{
                echo "Sign up failed!(Something went wrong).";
            }

        }

    }
    else{
        header('Location: loginform.php');
        exit;
    }
    
else: 
?>

<a class="btn btn-lg btn-danger btn-block" href="<?php echo $client->createAuthUrl(); ?>">Google Login</a>

<?php endif; ?>