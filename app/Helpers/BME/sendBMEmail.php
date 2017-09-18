<?php
/*error_reporting(E_ALL);
ini_set('display_errors','On');*/

require_once 'BMEAPI.class.php';

$type = $_REQUEST['TYPE'];
$email = urldecode($_REQUEST['EMAIL']);
//Login in Benchmark API
$api = new BMEAPI('rick@ownmyinvention.com', 'PsUsa33181', 'http://www.benchmarkemail.com/api/1.0');
if ($api->errorCode){
    echo "-1";
}

//create de list of contacts
$listName = "List".strtotime(date('Y-m-d H:i:s'));
$newListId = $api->listCreate($listName);
if (!$newListId){
    echo "-1";
}

//assign the contacts to the new list.
$details[0]["email"] = $email;
$details[0]["firstname"] = "";
$details[0]["lastname"] = "";
$numContactAdd = $api->listAddContacts($newListId, $details);
if (!$numContactAdd){
    echo "-1";
}

//encript email for Unregister
function encrypt($string) {
    $key = "Patent Service USA";
    $resultE = '';
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)+ord($keychar));
        $resultE.=$char;
    }
    return base64_encode($resultE);
}
$encript = encrypt($mailto);

//Select the body of the message
switch($type){
    case 'SUBKIT':
        $cons = $_REQUEST['CONNAME'];
        $ext = $_REQUEST['CONPHONE'];
        $body='<p style="text-align:justify;">Thanks for your interest in Patent Services USA.</p>
        <ul type="square">
          <li>A 5 star rated company by Google and 3rd party merchant reviews.</li>
          <li>Featured on Discovery Channel as the company to trust.</li>
          <li>Expert guest on the weekly radio show geared to assist and educate inventors.</li>
          <li>The host of Invent Palooza - an inaugural event where inventors network with industry leaders for Q&A and product presentation.</li>
          <li>The only Patent assistance company member of United Inventor Association a nonprofit organization that represents inventor’s best interest on Capitol Hill.</li>
        </ul>
        <p style="text-align:justify;">Thanks for your interest in Patent Services USA.  We received an online inquiry regarding a patent or idea, and we are happy to be of help.  Your inquiry is pre-registration within the largest network of independent inventors and intellectual property resources.  There\'s strength in numbers! We\'ve seen costs dropping as more inventors and industry professionals participate. Complete your registration <a href="'.url("register?EMAIL=&PHONE=").'">here</a>.</p>
        <p dir="ltr" style="text-align:justify;"><a href="'.url("files/omi/Patent-Services-Patent-Starter-Kit.pdf").'">Click Here</a> to get a copy of our Statement of Non-Disclosure and Confidential Submission Form. Use this form to get the important details of your idea on paper.</p>
        <p>To get things started more quickly, <a href="'.url("sub").'">click here to visit our secure Online Submission Form</a>.<br /></p>
        <p dir="ltr">If you are going to use the attached form, you can return it to us in 3 ways:</p>
        <p><strong>Print</strong> out the form to fill it in. Or, you can also use the free reader app to <strong>fill  in your answers on your computer or phone</strong> and <strong>save the changes</strong> without printing.</p>
        <p><a target="_blank" href="http://get.adobe.com/reader/">
         <img src="'.url("img/adobe.jpg").'" alt="" width="35" height="35" align="absmiddle" />
         </a><a target="_blank" href="http://get.adobe.com/reader/">DOWNLOAD FREE READER</a><br /></p>
        <p>Please send completed forms by fax, email or mail.<br>
             1. <strong>Fax</strong> to: <strong>1-800-886-7951</strong><br>
             2. <strong>Email </strong>to: admin@ownmyinvention.com<br>
             3. <strong> Mail </strong>to: </p>
        <p style="margin-left:20px;">Patent Services USA<br>12000 Biscayne Blvd<br>Suite 700<br>North Miami, FL 33181</p>
        <p style="text-align:justify;">We are happy to take your call.  We believe that knowledge is a powerful tool in our industry.  Visit our Learning Center to learn some basics about Patent Services and the intellectual property industry. Don\'t hesitate to call our toll-free number if you need assistance.</p>
        <p>A consultant is assigned to every inquiry to make sure an expert is available to answer questions and help with planning.  He is here to help! Take advantage of our No Consultation Cost policy and call me at any time. Here are his details:</p>
        <p>Consultant Name: '.ucwords($cons).'<br>Direct line: '.$ext.'<br></p>';
    break;
    case 'TTR':
        $body = '<p style="text-align: justify;">Thanks for contacting us about your patent needs. Recently, we made several
        attempts to contact you regarding the patent information you requested from us.<p>Your inquiry is important to us!  Please contact me directly at 888-344-6836.</p>
        <p style="text-align: justify;">You may also email updated contact details to us at admin@ownmyinvention.com. You
        may also proceed directly to our website at <a href="http://www.ownmyinvention.com">www.ownmyinvention.com</a> to learn more
        about Patent Services USA and to submit your new product idea for consideration by our team.</p><p>However you choose to proceed, we look forward to speaking with you soon.</p>';
    break;
    case 'NMI':
        $body = '<p>Thank you very much for submitting your invention to Patent Services USA, Inc. </p>
		<p style="text-align:justify;">We have reviewed the information you provided up to this point and determined that it is not yet sufficient to enable us to properly assess your invention idea in order to make a determination as to whether we can work with you in the development and protection of your product.</p>
		<p style="text-align:justify;">Your Patent Services Consultant will be contacting you to discuss how to provide further details on your new invention in a protected format. This information may include drawings or a more
		expansive product description to enable Patent Services to properly review your concept.</p>
		<p style="text-align:justify;">You may also go directly to our secured website, <a href="http://www.ownmyinvention.com">www.ownmyinvention.com</a> to provide further information relating to your invention on our confidential submission form. Or contact us
		directly by calling our toll-free number at 1-888-344-6836 between the hours of 9:00 AM and 9:00 PM EST.</p>
		<p style="text-align:justify;">We understand the careful thought you’ve invested into creating your product idea and we look forward to assisting you in reaching your fullest potential with the invention.</p><p dir="ltr">&nbsp;</p>';
    break;
    case 'INFO':
        $cons = $_REQUEST['CONNAME'];
        $ext = $_REQUEST['CONPHONE'];
        $body ='<p style="text-align: justify;">Thanks for looking into Patent Services. I\'ve been assigned as your consultant to offer some help and answer questions. Below are some important links that could help you get started: </p>
        <p  style="text-align: justify;">Visit  our website. Don\'t forget to check out some of the new videos on our homepage: <a href="http://www.ownmyinvention.com">www.ownmyinvention.com</a>. Request a FREE screening and quote on an idea, establish a Statement of Non-Disclosure and make a secure, confidential submission:</p>
        <p><a href="'.url("sub").'"> CLICK HERE</a></p>
        <p>I\'m here to help! Take advantage of our No Consultation Cost policy and call me at any time. Here are my details:</p>
        <p>Consultant Name: '.ucwords($cons).'<br>Direct line: '.$ext.'<br>Toll Free: 1-888-344-6836<br>Email: admin@ownmyinvention.com<br></p>';
    break;
    case 'JVA':
        $body = '<p style="text-align: justify;">It was a pleasure to speak with you. <a href="'.url("files/omi/Joint-Venture-Agreement.pdf").'">Click Here</a> to get a copy of the Document Joint Venture Agreements I mentioned to you.</p>
        <p  style="text-align: justify;">These documents are tools that can be used to work with potential investors.</p>
        <p  style="text-align: justify;">Please review the instructions and the attached documents. I look forward to speaking with you soon.</p>';
    break;
}
//Email template.
$HTML = '<html><body><div style="width:650px; border:3px solid #0372A0; background-color:#F6F0E8 padding: 10px;">
        <div style="padding:5px 5px;background-color:#fff;text-align: left"><img src="'.url("img/logos/logo2.png").'" width="299" height="56"/></div>
        <div style="font-family: Helvetica;padding:5px 5px;color:#fff; background-color:#292929;text-align: left"><italic><em>Giving the edge to inventors!</em></div>
        <div style="padding: 25px 10px 5px 10px;">
            <div style="font-family: arial;padding:10px 0 0 11px;">
                  <p>Dear Inventor</p>
                  '.$body.'
                  <p>Sincerely,</p><br />
                  <p>Patent Services USA<br>12000 Biscayne Blvd Suite 700<br>North Miami, FL 33181<br>Toll Free: 1-888-344-6836<br>Fax: 1-800-886-7951</p>
                  <p><a href="https://www.ownmyinvention.com">www.ownmyinvention.com</a></p>
            </div>
        </div>
        <div style="background-color: #64AED9;color:#fff;text-align: center;">
            <span style="color:#fff;font-family: arial;font-size: 17px;padding-top: 10px;display: block">Want to stay updated about the world of inventions and patents?<br/></span>
            <span style="color:#fff;font-family: arial;font-size: 15px;padding-top: 10px;display: block">Simply follow us on<br/></span>
            <span style="padding-top: 20px;display: block">
                <a target="_blank" href="http://www.facebook.com/PatentServicesUSA"><img style="vertical-align:middle;margin-left:10px;" src="http://images.benchmarkemail.com/client313147/image2462961.png"/></a>
                <a target="_blank" href="https://plus.google.com/+OwnMyInvention"><img style="vertical-align:middle;margin-left:10px;" src="http://images.benchmarkemail.com/client313147/image2462963.png"/></a>
                <a target="_blank" href="https://www.linkedin.com/company/patent-services-usa"><img style="vertical-align:middle;margin-left:10px;" src="http://images.benchmarkemail.com/client313147/image2462965.png"/></a>
                <a target="_blank" href="https://twitter.com/PatSvcUSA"><img style="vertical-align:middle;margin-left:10px;" src="http://images.benchmarkemail.com/client313147/image2462968.png"/></a>
                <a target="_blank" href="http://www.pinterest.com/PatSvcUSA"><img style="vertical-align:middle;margin-left:10px;" src="http://images.benchmarkemail.com/client313147/image2462966.png"/></a>
            </span>
            <span style="color:#fff;font-family: arial;font-size: 15px;padding-top: 1px;padding-bottom: 10px;display: block"><br/>and you will never miss an update!</span>
        </div>
        </div></body></html>';

//lo kite momentaneamente
$unsubscribe = '<span style="color:#fff;font-family: arial;font-size: 15px;padding-top: 1px;padding-bottom: 10px;display: block"><br/><a href="http://www.ownmyinvention.com/unsubscribe/?u='.$encript.'">Click here if you don\'t want to receive more this emails</a> </span>';

if($type == 'SUBKIT'){
    $cons = $_REQUEST['CONNAME'];
    $ext = $_REQUEST['CONPHONE'];
    $HTML =    '<html>
                <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#eeeeee"><br>
                    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01" style="font-family:Arial,Helvetica, sans-serif; color:#333; line-height:1.3em; font-size:14px; background:#FFF; border:1px solid #cccccc;">
	<tbody>
	<tr>
		<td colspan="3"><a href="https://www.ownmyinvention.com"><img src="'.url("img/omi/patent_01.jpg").'" width="600" height="268" alt=""></a></td>
	</tr>
	<tr>
		<td colspan="3"><a href="mailto:info@ownmyinvention.com"><img src="'.url("img/omi/patent_02.gif").'" width="600" height="92" alt=""></a></td>
	</tr>
	<tr>
		<td width="600" height="16" colspan="3">
          <img src="'.url("img/omi/spacer.gif").' " width="1" height="16" alt=""></td>
	</tr>
	<tr>
		<td width="35">
			<img src="'.url("img/omi/spacer.gif").'" width="35" height="1" alt=""></td>
		<td width="530" height="928"><p>Dear Inventor,</p>
              <p>Thank you for your interest in Patent Services USA. We received an online inquiry regarding your patent or idea, and we are happy to be of help. Your inquiry is pre-registration within the largest network of independent inventors and intellectual property resources. There\'s strength in numbers! As the industry leader working with inventors and industry professionals, we are able to pass on to you substantial savings. Complete your registration&nbsp;
              <a href="'.url("register").'" target="_blank">here</a>.</p>
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color:#eee; border-radius:10px; font-size:13px; border:1px solid #ccc;">
                <tbody>
                    <tr>
                        <td height="15" colspan="3" align="center" valign="middle" style="color:#069"><img src="'.url("img/omi/spacer.gif").'" width="1" height="8" alt=""><br>
                            <strong>WHY CHOOSE PATENT SERVICES USA</strong><br><img src="'.url("img/omi/spacer.gif").'" width="1" height="8" alt="">
                        </td>
                    </tr>
                    <tr>
                      <td>
                        <img src="'.url("img/omi/spacer.gif").'" width="10" height="1" alt="">
                      </td>
                      <td>
                          <ul type="square">
                            <li style="padding-bottom:8px">A <strong>5 star</strong> rated company by Google and 3rd party merchant reviews.</li>
                            <li style="padding-bottom:8px">Featured on Discovery Channel as the company to trust.</li>
                            <li style="padding-bottom:8px">Expert guest on a weekly radio show geared to assist and educate inventors.</li>
                            <li style="padding-bottom:8px">The host of Invent Palooza - an inaugural event where inventors network with industry leaders for Q&amp;A and product presentation.</li>
                            <li>The only Patent assistance company member of United Inventor Association a nonprofit organization that represents inventor’s best interest on Capitol Hill.	</li>
                          </ul>
                      </td>
                      <td><img src="'.url("img/omi/spacer.gif").'" width="15" height="1" alt=""></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="'.url("img/omi/spacer.gif").'" width="1" height="10" alt=""></td>
                    </tr>
                </tbody>
              </table>
              <p>Use our&nbsp;<a href="'.url("files/omi/Patent-Services-Patent-Starter-Kit.pdf").'" target="_blank">Statement of Non-Disclosure and Confidential Submission Form</a>&nbsp;to get the important details of your idea on paper.</p>
              <p>To get things started more quickly,&nbsp;<a href="'.url("sub").'" target="_blank">visit our secure Online Submission Form</a>.</p>
              <p>If you are going to use the attached form, you can return it to us in 3 ways:</p>
              <p><strong>Print</strong>&nbsp;out the form to fill it in. Or, you can also use the free reader app to&nbsp;<strong>fill in your answers on your computer or phone</strong>&nbsp;and&nbsp;<strong>save the changes</strong>&nbsp;without printing.</p>
              <p> Please send completed forms by fax, email or mail.&nbsp;</p>
              <ol>
                <li><strong>Fax</strong>&nbsp;to:&nbsp;<a href="tel:1-800-886-7951" target="_blank"><strong>1-800-886-7951</strong></a>&nbsp;<br>
                </li>
                <li><strong>Email&nbsp;</strong>to:&nbsp;<a href="mailto:admin@ownmyinvention.com" target="_blank">admin@ownmyinvention.com </a>&nbsp;<br>
                </li>
                <li><strong>Mail&nbsp;</strong>to: Patent Services USA&nbsp;,12000 Biscayne Blvd, <br>
                Suite 700, North Miami, FL 33181</li>
              </ol>
              <p>We are happy to take your call. We believe that knowledge is a powerful tool in our industry. Visit our Educational Center to learn some basics about Patent Services and the intellectual property industry. Don\'t hesitate to call our toll-free number if you need assistance.</p>
              <p>A consultant is assigned to every inquiry to make sure an expert is available to answer questions and help with planning. We are here to help! Take advantage of our NO COST consultation and call your consultant at any time. Here are their details:</p>
              <p>Consultant Name: '.ucwords($cons).'<br>Direct line: '.$ext.'<br></p>
              <p>Easy Guide To Protecting Your invention.<a href="'.url("files/omi/IMPORTANCEOFINTELLECTUALPROPERTYPROTECTION.pdf").'" target="_blank">[E-BOOK]</a>&nbsp;</p>
              <p>Sincerely,<br>
              <em>        Patent Services USA&nbsp;</em><br>12000 Biscayne Blvd Suite 700<br>North Miami, FL 33181<br>Phone: 1-888-344-6836<br>Fax: 1-800-886-7951</p>
                  <p><a href="https://www.ownmyinvention.com">www.ownmyinvention.com</a></p>
              <p><img src="'.url("img/omi/patent_07.gif").'" width="530" height="70"></p>
	    </td>
		<td width="35">
			<img src="'.url("img/omi/spacer.gif").'" width="35" height="1" alt=""></td>
	</tr>
	<tr>
		<td width="600" height="26" colspan="3">
			<img src="'.url("img/omi/spacer.gif").'" width="1" height="26" alt=""></td>
	</tr>
</tbody></table>
                </body>
                </html>';
}

//creating the email.
$emailDetails["fromName"] = "Patent Services USA";
$emailDetails["fromEmail"] = "info@ownmyinvention.com";
$emailDetails["emailName"] = $type."_2.0_".strtotime(date('Y-m-d H:i:s'));
$emailDetails["replyEmail"] = "info@ownmyinvention.com";
$emailDetails["subject"] = 'Patent Services USA';
$emailDetails["templateContent"] = $HTML;
$emailDetails["webpageversion"]="true";

$emailDetails["toListID"] =  intval($newListId);
$newEmailId = $api->emailCreate($emailDetails);
if (!$newEmailId){
    echo "-1";
}
//sending email.
$sent = $api->emailSendNow($newEmailId);
if (!$sent){
    echo "-1";
}else{
    echo "1";
}
