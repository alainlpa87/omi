<?php
/**
 * Created by PhpStorm.
 * User: Alain
 * Date: 10/6/2015
 * Time: 1:25 PM
 */

namespace App\Helpers;

use App\Models\Project;
use App\Models\UploadedFiles;

class DocusignFunctions {

    public static function getSigners($documentName,$project,$positions){
        $recipientId = $project->id;
        $clientUserId = $project->lead->id;
        $recipientName = ucwords($project->lead->fname." ".$project->lead->lname);
        $recipientEmail = $project->lead->email;
        $signPos = [400,268,7,400,440];
        if($positions != null)
            $signPos = $positions;

        $signers = '';
        switch($documentName){
            case 'agreementPSA.pdf':
                $signers = array(
                    array(
                        "email" => $recipientEmail,
                        "name" => $recipientName,
                        "recipientId" => $recipientId,
                        "clientUserId" => $clientUserId,
                        "tabs" => array(
                            "signHereTabs" => array(
                                array(
                                    "xPosition" => $signPos[0],
                                    "yPosition" => $signPos[1],
                                    "documentId" => "1",
                                    "pageNumber" => $signPos[2]
                                )
                            ),
                            "dateSignedTabs" => array(
                                array(
                                    "anchorString" => "date:",
                                    "anchorXOffset" => "1",
                                    "anchorYOffset" => "0",
                                    "anchorIgnoreIfNotPresent" => "false",
                                    "anchorUnits" => "inches"
                                )
                            ),
                            "initialHereTabs" => array(
                                array(
                                    "anchorString" => "INVENTOR initials:",
                                    "anchorXOffset" => "1",
                                    "anchorYOffset" => "0",
                                    "anchorIgnoreIfNotPresent" => "false",
                                    "anchorUnits" => "inches"
                                )
                            )
                        )
                    )
                );
                if(strlen($project->coInventor)!=0){
                    $pos = $signPos[1] + 170;
                    $coinventors = explode(',',$project->coInventor);
                    for($i=0;$i<count(explode(',',$project->coInventor));$i++){
                        $aux = array(
                            "email" => "coinventor_".$i."_".$recipientEmail,
                            "name" => ucwords($coinventors[$i]),
                            "recipientId" => $recipientId + $i + 1,
                            "clientUserId" => $clientUserId + $i + 1,
                            "tabs" => array(
                                "signHereTabs" => array(
                                    array(
                                        "xPosition" => $signPos[0],
                                        "yPosition" => $pos + 85*$i,
                                        "documentId" => "1",
                                        "pageNumber" => $signPos[2]
                                    )
                                ),
                            )
                        );
                        $signers[] = $aux;
                    }
                }
                break;
            case 'ddr.pdf':
                $signers = array(
                    array(
                        "email" => $recipientEmail,
                        "name" => $recipientName,
                        "recipientId" => $recipientId,
                        "clientUserId" => $clientUserId,
                        "tabs" => array(
                            "signHereTabs" => array(
                                array(
                                    "anchorString" => "INVENTOR SIGNATURE:",
                                    "anchorXOffset" => "2",
                                    "anchorYOffset" => "0",
                                    "anchorIgnoreIfNotPresent" => "false",
                                    "anchorUnits" => "inches"
                                )
                            ),
                            "dateSignedTabs" => array(
                                array(
                                    "anchorString" => "DATE:",
                                    "anchorXOffset" => "1",
                                    "anchorYOffset" => "0",
                                    "anchorIgnoreIfNotPresent" => "false",
                                    "anchorUnits" => "inches"
                                )
                            )
                        )
                    )
                );
                break;
        }

        $data = array (
            "emailSubject" => "DocuSign API - Please sign ".$documentName,
            "documents" => array(
                array("documentId" => "1", "name" => $documentName)
            ),
            "status" => "sent",
            "recipients" => array(
                "signers" =>$signers
            )
        );

        return json_encode($data);
    }

    public static function docuSignWithTemplate(){
        $integratorKey = '9c372baf-4fa3-441f-9b30-d63afd57c860';
        $email = 'psu_docusign@ownmyinvention.com';
        $password = 'PatentServicesUsaDocusign';
        $name = "Alain Pinero";
        $templateId = "a5fcd72f-737b-41d0-8633-684a003f6270";
        $header = "<DocuSignCredentials><Username>" . $email . "</Username><Password>" . $password . "</Password><IntegratorKey>" . $integratorKey . "</IntegratorKey></DocuSignCredentials>";


//
// STEP 1 - log in
//
        $url = "https://www.docusign.net/restapi/v2/login_information";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-DocuSign-Authentication: $header"));
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            echo "error calling webservice, status is:" . $status;
            exit(-1);
        }

        $response = json_decode($json_response, true);

        $accountId = $response["loginAccounts"][0]["accountId"];
        $baseUrl = $response["loginAccounts"][0]["baseUrl"];
        //echo "accountId " . $accountId . "\n";
        //echo "baseUrl " . $baseUrl . "\n";

        curl_close($curl);


//
// STEP 2 - create and envelope with an embedded recipient
//
        $data = array("accountId" => $accountId,
            "emailSubject" => "Hello World!",
            "emailBlurb" => "This comes from PHP",
            "templateId" => $templateId,
            "templateRoles" => array(array( "email" => $email, "name" => $name, "roleName" => "Signer1", "clientUserId" => "0xBEEFCAFE" )),
            "status" => "sent");
        $data_string = json_encode($data);
        $curl = curl_init($baseUrl . "/envelopes" );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                "X-DocuSign-Authentication: $header" )
        );
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ( $status != 201 ) {
            echo "error calling webservice, status is:" . $status;
            exit(-1);
        }

        $response = json_decode($json_response, true);

        $envelopeId = $response["envelopeId"];
        //echo "Document is sent! Envelope ID: " . $envelopeId . "\n";
        curl_close($curl);

//
// STEP 3 - get the embedded view
//
        $returnUrl = url("testA?id=$envelopeId");
        $data = array("returnUrl" => $returnUrl,
            "authenticationMethod" => "None", "email" => $email,
            "userName" => $name, "clientUserId" => "0xBEEFCAFE"
        );
        $data_string = json_encode($data);
        $curl = curl_init($baseUrl . "/envelopes/$envelopeId/views/recipient" );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                "X-DocuSign-Authentication: $header" )
        );

        $json_response = curl_exec($curl);
        $response = json_decode($json_response, true);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ( $status != 201 ) {
            echo "error calling webservice, status is:" . $status;
            echo "$json_response";
            exit(-1);
        }

        $url = $response["url"];
        header("Location: $url");
        exit();
    }

   //login into docusign and get the baseURL to make the API calls
    public static function docuSignGetBaseURL(){
        $header = "<DocuSignCredentials><Username>psu_docusign@ownmyinvention.com</Username><Password>PatentServicesUsaDocusign</Password><IntegratorKey>9c372baf-4fa3-441f-9b30-d63afd57c860</IntegratorKey></DocuSignCredentials>";
        $url = "https://www.docusign.net/restapi/v2/login_information";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-DocuSign-Authentication: $header"));
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            echo "error calling webservice, status is:" . $status;
            exit(-1);
        }
        $response = json_decode($json_response, true);
        $baseUrl = $response["loginAccounts"][0]["baseUrl"];

        curl_close($curl);
        return $baseUrl;
    }

    //login into docusign and get the baseURL to make the API calls
    public static function docuSignGetBaseURLTest(){
        $header = "<DocuSignCredentials><Username>psu_docusign@ownmyinvention.com</Username><Password>PatentServicesUsaDocusign</Password><IntegratorKey>9c372baf-4fa3-441f-9b30-d63afd57c860</IntegratorKey></DocuSignCredentials>";
        $url = "https://demo.docusign.net/restapi/v2/login_information";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-DocuSign-Authentication: $header"));
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            echo "error calling webservice, status is:" . $status;
            exit(-1);
        }
        $response = json_decode($json_response, true);
        $baseUrl = $response["loginAccounts"][0]["baseUrl"];

        curl_close($curl);
        return $baseUrl;
    }

    public static function docuSignGetContract($envelopeId,$contract){
        $header = "<DocuSignCredentials><Username>psu_docusign@ownmyinvention.com</Username><Password>PatentServicesUsaDocusign</Password><IntegratorKey>9c372baf-4fa3-441f-9b30-d63afd57c860</IntegratorKey></DocuSignCredentials>";
        $baseUrl = DocusignFunctions::docuSignGetBaseURL();
/////////////////////////////////////////////////////////////////////////////////////////////////
// STEP 2 - Get document information
/////////////////////////////////////////////////////////////////////////////////////////////////
        $curl = curl_init($baseUrl . "/envelopes/" . $envelopeId . "/documents" );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "X-DocuSign-Authentication: $header" )
        );
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ( $status != 200 ) {
            echo "error calling webservice, status is:" . $status;
            exit(-1);
        }
        $response = json_decode($json_response, true);
        curl_close($curl);
/////////////////////////////////////////////////////////////////////////////////////////////////
// STEP 3 - Download the envelope's documents
/////////////////////////////////////////////////////////////////////////////////////////////////
        foreach( $response["envelopeDocuments"] as $document ) {
            $docUri = $document["uri"];

            $curl = curl_init($baseUrl . $docUri);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    "X-DocuSign-Authentication: $header")
            );

            $data = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($status != 200) {
                echo "error calling webservice, status is:" . $status;
                exit(-1);
            }
            //file_put_contents("https://www.ownmyinvention.com/3.0/public/files/omi/".$envelopeId . "-" . $document["name"], $data);


            $docName = "signed_".$document["name"];
            if($document["name"] == "Summary")
                $docName = "signed_".$contract->type."_".$document["name"].".pdf";

            $docUrl = "files/projects/".$contract->project->lead->fileno."/".$contract->project->id."/";

            $f = fopen($docUrl.$docName, 'w+');
            if (!$f) {
                return false;
                print "<br>no abrio.";
            } else {
                $bytes = fwrite($f, $data);
                fclose($f);

                $uploadFile = UploadedFiles::where(array('project_id'=>$contract->project->id,'fileName'=>"$docName"))->first();
                if($uploadFile == null)
                {
                    $uploadFile = new UploadedFiles();
                    $uploadFile->project_id = $contract->project->id;
                }
                $uploadFile->url = $docUrl.$docName;
                $uploadFile->fileName = $docName;
                $uploadFile->public = 1;
                $uploadFile->internal = 1;
                $uploadFile->save();
            }

            curl_close($curl);

            //*** Documents should now be downloaded in the same folder as you ran this program
        }
    }

    public static function docuSignGetDocument($envelopeId,$project,$docType){
        $header = "<DocuSignCredentials><Username>psu_docusign@ownmyinvention.com</Username><Password>PatentServicesUsaDocusign</Password><IntegratorKey>9c372baf-4fa3-441f-9b30-d63afd57c860</IntegratorKey></DocuSignCredentials>";
        $baseUrl = DocusignFunctions::docuSignGetBaseURL();
/////////////////////////////////////////////////////////////////////////////////////////////////
// STEP 2 - Get document information
/////////////////////////////////////////////////////////////////////////////////////////////////
        $curl = curl_init($baseUrl . "/envelopes/" . $envelopeId . "/documents" );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "X-DocuSign-Authentication: $header" )
        );
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ( $status != 200 ) {
            echo "error calling webservice, status is:" . $status;
            exit(-1);
        }
        $response = json_decode($json_response, true);
        curl_close($curl);
/////////////////////////////////////////////////////////////////////////////////////////////////
// STEP 3 - Download the envelope's documents
/////////////////////////////////////////////////////////////////////////////////////////////////
        foreach( $response["envelopeDocuments"] as $document ) {
            $docUri = $document["uri"];

            $curl = curl_init($baseUrl . $docUri);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    "X-DocuSign-Authentication: $header")
            );

            $data = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($status != 200) {
                echo "error calling webservice, status is:" . $status;
                exit(-1);
            }
            //file_put_contents("https://www.ownmyinvention.com/3.0/public/files/omi/".$envelopeId . "-" . $document["name"], $data);


            $docName = "signed_".$document["name"];
            if($document["name"] == "Summary")
                $docName = "signed_".$docType."_".$document["name"].".pdf";

            $docUrl = "files/projects/".$project->lead->fileno."/".$project->id."/";

            $f = fopen($docUrl.$docName, 'w+');
            if (!$f) {
                return false;
                print "<br>no abrio.";
            } else {
                $bytes = fwrite($f, $data);
                fclose($f);

                $uploadFile = UploadedFiles::where(array('project_id'=>$project->id,'fileName'=>"$docName"))->first();
                if($uploadFile == null)
                {
                    $uploadFile = new UploadedFiles();
                    $uploadFile->project_id = $project->id;
                }
                $uploadFile->url = $docUrl.$docName;
                $uploadFile->fileName = $docName;
                $uploadFile->public = 1;
                $uploadFile->internal = 1;
                $uploadFile->attorney = 1;
                $uploadFile->save();
            }

            curl_close($curl);

            //*** Documents should now be downloaded in the same folder as you ran this program
        }
    }

    public static function docuSignGetLegalDocument($envelopeId,$project,$docType,$namePrefix){
        $header = "<DocuSignCredentials><Username>psu_docusign@ownmyinvention.com</Username><Password>PatentServicesUsaDocusign</Password><IntegratorKey>9c372baf-4fa3-441f-9b30-d63afd57c860</IntegratorKey></DocuSignCredentials>";
        $baseUrl = DocusignFunctions::docuSignGetBaseURL();
/////////////////////////////////////////////////////////////////////////////////////////////////
// STEP 2 - Get document information
/////////////////////////////////////////////////////////////////////////////////////////////////
        $curl = curl_init($baseUrl . "/envelopes/" . $envelopeId . "/documents" );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "X-DocuSign-Authentication: $header" )
        );
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ( $status != 200 ) {
            echo "error calling webservice, status is:" . $status;
            exit(-1);
        }
        $response = json_decode($json_response, true);
        curl_close($curl);
/////////////////////////////////////////////////////////////////////////////////////////////////
// STEP 3 - Download the envelope's documents
/////////////////////////////////////////////////////////////////////////////////////////////////
        $fileId = -1;
        foreach( $response["envelopeDocuments"] as $document ) {
            $docUri = $document["uri"];

            $curl = curl_init($baseUrl . $docUri);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    "X-DocuSign-Authentication: $header")
            );

            $data = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($status != 200) {
                echo "error calling webservice, status is:" . $status;
                exit(-1);
            }
            //file_put_contents("https://www.ownmyinvention.com/3.0/public/files/omi/".$envelopeId . "-" . $document["name"], $data);


            $docName = $namePrefix.$document["name"];
            if($document["name"] == "Summary")
                $docName = $docType."_".$document["name"].".pdf";

            $docUrl = "files/projects/".$project->lead->fileno."/".$project->id."/";

            $f = fopen($docUrl.$docName, 'w+');
            if (!$f) {
                return false;
                print "<br>no abrio.";
            } else {
                $bytes = fwrite($f, $data);
                fclose($f);

                $uploadFile = UploadedFiles::where(array('project_id'=>$project->id,'fileName'=>"$docName"))->first();
                if($uploadFile == null)
                {
                    $uploadFile = new UploadedFiles();
                    $uploadFile->project_id = $project->id;
                }
                $uploadFile->url = $docUrl.$docName;
                $uploadFile->fileName = $docName;
                $uploadFile->save();
                if($document["name"] != "Summary")
                    $fileId = $uploadFile->id;
            }

            curl_close($curl);

            //*** Documents should now be downloaded in the same folder as you ran this program
        }
        return $fileId;
    }

    public static function docuSignWithDoc($recipientName,$recipientEmail,$fileUrl,$contractId,$backUrl,$positions=null){

        //array of positions for the signature  [signature xPosition,signature yPosition,pageNumber,date xPosition,date yPosition]
        $signPos = [100,155,3,350,205];
        if($positions != null)
            $signPos = $positions;

        $documentName = explode("/",$fileUrl)[4];

        $header = "<DocuSignCredentials><Username>psu_docusign@ownmyinvention.com</Username><Password>PatentServicesUsaDocusign</Password><IntegratorKey>9c372baf-4fa3-441f-9b30-d63afd57c860</IntegratorKey></DocuSignCredentials>";
        $baseUrl = DocusignFunctions::docuSignGetBaseURL();


//
// STEP 2 - create and envelope with an embedded recipient
//

        $recipientId = mt_rand();
        $clientUserId = mt_rand();

        $data =
            array (
                "emailSubject" => "DocuSign API - Please sign " . $documentName,
                "documents" => array(
                    array("documentId" => "1", "name" => $documentName)
                ),
                "recipients" => array(
                    "signers" => array(
                        array(
                            "email" => $recipientEmail,
                            "name" => $recipientName,
                            "recipientId" => $recipientId,
                            "clientUserId" => $clientUserId,
                            "tabs" => array(
                                "signHereTabs" => array(
                                    array(
                                        "xPosition" => $signPos[0],
                                        "yPosition" => $signPos[1],
                                        "documentId" => "1",
                                        "pageNumber" => $signPos[2]
                                    )
                                ),
                                "dateSignedTabs" => array(
                                    array(
                                        "xPosition" => $signPos[3],
                                        "yPosition" => $signPos[4],
                                        "documentId" => "1",
                                        "pageNumber" => $signPos[2]
                                    )
                                )
                            )
                        )
                    )
                ),
                "status" => "sent"
            );
        $data_string = json_encode($data);
        $file_contents = file_get_contents($fileUrl);
        // Create a multi-part request. First the form data, then the file content
        $requestBody =
            "\r\n"
            ."\r\n"
            ."--myboundary\r\n"
            ."Content-Type: application/json\r\n"
            ."Content-Disposition: form-data\r\n"
            ."\r\n"
            ."$data_string\r\n"
            ."--myboundary\r\n"
            ."Content-Type:application/pdf\r\n"
            ."Content-Disposition: file; filename=\"$documentName\"; documentid=1 \r\n"
            ."\r\n"
            ."$file_contents\r\n"
            ."--myboundary--\r\n"
            ."\r\n";
        // Send to the /envelopes end point, which is relative to the baseUrl received above.
        $curl = curl_init($baseUrl . "/envelopes" );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestBody);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: multipart/form-data;boundary=myboundary',
                'Content-Length: ' . strlen($requestBody),
                "X-DocuSign-Authentication: $header" )
        );
        $json_response = curl_exec($curl); // Do it!
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        /*if ( $status != 201 ) {
            echo "Error calling DocuSign, status is:" . $status . "\nerror text: ";
            print_r($json_response); echo "\n";
            exit(-1);
        }*/
        $response = json_decode($json_response, true);
        $envelopeId = $response["envelopeId"];
        curl_close($curl);

//
// STEP 3 - get the embedded view
//
        $returnUrl = url("$backUrl?envelopeId=$envelopeId&ID=$contractId");
        $data = array("returnUrl" => $returnUrl,
            "authenticationMethod" => "None", "email" => $recipientEmail,
            "userName" => $recipientName, "recipientId" => $recipientId,"clientUserId" => $clientUserId
        );
        $data_string = json_encode($data);
        $curl = curl_init($baseUrl . "/envelopes/$envelopeId/views/recipient" );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                "X-DocuSign-Authentication: $header" )
        );

        $json_response = curl_exec($curl);
        $response = json_decode($json_response, true);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        /*if ( $status != 201 ) {
            echo "error calling webservice, status is:" . $status;
            echo "$json_response";
            exit(-1);
        }*/

        $url = $response["url"];
        header("Location: $url");
        exit();
    }

    public static function docuSignClientServicesWithDoc($fileUrl,$project,$positions=null){

        $documentName = explode("/",$fileUrl)[4];

        $header = "<DocuSignCredentials><Username>psu_docusign@ownmyinvention.com</Username><Password>PatentServicesUsaDocusign</Password><IntegratorKey>9c372baf-4fa3-441f-9b30-d63afd57c860</IntegratorKey></DocuSignCredentials>";
        $baseUrl = DocusignFunctions::docuSignGetBaseURL();
//
// STEP 2 - create and envelope with an embedded recipient
//
  /****************obtener los signers del documento.****************************/
        $data_string = DocusignFunctions::getSigners($documentName,$project,$positions);
  /*************************End of obtener signers********************************/

        $file_contents = file_get_contents($fileUrl);
        // Create a multi-part request. First the form data, then the file content
        $requestBody =
            "\r\n"
            ."\r\n"
            ."--myboundary\r\n"
            ."Content-Type: application/json\r\n"
            ."Content-Disposition: form-data\r\n"
            ."\r\n"
            ."$data_string\r\n"
            ."--myboundary\r\n"
            ."Content-Type:application/pdf\r\n"
            ."Content-Disposition: file; filename=\"$documentName\"; documentid=1 \r\n"
            ."\r\n"
            ."$file_contents\r\n"
            ."--myboundary--\r\n"
            ."\r\n";
        // Send to the /envelopes end point, which is relative to the baseUrl received above.
        $curl = curl_init($baseUrl . "/envelopes" );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestBody);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: multipart/form-data;boundary=myboundary',
                'Content-Length: ' . strlen($requestBody),
                "X-DocuSign-Authentication: $header" )
        );
        $json_response = curl_exec($curl); // Do it!
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        /*if ( $status != 201 ) {
            echo "Error calling DocuSign, status is:" . $status . "\nerror text: ";
            print_r($json_response); echo "\n";
            exit(-1);
        }*/
        $response = json_decode($json_response, true);
        $envelopeId = $response["envelopeId"];
        curl_close($curl);
        return $envelopeId;
    }

    public static function getTheEmbeddedView($documentName,$recipientEmail,$recipientName,$recipientId,$clientUserId,$envelopeId,$projectId,$last){
        $header = "<DocuSignCredentials><Username>psu_docusign@ownmyinvention.com</Username><Password>PatentServicesUsaDocusign</Password><IntegratorKey>9c372baf-4fa3-441f-9b30-d63afd57c860</IntegratorKey></DocuSignCredentials>";
        $baseUrl = DocusignFunctions::docuSignGetBaseURL();

        $returnUrl = url("launch/afterSignLegalDocs?PROYID=$projectId&ENVID=$envelopeId&DOCNAME=$documentName&LAST=$last");
        $data = array("returnUrl" => $returnUrl,
            "authenticationMethod" => "None", "email" => $recipientEmail,
            "userName" => $recipientName, "recipientId" => $recipientId,"clientUserId" => $clientUserId
        );
        $data_string = json_encode($data);
        $curl = curl_init($baseUrl . "/envelopes/$envelopeId/views/recipient" );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                "X-DocuSign-Authentication: $header" )
        );

        $json_response = curl_exec($curl);
        $response = json_decode($json_response, true);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        /*if ( $status != 201 ) {
            echo "error calling webservice, status is:" . $status;
            echo "$json_response";
            exit(-1);
        }*/

        $url = $response["url"];
        header("Location: $url");
        exit();
    }
}
