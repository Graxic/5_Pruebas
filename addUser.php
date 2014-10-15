<?php?>

<div id=return> 
		<a href="http://scissors.wwwowww.me/alexander/">Return to the main page</a><br><br><br>
</div>

 <?php
  
$first_name = $_POST[first_Name];
$last_Name = $_POST[last_Name];
$company = $_POST[company];

$xml = 
        '<?xml version="1.0" encoding="UTF-8"?>
        <Leads>
		<row no="1">
		
        <FL val="First Name"><![CDATA['. $first_name.']]></FL>
        <FL val="Last Name"><![CDATA['. $last_Name.']]></FL>
		<FL val="Company"><![CDATA['. $company.']]></FL>
		</row>
        </Leads>';
		
	
		
$auth="ad5e03526b57110008e7b1a05495393e";
    $url ="https://crm.zoho.com/crm/private/xml/Leads/insertRecords";
    $query="authtoken=".$auth."&scope=crmapi&newFormat=1&xmlData=".$xml;
    $ch = curl_init();
    /* set url to send post request */
    curl_setopt($ch, CURLOPT_URL, $url);
    /* allow redirects */
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    /* return a response into a variable */
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    /* times out after 30s */
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    /* set POST method */
    curl_setopt($ch, CURLOPT_POST, 1);
    /* add POST fields parameters */
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);// Set the request as a POST FIELD for curl.

    //Execute cUrl session
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;




?>