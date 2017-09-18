<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  /**
  This Example shows how to authenticate a user using XML-RPC.
  Note that we are using the PEAR XML-RPC client and recommend others do as well.
  **/
ini_set("include_path", "../../../../../php");

  require_once "XML/RPC2/Client.php";

  try
  {

    $client = XML_RPC2_Client::create('http://api.benchmarkemail.com/1.3/');

      //xmlrpc_server_create
    $token = $client->login('rick@ownmyinvention.com', 'PsUsa33181');

    $contactLists = $client->listGet($token, "", 1, 100, "", "");

    foreach($contactLists as $rec) {
       echo $rec['sequence'] . "] List Name: " . $rec['listname'] . "(" . $rec['id'] . ")";
       echo "\t Contacts:" . $rec['contactcount'] . "\t Created Date: " . $rec['createdDate'] ;
       echo "\t Updated Date: " . $rec['modifiedDate'];
       echo "<br />";
       /*$deletedList = $client->listDelete( $token,$rec['id'] );
        if ( !$deletedList )
        {
            echo "Error!";
            echo "\n\tCode=".$client->errorCode;
            echo "\n\tMsg=".$client->errorMessage."\n";
            echo "<br />";
        }
        else
        {
            echo "Contact List Deleted \n";
            echo "<br />";
        }*/
    }

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }