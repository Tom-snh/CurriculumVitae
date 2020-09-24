<?php
    $array = array("firstname" => "","name" => "","email" => "","telephone" => "", "message" => "",
     "firstnameError" => "","nameError" => "","emailError" => "","msgError" => "","telephoneError" => "",
    "isSuccess" => false);
    $emailTo = "tsinnah@hotmail.com";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $array["firstname"] = verifiy($_POST["first-name"]);
        $array["name"] = verifiy($_POST["name"]);
        $array["email"] = verifiy($_POST["email"]);
        $array["telephone"] = verifiy($_POST["telephone"]);
        $array["message"] = verifiy($_POST["message"]);
        $array["isSuccess"] = true;
        $emailText = "";
    }
    
    function verifiy($var){
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }

    function isPhone($var){
        return preg_match("/^[0-9 ]*$/",$var);
    }
    if(!isPhone($array["telephone"])){
        $array["telephoneError"] = "Un n° valide je vous prie...";
        $array["isSuccess"] = false;
    }
    else{
        $emailText .= "Phone: {$array['telephone']}\n";
    }
    if(empty($array["firstname"])){
        $array["firstnameError"] = "C'est toujours plus sympa de savoir qui nous écrit";
        $array["isSuccess"] = false;
    }
    else{
        $emailText .= "Firstname: {$array['firstname']}\n";
    }
    if(empty($array["name"])){
        $array["nameError"] = "Il me faut votre nom";
        $array["isSuccess"] = false;
    }
    else{
        $emailText .= "Name: {$array['name']}\n";
    }
    if(empty($array["email"])){
        $array["emailError"] = "Adresse obligatoire";
        $array["isSuccess"] = false;
    }
    else{
        $emailText .= "Email: {$array['email']}\n";
    }
    if(empty($array["message"])){
        $array["msgError"] = "Vraiment rien à me dire ?";
        $array["isSuccess"] = false;
    }
    else{
        $emailText .= "Message: {$array['message']}\n";
    }
    if($array["isSuccess"]){
        $header = "From: {$array['firstname']} {$array['name']} <{$array['email']}>\r\nReply-to: {$array['email']}";
        mail($emailTo,"Message CV",$emailText,$header);
    }

    echo json_encode($array);
?>