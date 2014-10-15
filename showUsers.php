<?php?>
	<div id=return> 
				<a href="http://scissors.wwwowww.me/alexander/">Return to the main page</a><br><br><br>
	</div>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

/* NOTE: Define your mysql database parameters in moduleDependant class */

/* Constant Declarations */
define("TARGETURL", "https://crm.zoho.com/crm/private/xml/Leads/getMyRecords");

/* user related parameter */
define("AUTHTOKEN", "ad5e03526b57110008e7b1a05495393e");

define("SCOPE", "crmapi");

/* create a object */
$utilObj = new Utilities();

/* set parameters */
$parameter = "";
$parameter = $utilObj->setParameter("scope", SCOPE, $parameter);
$parameter = $utilObj->setParameter("authtoken", AUTHTOKEN, $parameter);
$parameter = $utilObj->setParameter("selectColumns", "Leads(LEADID,First Name,Last Name,Company)", $parameter);

/* Call API */
$response = $utilObj->sendCurlRequest(TARGETURL, $parameter);

$utilObj->showUsers($response);


class Utilities {

    public function setParameter($key, $value, $parameter) {
        if ($parameter === "" || strlen($parameter) == 0) {
            $parameter = $key . '=' . $value;
        } else {
            $parameter .= '&' . $key . '=' . $value;
        }
        return $parameter;
    }

    public function showUsers($xmldata) {
        $xmlString = <<<XML
$xmldata
XML;
        $xml = simplexml_load_string($xmlString);
        if (isset($xml->result)) {
            $modeuleDependantObj = new moduleDependant();
            $output = $modeuleDependantObj->printUsers($xml);
        } else if (isset($xml->error)) {
            echo "Error code: " . $xml->error->code . "<br/>";
            echo "Error message: " . $xml->error->message;
        }
    }

    public function sendCurlRequest($url, $parameter) {
        try {
            /* initialize curl handle */
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
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
            /* execute the cURL */
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        } catch (Exception $exception) {
            echo 'Exception Message: ' . $exception->getMessage() . '<br/>';
            echo 'Exception Trace: ' . $exception->getTraceAsString();
        }
    } 
}

class moduleDependant {
    public function printUsers($xml) {
        $numberOfRecords = count($xml->result->Leads->row);
        /* $records[row value][field value] */
        $records[][] = array();
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $numberOfValues = count($xml->result->Leads->row[$i]->FL);
            for ($j = 0; $j < $numberOfValues; $j++) {		
                switch ((string) $xml->result->Leads->row[$i]->FL[$j]['val']) {
                    /* Get attributes as element indices */
                    case 'LEADID':
                        $records[$i]['LEADID'] = (string) $xml->result->Leads->row[$i]->FL[$j];
                        break;
                    case 'First Name':
                        $records[$i]['First Name'] = (string) $xml->result->Leads->row[$i]->FL[$j];
                        break;
                    case 'Last Name':
                        $records[$i]['Last Name'] = (string) $xml->result->Leads->row[$i]->FL[$j];
                        break;
                    case 'Company':
                        $records[$i]['Company'] = (string) $xml->result->Leads->row[$i]->FL[$j];
                        break;
                }
            }
				echo ("Numero de Usuario: " . $i .  "<br>");
				echo ("Identificador: " . $records[$i]['LEADID'] . "   ");
				echo ("Nombre del Usuario: " . $records[$i]['First Name'] .  "   ");
				echo ("Apellido: " . $records[$i]['Last Name'] .  "   ");
				echo ("Compania: " . $records[$i]['Company'] . "<br>");
        }
    }
}

