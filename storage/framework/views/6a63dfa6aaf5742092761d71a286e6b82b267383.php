<link href="<?php echo e(asset('/css/pdf.css')); ?>" rel="stylesheet">
<?php if($showMore==1): ?>
<!--page 1-->
    <br><br>
    <p align="center" style="font-weight: bold;font-size: 34px;"> WELCOME TO</p>
    <p align="center" class="padd_cover">
        <img src="<?php echo e(asset('/img/logos/logoWithoutBackground.png')); ?>" alt="" name="Object1" width="245" height="176" id="Object1" align="center">
        <br><i style="font-size: 34px;color: darkblue;">Giving the edge to Inventors!</i>
    </p>
    <p align="center" style="font-weight: bold;font-size: 34px;margin-top:60px;padding-bottom: 0px;margin-bottom: 0px;"> INVENTION INITIATIVE GUIDE</p>
    <p align="center" style="font-weight: bold;font-size: 34px;padding-top: 0px;margin-top: 0px;"> WELCOME PACKAGE</p>
    <p align="center" style="text-decoration: underline;font-weight: bold;margin-top: 60px;font-size: 18px;">Corporate Headquarters</p>
    <p align="center" style="font-weight: bold;font-size: 16px;">12000 Biscayne Boulevard, Suite 700<br>North Miami, Florida 33181</p>
    <div class="page-break"></div>
    <!--page 2-->
    <div class="page-break"></div>
    <!--page 3-->
    <p align="center" style="font-size: 24px;margin-bottom: 60px;">TABLE OF CONTENTS</p>
    <p align="left" class="pIndex">1. Table of Contents</p>
    <p align="left" class="pIndex">2. Welcome Cover Letter</p>
    <p align="left" class="pIndex">3. Our Mission Statement</p>
    <p align="left" class="pIndex">4. PATENT SERVICES USA: Patent Credibility</p>
    <p align="left" class="pIndex">5. PATENT SERVICES USA: Corporate Credibility</p>
    <p align="left" class="pIndex">6. FAQ's</p>
    <p align="left" class="pIndex">7. General Information Concerning Patents</p>
    <p align="left" class="pIndex">8. The Patent Process: From Application To Allowance To Issue</p>
    <p align="left" class="pIndex">9. Guide To The Patent Application Process</p>
    <p align="left" class="pIndex">10. Important Patent Information</p>
    <p align="left" class="pIndex">11. Financial and Confidential Agreement for Joint Ventures</p>
    <div class="page-break"></div>
    <!--page 4-->
    <div class="page-break"></div>
<?php endif; ?>
        <!--page 5-->
    <p align="center" class="padd_cover">
        <img src="<?php echo e(asset('/img/logos/logoWithoutBackground.png')); ?>" alt="" name="Object1" width="200" height="140" id="Object1" align="center">
    </p>
    <h3><strong>Thank you for your business</strong></h3>
    <p>
        Dear <?php echo e($project->lead->fname); ?>,
    </p>
    <p>
        I'd like to thank you for choosing Patent Services USA and becoming one of our valued clients.</p>
    <p>
        Patent Services is in the business of helping inventors succeed, we're happy that you've chosen our company
        in taking important steps towards making your Idea come alive.
    </p>
    <p>
        Your satisfaction is our priority. Attached you will find your Welcome Package and receipt.
    </p>
    <p>
        If you need any help understanding or have any questions please don't hesitate to contact us.
    </p>
    <p align="left" class="par1" style="margin-top:-5px;">
        <br><br>
        Sincerely,<br><br><br>
        Patent Services USA, Inc<br>
        12000 Biscayne Blvd., Suite 700<br>
        North Miami, FL 33181<br>
        1-888-344-6836<br>
        1-800-886-7951 (Fax)
    </p>
<div class="page-break"></div>

<!--page 6-->
<div class="page-break"></div>

<!--page 7-->
<p align="center" class="padd_cover">
    <img src="<?php echo e(asset('/img/logos/logoGrey.png')); ?>" alt="" name="Object1" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<p align="center" class="questions">
    <strong>Invention Initiative Guide Agreement</strong>
</p>
<p>Date: <?php echo e(date("Y-m-d")); ?><br>File Number: <?php echo e($project->lead->fileno); ?></p>
<p>Inventor Name: <?php echo e($project->lead->fname." ".$project->lead->lname); ?></p>
<p>Invention Title: <?php echo e($project->ideaName); ?></p>
<p>Dear <?php echo e($project->lead->fname); ?>,</p>
<p>This letter is to confirm our receipt of your last payment:</p>
<table  width="100%" cellspacing="10">
    <tr>
        <td> Amount Received: $<?php echo e(number_format($dataSF['Payment_Amount__c'],2,'.',',')); ?></td>
        <td>Amount Paid to Date: <?php echo e(number_format($dataSF['Amount_Paid_to_Date__c'],2,'.',',')); ?></td>
    </tr>
    <tr>
        <td> Payment Received Via: <?php echo e($dataSF['Payment_Type__c']); ?></td>
        <td>Balance Due: $0.00</td>
    </tr>
</table>
<p>Comments: <?php echo e($dataSF['CC_Auth_Code_Comments__c']); ?></p>
<p>If there is a balance due, please remit payment and <strong>SEND THIS ENTIRE FORM</strong> to Patent Services.</p>
<p>If you are paying by <strong>CHECK or MONEY ORDER</strong>, please write your file number in the memo portion and mail this form along with your payment.</p>
<p>If you are paying by <strong>CREDIT / DEBIT CARD</strong>, please complete all information below and return this form to us.</p>
<table width="100%" cellspacing="10">
    <tr>
        <td> [&nbsp;] AmEx</td>
        <td>[&nbsp;] Mastercard</td>
        <td> [&nbsp;] Visa</td>
        <td>[&nbsp;] Discover</td>
    </tr>
</table>
<p>Card Number: _____________________________________________________________________________________</p>
<p>Expiration Date: ______________________________ Amount Charged: $_____________________________________</p>
<p>Name as it appears on the card: _______________________________________________________________________</p>
<p>Cardholder Signature: _______________________________________________________________________________</p>
<p>If you have any questions or need additional assistance, please call your Consultant toll free at 1-888-344-6836. Thank you for your business and we look forward to serving you.</p>
<br>
<p><strong>Corporate Headquarters: 12000 Biscayne Boulevard Suite 700, North Miami, FL 33181</strong></p>
<div class="page-break"></div>
<?php if($showMore==1): ?>
<!--page 8-->
<div class="page-break"></div>
<!--page 9-->
<p align="center" class="padd_cover">
    <img src="<?php echo e(asset('/img/logos/logoWithoutBackground.png')); ?>" alt="" name="Object1" width="200" height="140" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<p align="center" class="wpSubTitle">
    OUR MISSION STATEMENT
</p>
<h3><strong>"To deliver exceptional value with a commitment that will<br><br>drive and support the global innovation process"</strong></h3>
<ul class="ulSquare">
    <li>
        <strong>WE ASSIST</strong> inventors with all of their new product invention ideas because they haven't had the time, background, or proper information to oversee their invention concept needs.
    </li>
    <li>
        <strong>WE STRIVE</strong> to establish and maintain long-term relationships. Our clients are those who want to benefit from our expertise, knowledge and full support staff. Our inventor clients range from private inventors to business owners, corporate executives, doctors, lawyers, nurses, teachers, contractors, electricians, homemakers and just about anyone with an idea!
    </li>
    <li>
        <strong>WE HAVE</strong> developed a unique program that includes:<br>
        <table width="100%">
            <tr>
                <td>* University-based market analysis</td>
                <td>* Patent and Trademark Searches</td>
            </tr>
            <tr>
                <td>* United States Patent Applications</td>
                <td>* European Patents</td>
            </tr>
            <tr>
                <td>* Trademark Applications</td>
                <td>* Copyright Protection</td>
            </tr>
            <tr>
                <td>* Marketing assistance to industry</td>
                <td>* Licensing Negotiations</td>
            </tr>
        </table>
    </li>
    <li><strong>WE ARE</strong> the professionals that inventors seek for guidance, support and results.</li>
</ul>
<h3 class="alignLeft">
   <strong>OUR PROGRAM PHILOSOPHY</strong>
</h3>
<ul>
    <li>
        <strong>WE EMPLOY</strong> an individual client-driven approach, which means the uniqueness of your invention idea is one of our primary concerns.
    </li>
    <li><strong>WE MAKE CERTAIN</strong> that you understand the entire process, which includes...
        <ul class="ulNone">
            <li>* Do you have a marketable product concept?</li>
            <li>* Patents, Trademarks, Copyrights.</li>
            <li>* Marketing and Licensing Negotiation Information - 100% Contingency Fee Basis!</li>
            <li>* From Risk to Rewards.</li>
        </ul>
    </li>
    <li><strong>WE UTILIZE</strong> exclusive, excellent and Independent resources available to us, which include...
        <ul class="ulNone">
            <li>* Registered Patent Attorneys.</li>
            <li>* Engineers - Qualified Technical Writers.</li>
            <li>* Bonded Patent drafstmen.</li>
            <li>* Fully Experienced Support Staff.</li>
        </ul>
    </li>
</ul>
<div class="page-break"></div>
<!--page 10-->

<p align="center" class="wpSubTitle">
    PATENT INFORMATION DEFINITIONS
</p>
<p>
    Obtaining a patent is a multi-faceted endeavor. It is highly recommended by the US Patent and Trademark Office that an inventor hire a qualified registered patent attorney to execute all patent related items. PATENT SERVICES USA provides all clients with a network of qualified registered patent attorneys who perform all services through the USPTO.
</p>
<p>
    The patent process is a system involving many legal terms, conditions, systems and procedures that must be properly followed, otherwise the patent will not be issued. In addition, there are various government fees associated with a patent. The first set of fees the USPTO requires is a combination of a filing fee, a search fee and an examination fee. When an inventor contracts with PATENT SERVICES USA, all filing, search and examination fees are included with the investment the inventor makes to PATENT SERVICES USA. In addition, a utility patent has issuance fee, publication fee and maintenance fees. Maintenance fees have intervals of: 3.5 years: $575.00, 7.5 years: $1,450.00, and 11.5 years: $2,405.00. The inventor will be responsible for issuance, publication and maintenance fee payments.
</p>
<p class="wpSubTitle alignLeft">
    UTILITY PATENT:
</p>
<p>
    A utility patent protects the way an article works or is used and does not protect the way an article looks. It may be granted for a machine, a process, an article of manufacture, a composition of matter, or an improvement thereof. To be patentable, the invention must be new, useful, and not be obvious to a person skilled in the art. However, a utility patent will not be granted on a useless device, on printed matter, on a method of doing business, or on a machine which will not operate, such as a perpetual motion device. A utility patent will last for twenty (20) years from the date of filing when granted. It is non-renewable. In addition, there are maintenance fees throughout the 20-year term of the patent.
</p>
<p class="wpSubTitle alignLeft">
    DESIGN PATENT:
</p>
<p>
    This is quite different. It is issued for any new, original, ornamental design for an article of manufacture. Thus, when a design patent is sought, only the appearance of the item is considered. It protects the way an article looks, and does not protect the way an article works or is used. The term is fourteen (14) years from issuance. It is non-renewable. There is no maintenance fees associated with a design patent.
</p>
<p class="wpSubTitle alignLeft">
    PROVISIONAL APPLICATION FOR PATENT:
</p>
<p>
    This is a relatively new program instituted by the USPTO. It was established in 1995 to help inventors file without a formal claim, oath or declaration, or prior art disclosures. It provides a means to establish an early effective filing date and allows the term "patent pending" to be applied. It is not a patent. It will last for one year from the date of the application. The inventor will have the right to upgrade to a utility patent before the expiration of the Provisional Application for Patent. It is non-renewable. There is only one fee to the USPTO for filing this application.
</p>
<p class="wpSubTitle alignLeft">
    EUROPEAN COMMUNITY DESIGN PATENT -EU
</p>
<p>
    As of April 2004, the Community Design Regulations of the European Nations have provided a vehicle for obtaining a Design Patent type coverage in every country of the European Union (see list of countries attached). The Community Design Registration (CDR) (as it is officially called) protects the appearance of a product or part of a product or its ornamentation. It may consist of lines, contours, colors, shapes, textures and/or materials of the product or its ornamentation. A "product" includes any industrial or handicraft item, including packaging, set-up, graphic symbols and typefaces. Matter such as smells, sounds or words will not qualify. Also excluded are immoral designs, designs of components that are hidden in normal use and designs that are dictated solely by function. New logos and graphic trademarks CAN BE PROTECTED. Cartoon characters can also be protected.
</p>

<!--page 11-->
<div class="page-break"></div>
<p>
    The CDR is obtained by filing a single application in the Office for Harmonization in the Internal Market (OHIM) through a patent office of an EU country. PATENT SERVICES USA., will refer a patent attorney for the client here in the U.S. who in turn submits it to a registered representative who is a member of the Patent Bar of any EU country. Our clients will only have contact with the referred patent attorney here in the U.S. Once the filing of the application by the patent attorney is complete, it automatically becomes a Community Design Registration (CDR).
</p>
<p>
    There are no limitations on who may apply for a CDR. The applications are similar to Design Patent Applications in the United States and are prepared in the same manner (drawings, descriptions, etc.). The language is English.
</p>
<p>
    After the Application has been filed, it is reviewed for formal matters. It is not examined for patentability. If the formal matters (such as proper descriptions, designations and representations) are accepted, the application will be formally published and listed. Once the Application is published and issued, the original date of application becomes the official date of filing and the invention is considered EU Patent Pending. After it is officially published, it becomes an official Community Design Patent.
</p>
<p>
    Once published, it will be enforceable against anyone in the EU. It carries the same weight and protection as a Design Patent here in the United States.
</p>
<p>
    The Community Design is effective for five-year periods. At the end of each five-year period, it must be renewed by paying a maintenance fee (see below) and is effective for a total of 25 years. As part of our service, PATENT SERVICES USA., the patent attorney and/or our company will send notices to the clients to advise them of upcoming maintenance fees to be paid. The maintenance fee payments and the publication fee are not included in the investment made to PATENT SERVICES USA and are the responsibility of the client. The fees paid to PATENT SERVICES USA., will include the registration fee.
</p>
<p class="wpSubTitle alignLeft">
    MAINTENANCE FEE SCHEDULE:
    <span style="text-decoration: none !important;font-size: 14px;"> (All fees listed are in Euros which fluctuate daily. You can use a rule of thumb of $1.30 per 1€.)</span><br>
    <ul class="ulNone">
        <li>First renewal: 90€</li>
        <li>Second renewal: 120€</li>
        <li>Third renewal: 150€</li>
        <li>Fourth renewal: 180€</li>
    </ul>
</p>
<p>
    There is a Late Renewal Fee Penalty of 25% of the corresponding fee if not paid by the inventor within two months of the due date.
</p>
<p class="wpSubTitle alignLeft">
    MEMBER STATES
</p>
<p>
    Austria, Belgium, Bulgaria, Cyprus, the Czech Republic, Denmark, Estonia, Finland, France, Germany, Greece, Hungary, Ireland, Italy, Liechtenstein, Luxembourg, Monaco, Netherlands, Poland, Portugal, Romania, Slovakia, Slovenia, Spain, Sweden, Switzerland, Turkey, United Kingdom of Great Britain and Northern Ireland.
</p>
<p>As you can see, the Community Design Patent — EU opens up new opportunities for inventors and should be used for patent protection in the European countries.</p>

<!--page 12-->
<div class="page-break"></div>
<p class="wpSubTitle alignLeft">
    PATENT SEARCH:
</p>
<p>
    An inventor should have a full patent search with a legal opinion of patentability from the official records of the USPTO before seeking a US patent. There are presently over six million issued US patents, and they are classified according to subject matter in one or more of some 125,000 different subject areas. In addition, millions of foreign patents are classified and included in the patent office records. When conducted by a competent professional, the accuracy of the search is ordinarily quite high, but owing to the vast body of available information, no guarantee of complete accuracy can ever be given in a US search. Only a registered patent attorney or agent may give a legal opinion regarding the patentability of the invention in view of the patent art discovered during the search. PATENT SERVICES USA will assign a registered patent attorney/agent to conduct a full patent search with legal opinion of patentability.
</p>
<p class="wpSubTitle alignLeft">
    THE U.S. FILING APPLICATION PROCESS:
</p>
<p>
    If the patent search and opinion are favorable, the next step is to file an application for a utility, design or provisional application for patent. Once the application is filed, but not before, the inventor may use the phrase "patent pending." This tells the public that an application is on file with the USPTO. The improper use of these terms is punishable by law. PATENT SERVICES USA and the assigned patent attorney/agent will provide all the services required to file the proper application on behalf of the inventor.
</p>
<p>
    Shortly after filing, the USPTO will issue a formal filing receipt identifying the application. The filing application is kept confidential in the USPTO and is not searchable. The inventor can then state "Patent Pending".
</p>
<p class="wpSubTitle alignLeft">
    PATENT SUMMARY:
</p>
<p>
    The invention process requires an investment in time, effort and financial resources. It is not a journey to be taken without proper planning or adequate financing. To portray the journey as anything else would be unrealistic or perhaps even dishonest. However, the journey can also be highly rewarding, both in terms of finance and experiences.
</p>
<p>
    Non-patented inventions are more often very difficult to sell or license to companies, especially to large corporations. Inventors who have ideas or inventions worth pursuing should insure that their invention is properly protected.
</p>
<p class="wpSubTitle alignLeft">
    TRADEMARKS
</p>
<p>
    A Trademark is a word, phrase, symbol, design, or a combination of the above, which identifies and
    distinguishes a particular source of the goods or services from those of others. A Service Mark is the same as a Trademark except
    that it identifies and distinguishes the source of the service rather than the product. Trademark rights can last indefinitely if the owner
    continues to use the mark to identify its goods or services. PATENT SERVICES USA and the assigned patent attorney/agent will provide all the services required
    to file the proper application on behalf of the inventor.
</p>
<p class="wpSubTitle alignLeft">
    COPYRIGHTS
</p>
<p>
    The United States Library of Congress has jurisdiction over the Copyright Office. A copyright is a form of protection provided by the laws of the United States (Title 17, U.S. Code)
    to the authors of "original works of authorship", including literary, dramatic, musical, artistic, and certain other intellectual works. The copyright registration is effective on the date that
    all required elements are received in the Copyright Office. For works created after January 1978, copyright protection will endure for the life of the author plus an additional 70 years.
    PATENT SERVICES USA and the assigned patent attorney/agent will provide all the services required to file the proper application on behalf of the inventor.
</p>

<!--page 13-->
<div class="page-break"></div>
<p align="center" class="padd_cover">
    <img src="<?php echo e(asset('/img/logos/logoWithoutBackground.png')); ?>" alt="" name="Object1" width="200" height="140" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<h3>
    CONFIDENTIAL AGREEMENT FOR JOINT VENTURE<br>&<br>FINANCIAL AGREEMENT - JOINT VENTURE
</h3>
<p>
    On the following pages, you will find two forms for your personal use. These forms are samples for you to use if you are seeking investors for your project.
    <ul class="ulDecimal">
        <li>Confidential Agreement for Joint Venture</li>
        <li>Financial Agreement - Joint Venture</li>
        <li>Investor Announcement</li>
        <li>Limited Private Offer</li>
    </ul>
</p>
<p>
    The first form is to be used as the confidentiality agreement between you and any investor(s). This form should be completed and signed before you provide any specific details of your invention to any individual.
</p>
<p>
    The second form is the actual financial agreement arrangement between you and any investor(s). Once completed and signed, this becomes the binding agreement between you and your investor(s).
</p>
<p>
    These forms are provided to <strong>you for your personal</strong> use and should not be returned to PATENT SERVICES USA.
</p>
<p class="wpSubTitle alignLeft">
    HELPFUL HINTS
</p>
<p>
    When negotiating with a potential investor, keep in mind the following rule of thumb: for every $1,000.00 an investor gives you, you give them 1% of your royalties. This is not a hard and fast rule. You can negotiate whatever you feel is in the best interest of both parties.
</p>
<p>
    Always complete and have both parties sign the Confidential Agreement before you provide details of your invention. This form, when signed, will prevent anyone from using your invention without your expressed written permission. This form is not to be used when negotiating with an interested manufacturer.
</p>
<p>
    Please understand that finding an investor is your responsibility. PATENT SERVICES USA cannot provide investors for you. However, your Invention Initiative Guide Consultant can make suggestions to you as to how to look for investors.
</p>

<!--page 14-->
<div class="page-break"></div>
<p class="wpSubTitle alignLeft">
    CONFIDENTIAL AGREEMENT FOR JOINT VENTURE
</p>
<p><strong>It is hereby mutually agreed between:</strong></p>
<p style="border-bottom: 1px solid black;"><span style="border-bottom: 3px solid white;">Inventor Name:</span></p>
<p style="border-bottom: 1px solid black;"><span style="border-bottom: 3px solid white;">Address:</span></p>
<p>City:____________________________________ State: ______________________________ Zip:_________________</p>
<p>and</p>
<p style="border-bottom: 1px solid black;"><span style="border-bottom: 3px solid white;">Joint Venture Name:</span></p>
<p style="border-bottom: 1px solid black;"><span style="border-bottom: 3px solid white;">Address:</span></p>
<p>City:____________________________________ State: ______________________________ Zip:_________________</p>
<p style="border-bottom: 1px solid black;"><span style="border-bottom: 3px solid white;">Title of the invention:</span></p>
<p>
    Upon disclosure of the invention to the joint venture:<br>
<ul class="ulDecimal">
    <li>Joint venture shall keep strictly confidential and shall not use nor disclose the above titled and described invention or any
        variation thereof, to any person, organization or corporation without the expressed written permission of the inventor.</li>
    <li>
        Joint venture agrees to acknowledge inventor as the claimed originator of the invention as titled and described
    </li>
</ul>
</p>
<p>Both Inventor and Joint venture agree to the terms stated above on this ____________ day of ____________ 201_____.</p>
<br>
<table cellspacing="10" width="100%">
    <tr>
        <td style="border-top: 1px solid;text-align: center !important;margin-bottom: 20px !important;">INVENTOR SIGNATURE</td>
        <td style="border-top: 1px solid;text-align: center !important;margin-bottom: 20px !important;">JOINT VENTURE SIGNATURE</td>
    </tr>
    <tr>
        <td style="border-top: 1px solid;text-align: center !important;margin-bottom: 20px !important;">WITNESS SIGNATURE</td>
        <td style="border-top: 1px solid;text-align: center !important;margin-bottom: 20px !important;">WITNESS SIGNATURE</td>
    </tr>
</table>

<!--page 15-->
<div class="page-break"></div>
<p class="wpSubTitle alignLeft">
    FINANCIAL AGREEMENT - JOINT VENTURE
</p>
<p><strong>It is hereby mutually agreed between:</strong></p>
<p style="border-bottom: 1px solid black;"><span style="border-bottom: 3px solid white;">Inventor Name:</span></p>
<p>And;</p>
<p style="border-bottom: 1px solid black;"><span style="border-bottom: 3px solid white;">Joint Venture Name:</span></p>
<ul style="list-style: decimal;" >
    <li>Venture agrees to contribute $ _______________ US dollars toward the invention idea in exchange for ___________ % of royalties or profits made thereon.</li>
    <li>Venture shall be entitled to earn royalties over a period of _____________ time or until venture has earned a top dollar return figure of $ _____________.</li>
    <li>Venture shall be kept informed by Inventor of any developments or agreements as they may occur.</li>
    <li>Venture shall not be liable for any additional contributions of funds unless he/she chooses and Inventor agrees to accept such additional contributions.</li>
    <li>Venture acknowledges that the funds he/she contributes are non-refundable and that it is not a loan or advancement to be repaid by Inventor to the venture.</li>
</ul>
<p>Both Inventor and Joint venture agree to the terms stated above on this ____________ day of ____________ 201_____.</p>
<br><br>
<table cellspacing="10" width="100%">
    <tr>
        <td style="border-top: 1px solid;text-align: center !important;margin-bottom: 20px !important;">INVENTOR SIGNATURE</td>
        <td style="border-top: 1px solid;text-align: center !important;margin-bottom: 20px !important;">JOINT VENTURE SIGNATURE</td>
    </tr>
    <tr>
        <td style="border-top: 1px solid;text-align: center !important;margin-bottom: 20px !important;">WITNESS SIGNATURE</td>
        <td style="border-top: 1px solid;text-align: center !important;margin-bottom: 20px !important;">WITNESS SIGNATURE</td>
    </tr>
</table>

<!--page 16-->
<div class="page-break"></div>
<p align="center" style="font-size: 24px;font-weight: bold;text-decoration: underline;">
    INVESTOR ANNOUNCEMENT
</p>
<p><strong>INVENTION NAME</strong></p>
<p>My name is ________________ and I have a new and exciting invention concept that I believe has a tremendous
    profit potential.
</p>
<p>The name of my invention is ____________________________________________ .</p>
<p>
    I am seeking investors who wish to share in the potential rewards of this project. Enclosed please find various documents that will help you to understand the process and requirements.
</p>
<p>
    The documents enclosed for your review are:<br>
<ul style="list-style: decimal;">
    <li><strong>Confidential Agreement for Joint Venture</strong>. This document establishes a proprietary
        agreement between us that you may not use the invention in any capacity without my written consent. It also allows me to provide you with the details of my project.
    </li>
    <li><strong>Financial Agreement for Joint Venture</strong>. This is the legal document between us establishing
        your investment and my responsibilities to you for your potential returns.
    </li>
    <li><strong>Limited Private Offer</strong></li>
</ul>
</p>
<p>
    Upon completion of your review and signature on item #1 listed above, we will discuss the details of my project.
</p>
<p>
    Thank you for your consideration in this business opportunity.
</p>
<br><br><br>
<table cellspacing="20">
    <tr>
        <td>Inventor signature: _________________________________</td>
        <td>Date: __________________________________________</td>
    </tr>
    <tr>
        <td>Print Name: ______________________________________</td>
        <td></td>
    </tr>
</table>

<!--page 17-->
<div class="page-break"></div>
<p align="center" style="font-size: 24px;font-weight: bold;">
    "Invention Title"
</p>
<p align="center" style="font-size: 14px;text-align: center;">
    By
</p>
<p align="center" style="font-size: 20px;font-style: italic;text-decoration: underline;">
    Inventor Name
</p>
<p align="center" style="font-size: 30px;text-align: center;">
    *********************************************<br>
    <span style="font-size: 24px;font-weight: bold;">Limited Private Offer</span><br>
    ********************************************
</p>
<p align="center" style="font-size: 13px;font-weight: bold;text-decoration: underline;">
    For the Acquisition of Intellectual Property
</p>
<p align="center" style="font-size: 16px;">
    RE: TO ACQUIRE A UNITED STATES AND/OR INTERNATIONAL PATENT
</p>
<p align="center" style="font-size: 16px;">
    Corporate Representation: PATENT SERVICES USA.
</p>
<p align="center" style="font-size: 30px;text-align: center;">
    ********************************************
</p>
<p align="center" style="font-size: 16px;font-weight: bold;text-decoration: underline;">
    Financial Requirements
</p>
<p>Total Amount required $ _________________________ .</p><br>
<p>Total Shares available: ___________________________ .</p><br>
<p>Price per share $ ________________________________ .</p>

<!--page 18-->
<div class="page-break"></div>
<p align="center" class="padd_cover">
    <img src="<?php echo e(asset('/img/logos/logoGrey.png')); ?>" alt="" name="Object1" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<p align="center" style="font-size: 20px;font-weight: bold;">
    PATENT SERVICES USA: PATENT CREDIBILITY
</p>
<p>We pride ourselves on our standards of quality, service and ethics. Our credibility and integrity are as important to us as they are to you. Therefore, you should know and understand who we are.</p>
<p>As you know, PATENT SERVICES USA is not an invention development/marketing broker or service. PATENT SERVICES USA services are specific in that we only provide inventors with private and / or university based market analysis and legal protection services through Registered Patent Attorneys / Agents.</p>
<p>We take pride in the fact that we are in full compliance with all state and federal laws relating to this industry. We strongly believe in maintaining credibility and positive client relationships. PATENT SERVICES USA maintains records pertaining to the services we provide our clients. Accordingly, we voluntarily make this disclosure.</p>
<p align="center" style="font-size: 20px;font-weight: bold;text-decoration: underline;">
    PATENT SERVICES USA LEGAL PROTECTION RESULTS
</p>
<p>The United States Patent and Trademark Office (USPTO) have very strict rules and regulations that we and all registered patent attorneys must adhere to. You can be completely assured that any and all patent attorneys referred to you through PATENT SERVICES USA for services are properly registered with the USPTO, and that they are as competent and professional as you will find. The following chart provides substantiation of our statement.</p>
<p>PATENT SERVICES USA refers clients to registered patent attorneys / agents for legal protection. An Independent published a sample of 500 clients referred by attorneys for patent and/or trademark services received the following results:</p>
<p><strong>PATENTS</strong>: 100% Requested patent protection services.<br>
    100% received a patent that have completed the patent process.<br>
    100% received a patent pending status as of this date that have not yet completed the process.<br>
    7.9% were recommended to modify their product in order to pursue patent protection.<br>
    0.2% was initially denied a patent by the USPTO, subsequently re-filed and were issued a patent.
</p>
<p>
    <strong>TRADEMARKS</strong>: 29.6% of the 500 sampled requested trademark services.<br>
    13.3% received trademark "USE" status.<br>
    86.7% received trademark "Intent-To-Use" status.<br>
    64.4% were recommended to modify the invention title to be able to acquire a trademark. <br>
    0 % has been rejected for a Trademark by the USPTO.
</p>

<!--page 19-->
<div class="page-break"></div>
<p align="center" class="padd_cover">
    <img src="<?php echo e(asset('/img/logos/logoGrey.png')); ?>" alt="" name="Object1" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<p align="center" style="font-size: 20px;font-weight: bold;text-decoration: underline;">
    METHOD OF OPERATION
</p>
<p>To help you achieve your goals, PATENT SERVICES USA has developed a two-stage program.</p>
<p>The first stage involves an independent market analysis and assessment. We outsource and deliver private and / or university-based market analysis to assess the merits of your invention idea. Our technical writers, engineers, registered patent attorneys, bonded patent draftsman, and our full support staff all work together to complete the analysis in your Invention Initiative Guide that you will be receiving soon.</p>
<p>The second phase (once your "Invention Initiative Guide" is complete) is designed to provide you with a comprehensive protection program of your invention idea. This may include a Utility Patent, Design Patent, Provisional Application for Patent, or an International Patent Application. It may also include a Trademark application and a Copyright application. The investment required for a U.S. protection program may range from as low as $2,000 to approximately $16,000, depending on the type of legal protection you may want or need. You will have several choices regarding the way your invention will be protected and the amount you wish to invest. Please note that if your patent search / legal opinion comes back with a negative review, PATENT SERVICES USA will not be able to assist you with legal protection. The licensing affiliates only work with products that have potential merit.</p>
<p>After you become "patent pending" you then will have the option of utilizing an affiliate licensing company, chosen at PATENT SERVICES USA discretion, who will submit your invention to the industry. They are responsible for educating and assisting you with all your marketing and licensing requirements. There is <strong>NO COST</strong> to you for licensing affiliate services. All affiliates work on a contingency fee basis and only earn money if a successful licensing agreement is negotiated for you on your behalf. Once again, in order to take advantage of a licensing affiliate program, an inventor must either have a patent or have a patent pending status originated through a PATENT SERVICES USA registered patent attorney or agent.</p>

<!--page 20-->
<div class="page-break"></div>
<p align="center" class="padd_cover">
    <img src="<?php echo e(asset('/img/logos/logoGrey.png')); ?>" alt="" name="Object1" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<p align="center" style="font-size: 20px;font-weight: bold;">
    PATENT SERVICES USA: CORPORATE INFORMATION
</p>
<p class="par1">Maintaining quality client relationships is vital to us all. Accordingly, we wish to provide you with important company information.</p>
<p class="par1">Corporate headquarters is located at 12000 Biscayne Boulevard, Suite 700, North Miami, Florida 33181. Here we process all new client information and develop the beginning stages of your workflow.</p>
<p class="par1">Once a new client's idea is registered at our headquarters, the workflow continues through various channels. Our staff assembles the documents obtained from our clients and creates a "Client File." The work for that client is then forwarded / outsourced to the professionals who work on the project and complete their assigned tasks. Our Client Services department coordinates all the activity of these professionals.</p>
<p align="center" style="font-size: 20px;font-weight: bold;text-decoration: underline;">
    PROFESSIONAL SERVICE PROVIDERS
</p>
<ul>
    <li><strong>PATENT ATTORNEYS, AGENTS and ADVISORS:</strong> Patent attorneys and agents who are registered to practice patent law before the United States Patent and Trademark Office (USPTO). They are qualified to handle all patent, trademark, and copyright related matters.</li>
    <li><strong>BONDED PATENT DRAFTSMEN:</strong> These draftsmen are the only ones in the profession who are "Bonded" and therefore allowed to communicate directly with patent office officials. PATENT SERVICES USA utilizes various Bonded Drafstmen who provide patent art for our clients.</li>
    <li><strong>UNIVERSITY:</strong> We utilize the services of an independent university to evaluate and assess new product concepts submitted to PATENT SERVICES USA.</li>
    <li><strong>TECHNICAL WRITERS:</strong> Professional writers with extensive backgrounds in business, technology and manufacturing develop background and descriptive information through their review, analysis and assessment of invention ideas.</li>
    <li><strong style="text-decoration: underline;color: darkblue">www.ownmyinvention.com:</strong> This website has been designed to provide inventors with a foundation for understanding and progressing with the development and commercialization of a new product. This site includes our confidential submission form, learning center and project management system providing inventors with cutting-edge, industry-leading tools for our client's success.</li>
</ul>

<!--page 21-->
<div class="page-break"></div>
<p align="center" style="font-size: 20px;font-weight: bold;text-decoration: underline;">
    THE PATENT PROCESS
</p>
<ul style="list-style: decimal">
    <li><strong>PATENT SERVICES USA administration department prepares all documents</strong><br>PROCESS:
        <ul>
            <li>PATENT SERVICES USA Administration prepares release documents to be sent to inventor for Registered Patent Attorney referral acceptance (if needed).</li>
            <li>Inventor returns approved referral letters to PATENT SERVICES USA .</li>
            <li>Administration provides referred patent attorney with all pertinent inventor/invention documentation to provide the legal prosecution of the patent.</li>
        </ul>
    </li>
    <li><strong>Documents received by Registered Patent Attorney</strong><br>PROCESS:
        <ul>
            <li>Patent attorney prepares paperwork for patent application process. Attorney prepares and completes patent search with legal opinion and sends the results to PATENT SERVICES USA.</li>
            <li>PATENT SERVICES USA INC. forwards the patent search results to the inventor.</li>
            <li>Inventor decides which US patent to pursue: utility or design.</li>
            <li>Inventor signs document for patent selection and returns to PATENT SERVICES USA who then provides patent attorney with the patent selected by the inventor.</li>
            <li>Patent attorney receives documents and begins the patent application process. Attorney will begin the EU Community Design Patent filing, if contracted for.</li>
        </ul>
        TIME:This time frame is approximately 3 to 4 months from the time PATENT SERVICES USA receives inventor's payment in full.
    </li>
    <li><strong>Patent Office Systems and Procedures</strong><br>PROCESS:
        <ul>
            <li>Patent Office receives patent application from the patent attorney.</li>
            <li>Pre-examination by the USPTO, which includes:
                <ul>
                    <li>Serial number assigned</li>
                    <li>Fees recorded</li>
                    <li>Tentative classification, and screened for security sensitive documents</li>
                    <li>Electronic scanning for pre-grant publication</li>
                    <li>Licensing and review</li>
                    <li>Administrative examination, data entry, filing receipt mailed </li>
                </ul>
            </li>
        </ul>
        TIME: Approximately 3 to 4 months at the Patent Office.
    </li>
    <li><strong>Patent Examination at the USPTO</strong><br>PROCESS:
        <ul>
            <li>Application assigned to examining unit, then to examiner. Classified for pre-grant publication. Examiner's first action.</li>
            <li>Applicant response. </li>
            <li>Second and subsequent examiner actions to final allowance or rejection.</li>
            <li>Applicant responses.</li>
            <li>USPTO examiner allowance or rejection.</li>
        </ul>
        TIME: This entire process can take anywhere from 2 years to 3 years based on USPTO time frames and activities.
    </li>
    <li><strong>Post-Examination at USPTO</strong><br>PROCESS:
        <ul>
            <li>Patent publication division: receipt and review of allowed case papers.</li>
            <li>Initial preparation and electronic data capture for printing and issue.</li>
            <li>File maintenance facility: match post-allowance papers and issue.</li>
            <li>Patent printed, issued and mailed to applicant.</li>
        </ul>
        TIME: This process at the USPTO should take between 2 to 3 months for completion.
    </li>
    <li>Applicant receives issued Patent from the USPTO. The Process is complete.</li>
</ul>
<div class="boxText">
    PLEASE NOTE THAT THE ABOVE TIME REFERENCES ARE ONLY APPROXIMATE. YOUR ACTUAL PROCESSING TIME MAY BE MORE OR LESS THAN INDICATED. IN ADDITION, THE ABOVE DOES NOT INCLUDE THE PROCESSING OF THE INTERNATIONAL PATENT APPLICATION UNDER THE PCT.
</div>

<!--page 22-->
<div class="page-break"></div>
<p align="center" style="font-size: 20px;font-weight: bold;text-decoration: underline;">
    FAQ'S
</p>
<p>
    <strong>Q. What is intellectual property?</strong><br>
    <strong>A. </strong>It is an imagination made real. It is ownership of a dream, an idea, an improvement that we can touch, see, hear, and feel. It is an asset just like your home, your car, or your bank account. Just like other property needs to be protected, so does intellectual property, and that is in the form of a patent.
</p>
<p>
    <strong>Q. What is a patent?</strong><br>
    <strong>A. </strong>A patent is a type of property right. It gives the patent holder the right, for a limited time, to exclude others from making, using, selling or importing the product that is patented. Any person who invents or discovers any new useful process, machine, manufacture, or composition of matter, or any new and useful improvement thereof, may obtain a patent. A patent cannot be obtained upon a mere idea, suggestion, or service related item. There are several types of patents.<br>
    <ul style="list-style: decimal">
        <li>Utility Patents</li>
        <li>Design Patents</li>
        <li>Plant Patents</li>
        <li>Provisional Application for Patents</li>
        <li>International Patent Applications — EU Community Design Patent<br>
            (See Important Patent Information section in this booklet for definitions)
        </li>
    </ul>
</p>
<p>
    <strong>Q. Who may apply for a patent?</strong><br>
    <strong>A. </strong>The patent laws of the United States make no discrimination with respect to citizenship of the inventor. Any inventor, regardless of his/her citizenship may apply for a patent. If two or more persons make an invention jointly, they apply for a patent as joint inventors. A person who makes a financial contribution is not a joint inventor and cannot be joined in the application.
</p>
<p>
    <strong>Q. What do the terms "patent pending" or "patent applied for" mean?</strong><br>
    <strong>A. </strong>They are terms used by a manufacturer, seller, inventor, or other owner of the rights to the product to inform the public that an application for patent on that product is on file in the USPTO. The law imposes a fine on those who use the terms falsely to deceive the public.
</p>
<p>
    <strong>Q. Do I need a patent attorney or can I do this on my own?</strong><br>
    <strong>A. </strong>The preparation of an application for patent and the conducting of the proceedings in the USPTO to obtain a patent requires the knowledge of patent law and rules and USPTO practices and procedures, as well as knowledge in the scientific or technical matters involved in the invention. Inventors may prepare their own application and file them at the USPTO themselves; HOWEVER, unless they are completely familiar with these matters, they may find considerable difficulty in obtaining their patent. It is strongly suggested that a registered patent attorney/agent prepare all the required patent documents and proceedings before the USPTO.
</p>
<p>
    <strong>Q. What is a patent search?</strong><br>
    <strong>A. </strong>It is simply a search of the files of the USPTO of issued patents. It helps the inventor learn what patents may already exist that are similar to or exactly to their own. (See Important Patent In formation).
</p>

<!--page 23-->
<div class="page-break"></div>
<p align="center" class="padd_cover">
    <img src="<?php echo e(asset('/img/logos/logoGrey.png')); ?>" alt="" name="Object1" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<p align="center" style="font-size: 20px;font-weight: bold;text-decoration: underline;">
    GUIDE TO THE APPLICATION PROCESS
</p>
<p>A patent application must include various necessary components before it can be deemed acceptable for examination by the United States Patent and Trademark Office (USPTO) as to its patentability.</p>
<p>
The specifications for a patent application, drawn up by the patent attorney, must include the following:
<ul style="list-style: decimal">
    <li>TITLE</li>
    <li>SUMMARY OF THE INVENTION</li>
    <li>DETAILED DESCRIPTION</li>
    <li>REFERENCE TO DRAWINGS</li>
    <li>CLAIMS (written descriptions)</li>
    <li>ABSTRACT OF DISCLOSURE (patent artwork)</li>
</ul>
</p>
<p>The process begins after the inventor obtains a patent search with legal opinion. The first step is the official filing of the patent application with the USPTO.</p>
<p>Applications filed and accepted as complete by the USPTO are assigned for examination to certain examiner groups depending on the subject matter of the application. The applications are taken up for examination in order of filing. It generally takes about 10 to 18 months for the application to be taken up for initial examination at the USPTO. This lengthy wait is due to the fact that there are over 100,000 applications per year filed, and there are only a limited number of patent examiners available at the USPTO. When it ultimately gets assigned to an examiner, the examination includes a study of the application itself to make sure it is in the proper form as per USPTO rules and regulations and that a search of the prior art (patent search) has been included.</p>
<p>Based on the results of this preliminary examination, the patent examiner notifies the applicant (through the patent attorney) in writing of the results of his examination. This notification is known as an Office Action.</p>
<p>Office Actions deal with all matters of form and prior art. They may be in the form of a rejection of either the application or of the claims. The examiner states his reasons for rejecting the application, and gives the inventor a certain time (about three months-which can be extended by paying a fee) to respond to the rejection. Based on this, the inventor is then provided the opportunity to amend the application in a manner which overcomes or corrects the rejection. This amendment is in the form of a written response altering the application and the claims as required and as permitted by USPTO rules. The response must point out exactly how the amendments overcome the rejection or it must point out how the examiner is in error.</p>
<p>After the response is received at the (USPTO, the Patent Examiner will review and reconsider his or her rejection. This process can take up to two months. If the response overcomes all of the rejections, the examiner will issue a Notice of Allowance stating that the application is in condition to become a patent. If the examiner is not convinced, he or she will issue another Office Action again rejecting the application with his or her reasons as to why it is rejected.</p>

<!--Page 24-->
<div class="page-break"></div>
<p>
    If rejected a second time, the inventor's recourse is to appeal to the Patent Office Board of Appeals. The appeal is a request to "go over the Examiner" for a decision.
    The Board will review the case and make its own decision. This decision can either agree with the Examiner, the inventor, or they can substitute their own decision.
</p>
<p>
    If the Board rejects the application, the inventor can appeal to the Court of Appeals for the Federal Circuit or to the District Court having jurisdiction over the USPTO.
    These courts can then review the case and have the power to issue a patent. If these courts also reject the application, the inventor must appeal to the Supreme Court for
    relief.
</p>
<p>
    Once a patent application is allowed, the inventor must pay the proper issue fee. The application is then published as a patent in about six months after the Issue fee is paid.
</p>
<p>
    The above process, in the normal course of time, can take 24 to 36 months to complete and have the inventor receive his/her patent.
</p>
<p align="center" class="padd_cover">
    <img src="<?php echo e(asset('/img/logos/image24.png')); ?>"  width="100" height="100" id="Object1" align="center">
</p>
<p align="center" class="wpSubTitle">
    USPTO Headquarters - Alexandria, Virginia
</p>
<?php endif; ?>