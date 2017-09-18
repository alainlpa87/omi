<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//test routes
Route::any('test', array('as'=>'test','uses'=>'TestController@methodFour'));

//Intranet Controller
Route::get('readFromCSV', array('as'=>'readFromCSV','uses'=>'IntranetController@readFromCSV'));
Route::get('reassignLeadsAndSub', array('as'=>'reassignLeadsAndSub','uses'=>'IntranetController@reassignLeadsAndSub'));
Route::any('saveFromFile', array('as'=>'saveFromFile','uses'=>'IntranetController@saveFromFile'));
Route::get('createWP', array('as'=>'createWP','uses'=>'IntranetController@createWP'));
Route::get('unsubscribe', array('as'=>'unsubscribe','uses'=>'IntranetController@showUnsubscribePage'));
Route::post('unsubscribeNow', array('as'=>'unsubscribeNow','uses'=>'IntranetController@unsubscribeNow'));


/*Incoming LEADS Index*/
Route::any('incomingLeads',array('as'=>'incomingLeads','uses'=>'IncomingLeadController@index'));

//Lead
Route::any('leads',array('as'=>'leads','uses'=>'LeadController@index'));
Route::post('updateFlag',array('as'=>'updateFlag','uses'=>'LeadController@updateFlag'));
Route::post('updateNotes',array('as'=>'updateNotes','uses'=>'LeadController@updateNotes'));
Route::post('updateBasicDataLead',array('as'=>'updateBasicDataLead','uses'=>'LeadController@updateBasicDataLead'));
Route::post('deleteLead',array('as'=>'deleteLead','uses'=>'LeadController@deleteLead'));
Route::post('loadLeads',array('as'=>'loadLeads','uses'=>'LeadController@loadLeads'));
Route::post('loadLead',array('as'=>'loadLead','uses'=>'LeadController@loadLead'));
Route::post('restoreLead',array('as'=>'restoreLead','uses'=>'LeadController@restoreLead'));
Route::any('findLead',array('as'=>'findLead','uses'=>'LeadController@findLead'));
Route::post('needMoreLeads',array('as'=>'needMoreLeads','uses'=>'LeadController@needMoreLeads'));
Route::get('paintLead',array('as'=>'paintLead','uses'=>'PaintController@paintLead'));
Route::post('createNewLeadConsultant',array('as'=>'createNewLeadConsultant','uses'=>'LeadController@createNewLeadConsultant'));
Route::post('updateLogsLead',array('as'=>'updateLogsLead','uses'=>'LeadController@updateLogsLead'));
Route::post('getLeadMsgTemplate',array('as'=>'getLeadMsgTemplate','uses'=>'LeadController@getLeadMsgTemplate'));

/*Incoming SUBMISSIONS Index*/
Route::get('incomingProjects',array('as'=>'incomingProjects','uses'=>'IncomingProjectController@index'));

//vendors
Route::any('vendors',array('as'=>'vendors','uses'=>'VendorsController@index'));
Route::post('findProjectVendors',array('as'=>'findProjectVendors','uses'=>'VendorsController@findProjectVendor'));
Route::any('paintProjectVendors',array('as'=>'paintProjectVendors','uses'=>'PaintController@paintProjectVendors'));
Route::get('printBusinessVendors',array('as'=>'printBusinessVendors','uses'=>'VendorsController@printBusinessVendor'));
Route::post('completeProjectWriter',array('as'=>'completeProjectWriter','uses'=>'VendorsController@completeProjectWriter'));

//Admin
Route::any('admin',array('as'=>'admin','uses'=>'AdminController@index'));
Route::any('findLeadAdmin',array('as'=>'findLeadAdmin','uses'=>'AdminController@findLeadAdmin'));
Route::post('saveAdminNotes',array('as'=>'saveAdminNotes','uses'=>'AdminController@saveAdminNotes'));
Route::post('changeRequestStage',array('as'=>'changeRequestStage','uses'=>'AdminController@changeRequestStage'));
Route::post('adminDeleteLead',array('as'=>'adminDeleteLead','uses'=>'AdminController@adminDeleteLead'));
Route::post('adminCreateSub',array('as'=>'adminCreateSub','uses'=>'AdminController@adminCreateSub'));
Route::post('allConsultants',array('as'=>'allConsultants','uses'=>'AdminController@allConsultants'));
Route::post('reassignLead',array('as'=>'reassignLead','uses'=>'AdminController@reassignLead'));
Route::post('reassignAllLead',array('as'=>'reassignAllLead','uses'=>'AdminController@reassignAllLead'));
Route::post('reassignAllLeadWithSub',array('as'=>'reassignAllLeadWithSub','uses'=>'AdminController@reassignAllLeadWithSub'));
Route::post('createNewLeadAdmin',array('as'=>'createNewLeadAdmin','uses'=>'AdminController@createNewLeadAdmin'));
Route::post('findProjectAdmin',array('as'=>'findProjectAdmin','uses'=>'AdminController@findProjectAdmin'));
Route::any('paintProjectAdmin',array('as'=>'paintProjectAdmin','uses'=>'PaintController@paintProjectAdmin'));
Route::post('loadNewRequest',array('as'=>'loadNewRequest','uses'=>'AdminController@loadNewRequest'));
Route::post('loadNewContract',array('as'=>'loadNewContract','uses'=>'AdminController@loadNewContract'));
Route::post('saveSendContract',array('as'=>'saveSendContract','uses'=>'AdminController@saveSendContract'));
Route::post('saveAvailableForVendors',array('as'=>'saveAvailableForVendors','uses'=>'AdminController@saveAvailableForVendors'));
Route::get('printBusinessProfileAdmin',array('as'=>'printBusinessProfileAdmin','uses'=>'AdminController@printBusinessProfileAdmin'));
Route::get('printProjectAdmin',array('as'=>'printProjectAdmin','uses'=>'AdminController@printProjectAdmin'));

//fix problem page
Route::any('fix',array('as'=>'fix','uses'=>'FixController@index'));
Route::any('assignLead',array('as'=>'assignLead','uses'=>'FixController@assignLead'));
Route::any('fixContract',array('as'=>'fixContract','uses'=>'FixController@fixContract'));
Route::any('fixDuplicateProject',array('as'=>'fixDuplicateProject','uses'=>'FixController@fixDuplicateProject'));



// Super Admin
Route::any('superadmin',array('as'=>'superadmin','uses'=>'SuperAdminController@index'));
Route::post('loadDataConsultant',array('as'=>'loadDataConsultant','uses'=>'SuperAdminController@loadDataConsultant'));
Route::post('updateDataConsultant',array('as'=>'updateDataConsultant','uses'=>'SuperAdminController@updateDataConsultant'));

//Projects
Route::any('projects',array('as'=>'projects','uses'=>'ProjectController@index'));
Route::post('loadProjects',array('as'=>'loadProjects','uses'=>'ProjectController@loadProjects'));
Route::post('updateStageProject',array('as'=>'updateStageProject','uses'=>'ProjectController@updateStageProject'));
Route::post('updateApprovalNotesProject',array('as'=>'updateApprovalNotesProject','uses'=>'ProjectController@updateApprovalNotesProject'));
Route::post('updateInternalNotesProject',array('as'=>'updateInternalNotesProject','uses'=>'ProjectController@updateInternalNotesProject'));
Route::post('requestProject',array('as'=>'requestProject','uses'=>'ProjectController@requestProject'));
Route::post('moveToDateProject',array('as'=>'moveToDateProject','uses'=>'ProjectController@moveToDateProject'));
Route::get('printBusinessProfile',array('as'=>'printBusinessProfile','uses'=>'ProjectController@printBusinessProfile'));
Route::get('printProject',array('as'=>'printProject','uses'=>'ProjectController@printProject'));
Route::post('allowFundingProject',array('as'=>'allowFundingProject','uses'=>'ProjectController@allowFundingProject'));
Route::post('allowPPAProject',array('as'=>'allowPPAProject','uses'=>'ProjectController@allowPPAProject'));
Route::post('checkContractActionsProject',array('as'=>'checkContractActionsProject','uses'=>'ProjectController@checkContractActionsProject'));
Route::post('setPaymentProject',array('as'=>'setPaymentProject','uses'=>'ProjectController@setPaymentProject'));
Route::post('getMsgTemplate',array('as'=>'getMsgTemplate','uses'=>'ProjectController@getMsgTemplate'));
Route::post('resetPassword',array('as'=>'resetPassword','uses'=>'ProjectController@resetPassword'));
Route::post('findProject',array('as'=>'findProject','uses'=>'ProjectController@findProject'));
Route::post('deleteProject',array('as'=>'deleteProject','uses'=>'ProjectController@deleteProject'));
Route::post('restoreProject',array('as'=>'restoreProject','uses'=>'ProjectController@restoreProject'));
Route::post('updateNotesProject',array('as'=>'updateNotesProject','uses'=>'ProjectController@updateNotes'));
Route::post('requestNeedsMoreInfoReview',array('as'=>'requestNeedsMoreInfoReview','uses'=>'ProjectController@requestNeedsMoreInfoReview'));
Route::get('paintPortlet',array('as'=>'paintPortlet','uses'=>'PaintController@paintPortlet'));
Route::post('requestsys',array('as'=>'requestsys','uses'=>'ProjectController@requestAnswers'));
Route::post('lastPaidSys',array('as'=>'lastPaidSys','uses'=>'ProjectController@lastPaidSys'));
Route::post('updateInventionName',array('as'=>'updateInventionName','uses'=>'ProjectController@updateInventionName'));
Route::post('updateLogsProject',array('as'=>'updateLogsProject','uses'=>'ProjectController@updateLogsProject'));
Route::post('setPPAProject',array('as'=>'setPPAProject','uses'=>'ProjectController@setPPAProject'));
Route::post('allowHalfPricePPAProject',array('as'=>'allowHalfPricePPAProject','uses'=>'ProjectController@allowHalfPricePPAProject'));
Route::post('allowEcheckPayments',array('as'=>'allowEcheckPayments','uses'=>'ProjectController@allowEcheckPayments'));
Route::post('allowIigUpgrade',array('as'=>'allowIigUpgrade','uses'=>'ProjectController@allowIigUpgrade'));
Route::post('getProductionDates',array('as'=>'getProductionDates','uses'=>'ProjectController@getProductionDates'));

//Production
Route::any('production',array('as'=>'production','uses'=>'ProductionController@index'));
Route::post('findProjectProduction',array('as'=>'findProjectProduction','uses'=>'ProductionController@findProjectProduction'));
Route::any('paintProjectProduction',array('as'=>'paintProjectProduction','uses'=>'PaintController@paintProjectProduction'));
Route::get('printBusinessProduction',array('as'=>'printBusinessProduction','uses'=>'ProductionController@printBusinessProduction'));
Route::post('saveAttorney',array('as'=>'saveAttorney','uses'=>'ProductionController@saveAttorney'));
Route::post('saveShippingDate',array('as'=>'saveShippingDate','uses'=>'ProductionController@saveShippingDate'));
Route::post('sentToVendors',array('as'=>'sentToVendors','uses'=>'ProductionController@sentToVendors'));
Route::post('sendLetterOfEngagement',array('as'=>'sendLetterOfEngagement','uses'=>'ProductionController@sendLetterOfEngagement'));
Route::post('returnProject',array('as'=>'returnProject','uses'=>'ProductionController@returnProject'));
Route::post('completeProjectProduction',array('as'=>'completeProjectProduction','uses'=>'ProductionController@completeProjectProduction'));
Route::any('refundFilesProduction',array('as'=>'refundFilesProduction','uses'=>'ProductionController@refundFilesProduction'));
//Files
Route::post('loadFilesProject',array('as'=>'loadFilesProject','uses'=>'FileController@loadFilesProject'));
Route::post('saveFileAccess',array('as'=>'saveFileAccess','uses'=>'FileController@saveFileAccess'));
Route::post('loadFilesAdmin',array('as'=>'loadFilesAdmin','uses'=>'FileController@loadFilesAdmin'));
Route::post('loadFilesVendor',array('as'=>'loadFilesVendor','uses'=>'FileController@loadFilesVendor'));
Route::post('loadFilesAttCS',array('as'=>'loadFilesAttCS','uses'=>'FileController@loadFilesAttCS'));
Route::post('loadFilesILC',array('as'=>'loadFilesILC','uses'=>'FileController@loadFilesILC'));
Route::post('loadFilesManufacturer',array('as'=>'loadFilesManufacturer','uses'=>'FileController@loadFilesManufacturer'));
Route::post('loadFilesProduction',array('as'=>'loadFilesProduction','uses'=>'FileController@loadFilesProduction'));
Route::post('uploadFileAdmin',array('as'=>'uploadFileAdmin','uses'=>'FileController@uploadFileAdmin'));
Route::post('uploadFileVendors',array('as'=>'uploadFileVendors','uses'=>'FileController@uploadFileVendors'));
Route::post('uploadFileAttCS',array('as'=>'uploadFileAttCS','uses'=>'FileController@uploadFileAttCS'));
Route::post('uploadFileILC',array('as'=>'uploadFileILC','uses'=>'FileController@uploadFileILC'));
Route::post('uploadFileManufacturer',array('as'=>'uploadFileManufacturer','uses'=>'FileController@uploadFileManufacturer'));
Route::post('uploadFileProduction',array('as'=>'uploadFileProduction','uses'=>'FileController@uploadFileProduction'));
Route::post('deleteFiles',array('as'=>'deleteFiles','uses'=>'FileController@deleteFiles'));
Route::post('uploadFileLaunch',array('as'=>'uploadFileLaunch','uses'=>'FileController@uploadFileLaunch'));
Route::post('loadFilesLaunch',array('as'=>'loadFilesLaunch','uses'=>'FileController@loadFilesLaunch'));
Route::any('removeAttachment',array('as'=>'removeAttachment','uses'=>'FileController@removeAttachment'));
Route::any('getFiles',array('as'=>'getFiles','uses'=>'FileController@getFiles'));
Route::any('getRol',array('as'=>'getRol','uses'=>'FileController@getRol'));
Route::any('uploadFileILCVendors',array('as'=>'uploadFileILCVendors','uses'=>'FileController@uploadFileILCVendors'));
Route::any('loadFilesILCVendors',array('as'=>'loadFilesILCVendors','uses'=>'FileController@loadFilesILCVendors'));
Route::any('getAttachments',array('as'=>'getAttachments','uses'=>'FileController@getAttachments'));

//Cron Jobs
Route::any('resetLeadNoti',array('as'=>'resetLeadNoti','uses'=>'CronJobController@resetLeadNoti'));
Route::any('finishProjects',array('as'=>'finishProjects','uses'=>'CronJobController@finishProjects'));
Route::any('makeLeadsRobot',array('as'=>'makeLeadsRobot','uses'=>'CronJobController@makeLeadsRobot'));
Route::any('deleteImgAfter2daysWithoutPaid',array('as'=>'deleteImgAfter2daysWithoutPaid','uses'=>'CronJobController@deleteImgAfter2daysWithoutPaid'));
Route::any('deleteIigUpgradesAfter2WeeksWithoutPaid',array('as'=>'deleteIigUpgradesAfter2WeeksWithoutPaid','uses'=>'CronJobController@deleteIigUpgradesAfter2WeeksWithoutPaid'));
Route::any('sendUpgradeAfter7Days',array('as'=>'sendUpgradeAfter7Days','uses'=>'CronJobController@sendUpgradeAfter7Days'));
Route::any('sendUpgradeAfter1Days',array('as'=>'sendUpgradeAfter1Days','uses'=>'CronJobController@sendUpgradeAfter1Days'));
Route::any('sendWelcomePackages',array('as'=>'sendWelcomePackages','uses'=>'CronJobController@sendWelcomePackages'));
Route::any('changeWeek',array('as'=>'changeWeek','uses'=>'CronJobController@changeWeek'));
Route::any('updateStats',array('as'=>'updateStats','uses'=>'CronJobController@updateStats'));
Route::any('updateScores',array('as'=>'updateScores','uses'=>'CronJobController@updateScores'));
Route::any('vendorsProjectsLate',array('as'=>'vendorsProjectsLate','uses'=>'CronJobController@vendorsProjectsLate'));
Route::any('checkForOverDue',array('as'=>'checkForOverDue','uses'=>'CronJobController@checkForOverDue'));
Route::any('updateEmailPatentAppCronJob',array('as'=>'updateEmailPatentAppCronJob','uses'=>'CronJobController@updateEmailPatentAppCronJob'));
Route::any('raisePPA',array('as'=>'raisePPA','uses'=>'CronJobController@raisePPA'));
Route::any('reminderInvoice',array('as'=>'reminderInvoice','uses'=>'CronJobController@reminderInvoice'));
Route::any('emailDraftingStatus',array('as'=>'emailDraftingStatus','uses'=>'CronJobController@emailDraftingStatus'));
Route::any('takeOldLeadsToUseAsNew',array('as'=>'takeOldLeadsToUseAsNew','uses'=>'CronJobController@takeOldLeadsToUseAsNew'));
Route::any('assignOldLeadsAsNew',array('as'=>'assignOldLeadsAsNew','uses'=>'CronJobController@assignOldLeadsAsNew'));
Route::any('reminderAppOverdue',array('as'=>'reminderAppOverdue','uses'=>'CronJobController@reminderAppOverdue'));
Route::any('closedExpiredPCS',array('as'=>'closedExpiredPCS','uses'=>'CronJobController@closedExpiredPCS'));
Route::any('reminderPatentAppToAtt',array('as'=>'reminderPatentAppToAtt','uses'=>'CronJobController@reminderPatentAppToAtt'));
Route::any('reminderPatentAppReturned',array('as'=>'reminderPatentAppReturned','uses'=>'CronJobController@reminderPatentAppReturned'));
Route::any('reminderTMOrCRFiling',array('as'=>'reminderTMOrCRFiling','uses'=>'CronJobController@reminderTMOrCRFiling'));
Route::any('reminderPCTQuest',array('as'=>'reminderPCTQuest','uses'=>'CronJobController@reminderPCTQuest'));
Route::any('reminderBeforeExpProv',array('as'=>'reminderBeforeExpProv','uses'=>'CronJobController@reminderBeforeExpProv'));
Route::any('reminderIntroCall',array('as'=>'reminderIntroCall','uses'=>'CronJobController@reminderIntroCall'));
Route::any('sendAgreementExtension',array('as'=>'sendAgreementExtension','uses'=>'CronJobController@sendAgreementExtension'));
Route::any('checkILCVendorOverDue',array('as'=>'checkILCVendorOverDue','uses'=>'CronJobController@checkILCVendorOverDue'));
Route::any('checkWebsiteCompleted',array('as'=>'checkWebsiteCompleted','uses'=>'CronJobController@checkWebsiteCompleted'));




//Statistics Reports
Route::any('statistics',array('as'=>'statistics','uses'=>'StatsController@index'));
Route::post('consultantContractReport',array('as'=>'consultantContractReport','uses'=>'StatsController@consultantContractReport'));
Route::post('consultantSubmissionReport',array('as'=>'consultantSubmissionReport','uses'=>'StatsController@consultantSubmissionReport'));
Route::post('consultantSoldReport',array('as'=>'consultantSoldReport','uses'=>'StatsController@consultantSoldReport'));
Route::post('personalPH2ClosingRatio',array('as'=>'personalPH2ClosingRatio','uses'=>'StatsController@personalPH2ClosingRatio'));
Route::post('teamLeadPH2ClosingRatio',array('as'=>'teamLeadPH2ClosingRatio','uses'=>'StatsController@teamLeadPH2ClosingRatio'));
Route::post('leadsPerConsultantReport',array('as'=>'leadsPerConsultantReport','uses'=>'StatsController@leadsPerConsultantReport'));
Route::post('leadsCalled3DayIntervalReport',array('as'=>'leadsCalled3DayIntervalReport','uses'=>'StatsController@leadsCalled3DayIntervalReport'));
Route::post('leadsCalled3DayIntervalPerConsultantReport',array('as'=>'leadsCalled3DayIntervalPerConsultantReport','uses'=>'StatsController@leadsCalled3DayIntervalPerConsultantReport'));
Route::post('transactionPerConsultantReport',array('as'=>'transactionPerConsultantReport','uses'=>'StatsController@transactionPerConsultantReport'));
Route::post('transactionReport',array('as'=>'transactionReport','uses'=>'StatsController@transactionReport'));
Route::post('leadsBySourceReport',array('as'=>'leadsBySourceReport','uses'=>'StatsController@leadsBySourceReport'));
Route::post('projectBySourceReport',array('as'=>'projectBySourceReport','uses'=>'StatsController@projectBySourceReport'));
Route::post('ph1PaidBySourceReport',array('as'=>'ph1PaidBySourceReport','uses'=>'StatsController@ph1PaidBySourceReport'));
Route::post('leadWithProjectBySourceReport',array('as'=>'leadWithProjectBySourceReport','uses'=>'StatsController@leadWithProjectBySourceReport'));
Route::post('grossLeadsBySourceReport',array('as'=>'grossLeadsBySourceReport','uses'=>'StatsController@grossLeadsBySourceReport'));
Route::post('setPaymentCompleteProject',array('as'=>'setPaymentCompleteProject','uses'=>'StatsController@setPaymentCompleteProject'));
Route::post('projectsInFundingWithPayment',array('as'=>'projectsInFundingWithPayment','uses'=>'StatsController@projectsInFundingWithPayment'));
Route::post('deleteProjectsInFundingWithPayment',array('as'=>'deleteProjectsInFundingWithPayment','uses'=>'StatsController@deleteProjectsInFundingWithPayment'));
Route::post('callsPerHourPerConsultant',array('as'=>'callsPerHourPerConsultant','uses'=>'StatsController@callsPerHourPerConsultant'));
Route::post('monthlyMoneyReport',array('as'=>'monthlyMoneyReport','uses'=>'StatsController@monthlyMoneyReport'));
Route::post('monthlyReportSaveNotes',array('as'=>'monthlyReportSaveNotes','uses'=>'StatsController@monthlyReportSaveNotes'));
Route::any('monthlyMoneyReportCSV',array('as'=>'monthlyMoneyReportCSV','uses'=>'StatsController@monthlyMoneyReportCSV'));
Route::any('paymentInAndNotSentToVendor',array('as'=>'paymentInAndNotSentToVendor','uses'=>'StatsController@paymentInAndNotSentToVendor'));

//Stats
Route::any('stats',array('as'=>'stats','uses'=>'ScoreController@index'));
Route::post('consultantScores',array('as'=>'consultantScores','uses'=>'ScoreController@consultantScores'));
Route::post('consultantStats',array('as'=>'consultantStats','uses'=>'ScoreController@consultantStats'));
Route::any('consultantProduction',array('as'=>'consultantProduction','uses'=>'ScoreController@consultantProduction'));
Route::any('productionProgressReport',array('as'=>'productionProgressReport','uses'=>'ScoreController@productionProgressReport'));
Route::any('productionProgressReportCSV',array('as'=>'productionProgressReportCSV','uses'=>'ScoreController@productionProgressReportCSV'));

//Omi Projects (create Sub)
Route::any('sub',array('as'=>'sub','uses'=>'OmiProjectController@index'));
Route::any('newSub', function(){return view("omi.project.index",array());});
Route::post('continue1',array('as'=>'continue1','uses'=>'OmiProjectController@continue1'));
Route::post('continue2',array('as'=>'continue2','uses'=>'OmiProjectController@continue2'));
Route::post('continue3',array('as'=>'continue2','uses'=>'OmiProjectController@continue3'));
Route::post('submit',array('as'=>'submit','uses'=>'OmiProjectController@submit'));

//Launch (Launch Center)
Route::any('launch',array('as'=>'launch','uses'=>'LaunchController@index'));
Route::any('launch/profile',array('as'=>'launch/profile','uses'=>'LaunchController@profile'));
Route::post('launch/updateDataLead',array('as'=>'launch/updateDataLead','uses'=>'LaunchController@updateDataLead'));
Route::post('launch/updateDataProject',array('as'=>'launch/updateDataProject','uses'=>'LaunchController@updateDataProject'));
Route::post('launch/updateDataInventor',array('as'=>'launch/updateDataInventor','uses'=>'LaunchController@updateDataInventor'));
Route::post('launch/updateApprovalNotes',array('as'=>'launch/updateApprovalNotes','uses'=>'LaunchController@updateApprovalNotes'));
Route::any('launch/signLetterOfEngagement/{ID}',array('as'=>'launch/signLetterOfEngagement','uses'=>'LaunchController@signLetterOfEngagement'));
Route::any('launch/project/{ID}',array('as'=>'launch/project','uses'=>'LaunchController@loadProject'));
Route::any('launch/new',array('as'=>'launch/new','uses'=>'LaunchController@loadProject'));
Route::any('launch/sign/{ID}',array('as'=>'launch/sign','uses'=>'LaunchController@signContract'));
Route::any('launch/signBeforePaid/{ID}',array('as'=>'launch/signBeforePaid','uses'=>'LaunchController@signBeforePaid'));
Route::any('changePassword',array('as'=>'changePassword','uses'=>'LaunchController@changePassword'));
Route::post('launch/success',array('as'=>'success','uses'=>'LaunchController@signedContract'));
Route::post('launch/prepareDocusignContract',array('as'=>'prepareDocusignContract','uses'=>'LaunchController@prepareDocusignContract'));
Route::post('launch/signedPPAContract',array('as'=>'signedPPAContract','uses'=>'LaunchController@signedPPAContract'));
Route::post('launch/addPlan',array('as'=>'addPlan','uses'=>'LaunchController@addPlan'));
Route::any('launch/client_services/docs/{ID}',array('as'=>'launch/client_services/docs','uses'=>'LaunchController@showDocsCS'));
Route::any('approvePatentApp',array('as'=>'approvePatentApp','uses'=>'LaunchController@approvePatentApp'));
Route::any('returnPatentAppByClient',array('as'=>'returnPatentAppByClient','uses'=>'LaunchController@returnPatentAppByClient'));
Route::any('getAttachmentsLaunch',array('as'=>'getAttachments','uses'=>'LaunchController@getAttachmentsLaunch'));
Route::any('launch/removeAttachmentLaunch',array('as'=>'launch/removeAttachment','uses'=>'LaunchController@removeAttachmentLaunch'));
Route::any('sendEmailClient',array('as'=>'sendEmailClient','uses'=>'LaunchController@sendEmailClient'));
Route::any('launch/project/generateSignatureAgreement',array('as'=>'generateSignatureAgreement','uses'=>'LaunchController@generateSignatureAgreement'));

//Docusign Controller
Route::any('launch/afterSignLetterOfEng',array('as'=>'afterSignLetterOfEng','uses'=>'DocusignController@afterSignLetterOfEng'));
Route::any('launch/successDocusign',array('as'=>'signedContractDocusign','uses'=>'DocusignController@signedContractDocusign'));
Route::any('launch/afterSign',array('as'=>'afterSignDocusign','uses'=>'DocusignController@afterSignDocusign'));
Route::any('launch/afterSignPpa',array('as'=>'afterSignPpaDocusign','uses'=>'DocusignController@afterSignPpaDocusign'));
Route::any('launch/afterSignLegalDocs',array('as'=>'afterSignLegalDocs','uses'=>'DocusignController@afterSignLegalDocs'));

//Launch SandBox (Launch Center)
Route::any('launch_sandbox',array('as'=>'launch_sandbox','uses'=>'LaunchTestController@index'));
Route::any('launch_sandbox/profile',array('as'=>'launch_sandbox/profile','uses'=>'LaunchTestController@profile'));
Route::post('launch_sandbox/updateDataLead',array('as'=>'launch_sandbox/updateDataLead','uses'=>'LaunchTestController@updateDataLead'));
Route::post('launch_sandbox/updateDataProject',array('as'=>'launch_sandbox/updateDataProject','uses'=>'LaunchTestController@updateDataProject'));
Route::post('launch_sandbox/updateDataInventor',array('as'=>'launch_sandbox/updateDataInventor','uses'=>'LaunchTestController@updateDataInventor'));
Route::post('launch_sandbox/updateApprovalNotes',array('as'=>'launch_sandbox/updateApprovalNotes','uses'=>'LaunchTestController@updateApprovalNotes'));
Route::any('launch_sandbox/project/{ID}',array('as'=>'launch_sandbox/project','uses'=>'LaunchTestController@loadProject'));
Route::any('launch_sandbox/new',array('as'=>'launch_sandbox/new','uses'=>'LaunchTestController@loadProject'));
Route::any('launch_sandbox/sign/{ID}',array('as'=>'launch_sandbox/sign','uses'=>'LaunchTestController@signContract'));
Route::any('launch_sandbox/signBeforePaid/{ID}',array('as'=>'launch_sandbox/signBeforePaid','uses'=>'LaunchTestController@signBeforePaid'));
Route::any('launch_sandbox/changePassword',array('as'=>'launch_sandbox/changePassword','uses'=>'LaunchTestController@changePassword'));
Route::post('launch_sandbox/success',array('as'=>'launch_sandbox/success','uses'=>'LaunchTestController@signedContract'));
Route::any('launch_sandbox/signedPPAContract',array('as'=>'launch_sandbox/signedPPAContract','uses'=>'LaunchTestController@signedPPAContract'));
Route::any('launch_sandbox/client_services/docs/{ID}',array('as'=>'launch_sandbox/client_services/docs','uses'=>'LaunchTestController@showDocsCS'));
Route::any('launch_sandbox/clientServices/sign',array('as'=>'launch_sandbox/clientServices/sign','uses'=>'LaunchTestController@sign'));
//Payment Sanndbox
Route::any('payment_sandbox',array('as'=>'payment_sandbox','uses'=>'LaunchTestController@payment_sandbox'));
Route::post('process_sandbox',array('as'=>'process_sandbox','uses'=>'LaunchTestController@payment_process'));
Route::get('payment_sandbox/status/{ID}', array('as' => 'payment_sandbox/status','uses' => 'LaunchTestController@getPaymentStatus'));
Route::get('payment_sandbox/cancel/{ID}', array('as' => 'payment_sandbox/cancel','uses' => 'LaunchTestController@cancelPayment'));

//ATTORNEYS REPORT
Route::any('attReport',array('as'=>'attReport','uses'=>'AttorneyReportsController@index'));
Route::any('patentSearchProgressReport',array('as'=>'patentSearchProgressReport','uses'=>'AttorneyReportsController@patentSearchProgressReport'));
Route::any('patentSearchProgressReportCSV',array('as'=>'patentSearchProgressReportCSV','uses'=>'AttorneyReportsController@patentSearchProgressReportCSV'));
Route::any('cSReport',array('as'=>'cSReport','uses'=>'AttorneyReportsController@cSReport'));
Route::any('cSReportCSV',array('as'=>'cSReportCSV','uses'=>'AttorneyReportsController@cSReportCSV'));
Route::any('psaDdrReport',array('as'=>'psaDdrReport','uses'=>'AttorneyReportsController@psaDdrReport'));
Route::any('psaDdrReportCSV',array('as'=>'psaDdrReportCSV','uses'=>'AttorneyReportsController@psaDdrReportCSV'));
Route::any('pctAndEpo',array('as'=>'pctAndEpo','uses'=>'AttorneyReportsController@pctAndEpo'));
Route::any('pctAndEpoCSV',array('as'=>'pctAndEpoCSV','uses'=>'AttorneyReportsController@pctAndEpoCSV'));


//Payment
Route::any('payment',array('as'=>'payment','uses'=>'PaymentController@index'));
Route::post('process',array('as'=>'process','uses'=>'PaymentController@paymentProcess'));
Route::get('payment/status/{ID}', array('as' => 'payment/status','uses' => 'PaypalController@getPaymentStatus'));
Route::get('payment/cancel/{ID}', array('as' => 'payment/cancel','uses' => 'PaypalController@cancelPayment'));

//Test Authorize.Net Payments for connection like TLS 1.2
Route::post('processTestPayment',array('as'=>'processTestPayment','uses'=>'TestPaymentController@paymentProcess'));


//Common
Route::any('mailsys',array('as'=>'mailsys','uses'=>'CommonController@mailsys'));
Route::post('createAppointment',array('as'=>'createAppointment','uses'=>'CommonController@createAppointment'));
Route::any('loadAppointment',array('as'=>'loadAppointment','uses'=>'CommonController@loadAppointment'));
Route::any('loadAllAppointment',array('as'=>'loadAllAppointment','uses'=>'CommonController@loadAllAppointment'));
Route::get('showAppointment',array('as'=>'showAppointment','uses'=>'CommonController@showAppointment'));
Route::post('leaders',array('as'=>'leaders','uses'=>'CommonController@leaders'));
Route::post('setNameVM',array('as'=>'setNameVM','uses'=>'CommonController@setNameVM'));
Route::post('updateConsultantInfo',array('as'=>'updateConsultantInfo','uses'=>'CommonController@updateConsultantInfo'));
Route::any('loadInbox',array('as'=>'loadInbox','uses'=>'CommonController@loadInbox'));
Route::any('useExt',array('as'=>'useExt','uses'=>'CommonController@useExt'));
Route::any('loadInboxFromProject',array('as'=>'loadInboxFromProject','uses'=>'CommonController@loadInboxFromProject'));
Route::any('checkActivityUser',array('as'=>'checkActivityUser','uses'=>'CommonController@checkActivityUser'));
Route::any('shareNote',array('as'=>'shareNote','uses'=>'CommonController@shareNote'));
//Contract PDF Routes
Route::get('reviewPDF',array('as'=>'reviewPDF','uses'=>'PDFController@reviewPDF'));
Route::any('saveContract',array('as'=>'saveContract','uses'=>'PDFController@saveContract'));
Route::any('savePrintProject',array('as'=>'savePrintProject','uses'=>'PDFController@savePrintProject'));


/* Plivo Routes*/
/*call */
Route::any('callHome', 'PlivoController@callHome');
Route::any('idle',array('as'=>'idle','uses'=>'PlivoController@idle'));
Route::any('bossEnd',array('as'=>'bossEnd','uses'=>'PlivoController@bossEnd'));
Route::any('boss',array('as'=>'boss','uses'=>'PlivoController@boss'));
Route::any('dial',array('as'=>'dial','uses'=>'PlivoController@dial'));
Route::any('dialEnd',array('as'=>'dialEnd','uses'=>'PlivoController@dialEnd'));
Route::any('action',array('as'=>'action','uses'=>'PlivoController@action'));
/*hang */
Route::any('hanger',array('as'=>'hanger','uses'=>'PlivoController@hanger'));
Route::any('hangerEnd',array('as'=>'hangerEnd','uses'=>'PlivoController@hangerEnd'));
/*send SMS */
Route::any('smsOut',array('as'=>'smsOut','uses'=>'PlivoController@smsOut'));
/*activate and deactivate sms to consultant when they receive a lead */
Route::any('smsFromConsultant',array('as'=>'smsFromConsultant','uses'=>'PlivoController@smsFromConsultant'));
/*record voice message */
Route::any('vmBoss',array('as'=>'vmBoss','uses'=>'PlivoController@vmBoss'));
Route::any('setvm',array('as'=>'setvm','uses'=>'PlivoController@setvm'));
Route::any('surevm',array('as'=>'surevm','uses'=>'PlivoController@surevm'));
Route::any('getvm',array('as'=>'getvm','uses'=>'PlivoController@getvm'));
/*send voice message */
Route::any('sendvm',array('as'=>'sendvm','uses'=>'PlivoController@sendvm'));
Route::any('endSendvm',array('as'=>'endSendvm','uses'=>'PlivoController@endSendvm'));
/*record call */
Route::any('recordCallManager',array('as'=>'recordCallManager','uses'=>'PlivoController@recordCallManager'));
Route::any('recordCall',array('as'=>'recordCall','uses'=>'PlivoController@recordCall'));
Route::any('stopRecordCall',array('as'=>'stopRecordCall','uses'=>'PlivoController@stopRecordCall'));
/*Redirect Calls*/
Route::any('redirectCalls',array('as'=>'redirectCalls','uses'=>'PlivoController@redirectCalls'));
/*SMS IN*/
Route::any('smsIn',array('as'=>'smsIn','uses'=>'PlivoController@smsIn'));
/*SMS IN Test*/
Route::any('smsInAlain',array('as'=>'smsInAlain','uses'=>'PlivoController@smsInAlain'));
Route::any('smsOutAlain',array('as'=>'smsOutAlain','uses'=>'PlivoController@smsOutAlain'));
Route::any('mainInAlain',array('as'=>'mainInAlain','uses'=>'PlivoController@mainInIVR'));
Route::any('ivrAction',array('as'=>'ivrAction','uses'=>'PlivoController@ivrAction'));
Route::any('ivr3firstLetter',array('as'=>'ivr3firstLetter','uses'=>'PlivoController@ivr3firstLetter'));
/*incoming calls to de company */
Route::any('mainIn',array('as'=>'mainIn','uses'=>'PlivoController@mainIn'));
/*recording calls Manager*/
Route::any('recordCallsManager',array('as'=>'recordCallsManager','uses'=>'PlivoController@recordCallsManager'));
Route::any('deleteCall',array('as'=>'deleteCall','uses'=>'PlivoController@deleteCall'));
/*Library*/
Route::any('callLibrary',array('as'=>'callLibrary','uses'=>'PlivoController@callLibrary'));
Route::any('playLibrary',array('as'=>'playLibrary','uses'=>'PlivoController@playLibrary'));


/* EMAIL Routes*/
Route::post('submissionKit',array('as'=>'submissionKit','uses'=>'EmailController@submissionKit'));
Route::post('emailConsInfo',array('as'=>'emailConsInfo','uses'=>'EmailController@emailConsInfo'));
Route::post('tryingToReachYou',array('as'=>'tryingToReachYou','uses'=>'EmailController@tryingToReachYou'));
Route::post('nmi',array('as'=>'nmi','uses'=>'EmailController@nmi'));
Route::post('sendContract',array('as'=>'sendContract','uses'=>'EmailController@sendContract'));
Route::post('joinVentAgrmt',array('as'=>'joinVentAgrmt','uses'=>'EmailController@joinVentAgrmt'));
Route::post('sendLink',array('as'=>'sendLink','uses'=>'EmailController@sendLink'));
Route::any('sendContract',array('as'=>'sendContract','uses'=>'EmailController@sendContract'));
Route::any('sendPaymentNotificationToAdminDocusign',array('as'=>'sendPaymentNotificationToAdminDocusign','uses'=>'EmailController@sendPaymentNotificationToAdminDocusign'));
Route::any('sendPaymentNotificationToClient',array('as'=>'sendPaymentNotificationToClient','uses'=>'EmailController@sendPaymentNotificationToClient'));
Route::any('returnFileToVendor',array('as'=>'returnFileToVendor','uses'=>'EmailController@returnFileToVendor'));
Route::any('overdueFilesVendor',array('as'=>'overdueFilesVendor','uses'=>'EmailController@overdueFilesVendor'));
Route::any('emailClientServices',array('as'=>'emailClientServices','uses'=>'EmailController@emailClientServices'));
Route::any('emailDocToAtt',array('as'=>'emailDocToAtt','uses'=>'EmailController@emailDocToAtt'));
Route::any('emailPatentApp',array('as'=>'emailPatentApp','uses'=>'EmailController@emailPatentApp'));
Route::any('emailUpgLetter',array('as'=>'emailUpgLetter','uses'=>'EmailController@emailUpgLetter'));
Route::any('emailProvInvoice',array('as'=>'emailProvInvoice','uses'=>'EmailController@emailProvInvoice'));
Route::any('updateEmail',array('as'=>'updateEmail','uses'=>'EmailController@updateEmail'));
Route::any('emailUpDocToAtt',array('as'=>'emailUpDocToAtt','uses'=>'EmailController@emailUpDocToAtt'));
Route::any('emailDntReach',array('as'=>'emailDntReach','uses'=>'EmailController@emailDntReach'));
Route::any('emailPatentAppDraftingStatus',array('as'=>'emailPatentAppDraftingStatus','uses'=>'EmailController@emailPatentAppDraftingStatus'));
Route::any('emailILCOverdue',array('as'=>'emailILCOverdue','uses'=>'EmailController@emailILCOverdue'));
Route::any('emailReceivedILC',array('as'=>'emailReceivedILC','uses'=>'EmailController@emailReceivedILC'));
Route::any('emailPatentAppOverdue',array('as'=>'emailPatentAppOverdue','uses'=>'EmailController@emailPatentAppOverdue'));
Route::any('emailTrademarkLetter',array('as'=>'emailTrademarkLetter','uses'=>'EmailController@emailTrademarkLetter'));
Route::any('emailExpiredNotice',array('as'=>'emailExpiredNotice','uses'=>'EmailController@emailExpiredNotice'));
Route::any('emailExpiredToAttorney',array('as'=>'emailExpiredToAttorney','uses'=>'EmailController@emailExpiredToAttorney'));
Route::any('updateEmailAfterYear',array('as'=>'updateEmailAfterYear','uses'=>'EmailController@updateEmailAfterYear'));
Route::any('reminderAppToClient',array('as'=>'reminderAppToClient','uses'=>'EmailController@reminderAppToClient'));
Route::any('sendCoversheet',array('as'=>'sendCoversheet','uses'=>'EmailController@sendCoversheet'));
Route::any('emailPCTQuest',array('as'=>'emailPCTQuest','uses'=>'EmailController@emailPCTQuest'));
Route::any('emailReturnedApp',array('as'=>'emailReturnedApp','uses'=>'EmailController@emailReturnedApp'));
Route::any('reEmailPatentAppPack',array('as'=>'reEmailPatentAppPack','uses'=>'EmailController@reEmailPatentAppPack'));
Route::any('emailCoversheetToAtt',array('as'=>'emailCoversheetToAtt','uses'=>'EmailController@emailCoversheetToAtt'));
Route::any('trademarkActionEmail',array('as'=>'trademarkActionEmail','uses'=>'EmailController@trademarkActionEmail'));
Route::any('noFinalActionEmail',array('as'=>'noFinalActionEmail','uses'=>'EmailController@noFinalActionEmail'));
Route::any('finalActionEmail',array('as'=>'finalActionEmail','uses'=>'EmailController@finalActionEmail'));
Route::any('noticeAllowanceEmail',array('as'=>'noticeAllowanceEmail','uses'=>'EmailController@noticeAllowanceEmail'));
Route::any('trademarkAllowanceEmail',array('as'=>'trademarkAllowanceEmail','uses'=>'EmailController@trademarkAllowanceEmail'));
Route::any('emailPCTAgreement',array('as'=>'emailPCTAgreement','uses'=>'EmailController@emailPCTAgreement'));
Route::any('emailPCTApplication',array('as'=>'emailPCTApplication','uses'=>'EmailController@emailPCTApplication'));
Route::any('reminderAttBeforeProvExp',array('as'=>'reminderAttBeforeProvExp','uses'=>'EmailController@reminderAttBeforeProvExp'));
Route::any('ilcIntroPackgEmail',array('as'=>'ilcIntroPackgEmail','uses'=>'EmailController@ilcIntroPackgEmail'));
Route::any('textCourtesyEmail',array('as'=>'textCourtesyEmail','uses'=>'EmailController@textCourtesyEmail'));
Route::any('ilcNDATextEmail',array('as'=>'ilcNDATextEmail','uses'=>'EmailController@ilcNDATextEmail'));
Route::any('ilcNDAToClient',array('as'=>'ilcNDAToClient','uses'=>'EmailController@ilcNDAToClient'));
Route::any('industryBreakdownEmail',array('as'=>'industryBreakdownEmail','uses'=>'EmailController@industryBreakdownEmail'));
Route::any('introCallEmail',array('as'=>'introCallEmail','uses'=>'EmailController@introCallEmail'));
Route::any('sendWebsiteCodes',array('as'=>'sendWebsiteCodes','uses'=>'EmailController@sendWebsiteCodes'));
Route::any('reportIntroCall',array('as'=>'reportIntroCall','uses'=>'EmailController@reportIntroCall'));
Route::any('sendIlcSubEmail',array('as'=>'sendIlcSubEmail','uses'=>'EmailController@sendIlcSubEmail'));
Route::any('sendEmailFromClient',array('as'=>'sendEmailFromClient','uses'=>'EmailController@sendEmailFromClient'));
Route::any('emailTicket',array('as'=>'emailTicket','uses'=>'EmailController@emailTicket'));
Route::any('emailTicketClient',array('as'=>'emailTicketClient','uses'=>'EmailController@emailTicketClient'));
Route::any('emailClosedTicket',array('as'=>'emailClosedTicket','uses'=>'EmailController@emailClosedTicket'));
Route::any('responseFromPsuToClients',array('as'=>'responseFromPsuToClients','uses'=>'EmailController@responseFromPsuToClients'));
Route::any('sendDeclineEmailToManf',array('as'=>'sendDeclineEmailToManf','uses'=>'EmailController@sendDeclineEmailToManf'));
Route::any('sendExtensionEmail',array('as'=>'sendExtensionEmail','uses'=>'EmailController@sendExtensionEmail'));
Route::any('sendEmailToVendor',array('as'=>'sendEmailToVendor','uses'=>'EmailController@sendEmailToVendor'));
Route::any('sendEmailFromAttToCS',array('as'=>'sendEmailFromAttToCS','uses'=>'EmailController@sendEmailFromAttToCS'));
Route::any('responseFromILCToClients',array('as'=>'responseFromILCToClients','uses'=>'EmailController@responseFromILCToClients'));
Route::any('sendIntroCallILC',array('as'=>'sendIntroCallILC','uses'=>'EmailController@sendIntroCallILC'));
Route::any('sendUpdateRegardingILCWeb',array('as'=>'sendUpdateRegardingILCWeb','uses'=>'EmailController@sendUpdateRegardingILCWeb'));
Route::any('sendSeparationAbandoned',array('as'=>'sendSeparationAbandoned','uses'=>'EmailController@sendSeparationAbandoned'));
Route::any('sendSeparationClientRequest',array('as'=>'sendSeparationClientRequest','uses'=>'EmailController@sendSeparationClientRequest'));
Route::any('sendSeparationProv',array('as'=>'sendSeparationProv','uses'=>'EmailController@sendSeparationProv'));
Route::any('sendSeparationUtility',array('as'=>'sendSeparationUtility','uses'=>'EmailController@sendSeparationUtility'));
Route::any('sendIlcPatentedContract',array('as'=>'sendIlcPatentedContract','uses'=>'EmailController@sendIlcPatentedContract'));
Route::any('notifyVendorNewFile',array('as'=>'notifyVendorNewFile','uses'=>'EmailController@notifyVendorNewFile'));
Route::any('notifyVendorFileOverdue',array('as'=>'notifyVendorFileOverdue','uses'=>'EmailController@notifyVendorFileOverdue'));
Route::any('notifyFileBack',array('as'=>'notifyFileBack','uses'=>'EmailController@notifyFileBack'));
Route::any('notifyILCFileClosedByVendor',array('as'=>'notifyILCFileClosedByVendor','uses'=>'EmailController@notifyILCFileClosedByVendor'));
Route::any('notifyAppDelayToClient',array('as'=>'notifyAppDelayToClient','uses'=>'EmailController@notifyAppDelayToClient'));
Route::any('emailLetterOfEngagement',array('as'=>'emailLetterOfEngagement','uses'=>'EmailController@emailLetterOfEngagement'));
Route::any('contactUs',array('as'=>'contactUs','uses'=>'EmailController@contactUs'));
Route::any('emailToAttForCloseFile',array('as'=>'emailToAttForCloseFile','uses'=>'EmailController@emailToAttForCloseFile'));

/*Login Routes*/
Route::get('login',array('as'=>'login','uses'=>'LoginController@login'));
Route::post('login',array('as'=>'loginConsultant','uses'=>'LoginController@loginConsultant'));
Route::get('launch/login',array('as'=>'loginClient','uses'=>'LoginController@loginClient'));
Route::post('launch/login',array('as'=>'loginClientPost','uses'=>'LoginController@loginClientPost'));
Route::get('launch_sandbox/login',array('as'=>'loginClientTest','uses'=>'LoginController@loginClientTest'));
Route::post('launch_sandbox/login',array('as'=>'loginClientTestPost','uses'=>'LoginController@loginClientTestPost'));
Route::any('logout',array('as'=>'logout','uses'=>'LoginController@logout'));
Route::any('',array('as'=>'index','uses'=>'LoginController@index'));
Route::any('launch/resetPasswordFromLogin',array('as'=>'resetPasswordFromLogin','uses'=>'LoginController@resetPasswordFromLogin'));

/*Register Routes*/
Route::any('register',array('as'=>'register','uses'=>'RegisterController@index'));
Route::any('registerSuccess',array('as'=>'registerSuccess','uses'=>'RegisterController@registerSuccess'));
Route::any('savePassRegister',array('as'=>'savePassRegister','uses'=>'RegisterController@savePassRegister'));

//OMI Client Services
Route::any('launch/clientServices/sign',array('as'=>'launch/clientServices/sign','uses'=>'ClientServicesController@sign'));
Route::post('launch/clientServices/signed',array('as'=>'launch/clientServices/signed','uses'=>'ClientServicesController@signed'));
Route::post('launch/clientServices/createDocusignCSDocs',array('as'=>'launch/clientServices/createDocusignCSDocs','uses'=>'ClientServicesController@createDocusignCSDocs'));

/*Intranet ClientServices Routes */
Route::any('clientServices',array('as'=>'clientServices','uses'=>'IntranetClientServicesController@index'));
//Route::any('newClientServices',array('as'=>'newClientServices','uses'=>'IntranetClientServicesController@index2'));
Route::any('findProjectClientServices',array('as'=>'findProjectClientServices','uses'=>'IntranetClientServicesController@findProjectClientServices'));
Route::any('paintProjectClientServices',array('as'=>'paintProjectClientServices','uses'=>'PaintController@paintProjectClientServices'));
Route::any('checkTypeContract',array('as'=>'checkTypeContract','uses'=>'IntranetClientServicesController@checkTypeContract'));
Route::any('checkMailOnly',array('as'=>'checkMailOnly','uses'=>'IntranetClientServicesController@checkMailOnly'));
Route::any('selectAtt',array('as'=>'selectAtt','uses'=>'IntranetClientServicesController@selectAtt'));
Route::any('setSentDate',array('as'=>'setSentDate','uses'=>'IntranetClientServicesController@setSentDate'));
Route::any('checkPatentAppProcess',array('as'=>'checkPatentAppProcess','uses'=>'IntranetClientServicesController@checkPatentAppProcess'));
Route::any('setNumberPatentApp',array('as'=>'setNumberPatentApp','uses'=>'IntranetClientServicesController@setNumberPatentApp'));
Route::any('addProjectCS',array('as'=>'addProjectCS','uses'=>'IntranetClientServicesController@addProjectCS'));
Route::any('changedShow',array('as'=>'changedShow','uses'=>'IntranetClientServicesController@changedShow'));
Route::any('mergeFiles',array('as'=>'mergeFiles','uses'=>'IntranetClientServicesController@mergeFiles'));
Route::any('resendFile',array('as'=>'resendFile','uses'=>'IntranetClientServicesController@resendFile'));
Route::any('generateCSWelcomeLetterWithPSAandDDR',array('as'=>'generateCSWelcomeLetterWithPSAandDDR','uses'=>'IntranetClientServicesController@generateCSWelcomeLetterWithPSAandDDR'));
Route::any('generateEmptyDDR',array('as'=>'generateEmptyDDR','uses'=>'IntranetClientServicesController@generateEmptyDDR'));
Route::any('generateEmptyAgreementPSA',array('as'=>'generateEmptyAgreementPSA','uses'=>'IntranetClientServicesController@generateEmptyAgreementPSA'));
Route::any('generateEmptyCopyRQ',array('as'=>'generateEmptyCopyRQ','uses'=>'IntranetClientServicesController@generateEmptyCopyRQ'));
Route::any('alertNoSign',array('as'=>'alertNoSign','uses'=>'IntranetClientServicesController@alertNoSign'));
Route::any('reviewMergeFiles',array('as'=>'reviewMergeFiles','uses'=>'IntranetClientServicesController@reviewMergeFiles'));
Route::any('changeAtt',array('as'=>'changeAtt','uses'=>'IntranetClientServicesController@changeAtt'));
Route::any('uploadFileClientS',array('as'=>'uploadFileClientS','uses'=>'IntranetClientServicesController@uploadFileClientS'));
Route::any('sendFileClientSToAtt',array('as'=>'sendFileClientSToAtt','uses'=>'IntranetClientServicesController@sendFileClientSToAtt'));
Route::any('pendingPCTEPO',array('as'=>'pendingPCTEPO','uses'=>'IntranetClientServicesController@pendingPCTEPO'));
Route::any('sendUpgrade',array('as'=>'sendUpgrade','uses'=>'IntranetClientServicesController@sendUpgrade'));
Route::any('sendUpgradeOnlyPCT',array('as'=>'sendUpgradeOnlyPCT','uses'=>'IntranetClientServicesController@sendUpgradeOnlyPCT'));
Route::any('sendProvInvoice',array('as'=>'sendProvInvoice','uses'=>'IntranetClientServicesController@sendProvInvoice'));
Route::any('finishMsgCs',array('as'=>'finishMsgCs','uses'=>'IntranetClientServicesController@finishMsgCs'));
Route::any('saveNotes',array('as'=>'saveNotes','uses'=>'IntranetClientServicesController@saveNotes'));
Route::any('updateClientDetailsCs',array('as'=>'updateClientDetailsCs','uses'=>'IntranetClientServicesController@updateClientDetailsCs'));
Route::any('setPPADetails',array('as'=>'setPPADetails','uses'=>'IntranetClientServicesController@setPPADetails'));
Route::any('csDeleteNotes',array('as'=>'csDeleteNotes','uses'=>'IntranetClientServicesController@csDeleteNotes'));
Route::any('csSaveNotes',array('as'=>'csSaveNotes','uses'=>'IntranetClientServicesController@csSaveNotes'));
Route::any('pendingPatentAppF',array('as'=>'pendingPatentAppF','uses'=>'IntranetClientServicesController@pendingPatentAppF'));
Route::any('send3D',array('as'=>'send3D','uses'=>'IntranetClientServicesController@send3D'));
Route::any('received3D',array('as'=>'received3D','uses'=>'IntranetClientServicesController@received3D'));
Route::any('changeState',array('as'=>'changeState','uses'=>'IntranetClientServicesController@changeState'));
Route::any('reportAtt',array('as'=>'reportAtt','uses'=>'IntranetClientServicesController@reportAtt'));
Route::any('reportAttSelectMonth',array('as'=>'reportAttSelectMonth','uses'=>'IntranetClientServicesController@reportAttSelectMonth'));
Route::any('createLegalActivity',array('as'=>'createLegalActivity','uses'=>'IntranetClientServicesController@createLegalActivity'));
Route::any('editLegalAct',array('as'=>'editLegalAct','uses'=>'IntranetClientServicesController@editLegalAct'));
Route::any('getLegalAct',array('as'=>'getLegalAct','uses'=>'IntranetClientServicesController@getLegalAct'));
Route::any('deleteLegalAct',array('as'=>'deleteLegalAct','uses'=>'IntranetClientServicesController@deleteLegalAct'));
Route::any('sendReminderTMCR',array('as'=>'sendReminderTMCR','uses'=>'IntranetClientServicesController@sendReminderTMCR'));
Route::any('sendNewPasswordCs',array('as'=>'sendNewPasswordCs','uses'=>'IntranetClientServicesController@sendNewPasswordCs'));
Route::any('saveAppPendingRevision',array('as'=>'saveAppPendingRevision','uses'=>'IntranetClientServicesController@saveAppPendingRevision'));
Route::any('unCheckIlcAfterUpgrade',array('as'=>'unCheckIlcAfterUpgrade','uses'=>'IntranetClientServicesController@unCheckIlcAfterUpgrade'));
Route::any('sendTrademarkLetter',array('as'=>'sendTrademarkLetter','uses'=>'IntranetClientServicesController@sendTrademarkLetter'));
Route::any('saveTitleOfInvention',array('as'=>'saveTitleOfInvention','uses'=>'IntranetClientServicesController@saveTitleOfInvention'));
Route::any('saveIndustry',array('as'=>'saveIndustry','uses'=>'IntranetClientServicesController@saveIndustry'));
Route::any('beforeSendPatent',array('as'=>'beforeSendPatent','uses'=>'IntranetClientServicesController@beforeSendPatent'));
Route::any('closeUtilityExp',array('as'=>'closeUtilityExp','uses'=>'IntranetClientServicesController@closeUtilityExp'));
Route::any('sendDesignCoversheet',array('as'=>'sendDesignCoversheet','uses'=>'IntranetClientServicesController@sendDesignCoversheet'));
Route::any('sendUpgCoversheet',array('as'=>'sendUpgCoversheet','uses'=>'IntranetClientServicesController@sendUpgCoversheet'));
Route::any('findFilingR',array('as'=>'findFilingR','uses'=>'IntranetClientServicesController@findFilingR'));
Route::any('getDatesUpgC',array('as'=>'getDatesUpgC','uses'=>'IntranetClientServicesController@getDatesUpgC'));
Route::any('selectPatentType',array('as'=>'selectPatentType','uses'=>'IntranetClientServicesController@selectPatentType'));
Route::any('sendDesignCoversheetWithFile',array('as'=>'sendDesignCoversheetWithFile','uses'=>'IntranetClientServicesController@sendDesignCoversheetWithFile'));
Route::any('removeAlert',array('as'=>'removeAlert','uses'=>'IntranetClientServicesController@removeAlert'));
Route::any('sendTextIntroCall',array('as'=>'sendTextIntroCall','uses'=>'IntranetClientServicesController@sendTextIntroCall'));
Route::any('returnPatentAppByClientServices',array('as'=>'returnPatentAppByClientServices','uses'=>'IntranetClientServicesController@returnPatentAppByClientServices'));
Route::any('ignoreNotifyAppDelay',array('as'=>'ignoreNotifyAppDelay','uses'=>'IntranetClientServicesController@ignoreNotifyAppDelay'));


/*ILC Routes */
Route::any('ilc', array('as'=>'ilc','uses'=>'IlcController@index'));
Route::any('findProjectILC',array('as'=>'findProjectILC','uses'=>'IlcController@findProjectILC'));
Route::any('loadProjectsILC',array('as'=>'loadProjectsILC','uses'=>'IlcController@loadProjectsILC'));
Route::any('loadProjectPortlet',array('as'=>'loadProjectPortlet','uses'=>'IlcController@loadProjectPortlet'));
Route::any('sendIntroPackage',array('as'=>'sendIntroPackage','uses'=>'IlcController@sendIntroPackage'));
Route::any('paintProjectILC',array('as'=>'paintProjectILC','uses'=>'PaintController@paintProjectILC'));
Route::any('ilcSaveNotes',array('as'=>'ilcSaveNotes','uses'=>'IlcController@ilcSaveNotes'));
Route::any('createNoteManufacturer',array('as'=>'createNoteManufacturer','uses'=>'IlcController@createNoteManufacturer'));
Route::any('loadManufacturerNotes',array('as'=>'loadManufacturerNotes','uses'=>'IlcController@loadManufacturerNotes'));
Route::any('ilcDeleteNotes',array('as'=>'ilcDeleteNotes','uses'=>'IlcController@ilcDeleteNotes'));
Route::any('manufacturer',array('as'=>'manufacturer','uses'=>'IlcController@manufacturerCreateEdit'));
Route::any('loadManufacturer',array('as'=>'loadManufacturer','uses'=>'IlcController@loadManufacturer'));
Route::any('saveManufacturer',array('as'=>'saveManufacturer','uses'=>'IlcController@saveManufacturer'));
Route::any('deleteManufacturer',array('as'=>'deleteManufacturer','uses'=>'IlcController@deleteManufacturer'));
Route::any('saveIndustryILC',array('as'=>'saveIndustryILC','uses'=>'IlcController@saveIndustryILC'));
Route::any('addManufacturer',array('as'=>'addManufacturer','uses'=>'IlcController@addManufacturer'));
Route::any('removeManufacturer',array('as'=>'removeManufacturer','uses'=>'IlcController@removeManufacturer'));
Route::any('getManufacturersIndustry',array('as'=>'getManufacturersIndustry','uses'=>'IlcController@getManufacturersIndustry'));
Route::any('pendingIlc',array('as'=>'pendingIlc','uses'=>'IlcController@pendingIlc'));
Route::any('removePendingIntroCall',array('as'=>'removePendingIntroCall','uses'=>'IlcController@removePendingIntroCall'));
Route::any('sendCourtesyEmail',array('as'=>'sendCourtesyEmail','uses'=>'IlcController@sendCourtesyEmail'));
Route::any('loadSubInfo',array('as'=>'loadSubInfo','uses'=>'IlcController@loadSubInfo'));
Route::any('loadManufacturersFromClient',array('as'=>'loadManufacturersFromClient','uses'=>'IlcController@loadManufacturersFromClient'));
Route::any('updateClientDetailsILC',array('as'=>'updateClientDetailsILC','uses'=>'IlcController@updateClientDetailsILC'));
Route::any('checkDates',array('as'=>'checkDates','uses'=>'IlcController@checkDates'));
Route::any('changeDates',array('as'=>'changeDates','uses'=>'IlcController@changeDates'));
Route::any('selectCoordinator',array('as'=>'selectCoordinator','uses'=>'IlcController@selectCoordinator'));
Route::any('selectPatentStatus',array('as'=>'selectPatentStatus','uses'=>'IlcController@selectPatentStatus'));
Route::any('updateWebsiteInfo',array('as'=>'updateWebsiteInfo','uses'=>'IlcController@updateWebsiteInfo'));
Route::any('generateIlcPatentedContract',array('as'=>'generateIlcPatentedContract','uses'=>'IlcController@generateIlcPatentedContract'));
Route::any('sendPatentedContract',array('as'=>'sendPatentedContract','uses'=>'IlcController@sendPatentedContract'));
Route::any('setCallTradeshow',array('as'=>'setCallTradeshow','uses'=>'IlcController@setCallTradeshow'));
Route::any('sendIlcToVendor',array('as'=>'sendIlcToVendor','uses'=>'IlcController@sendIlcToVendor'));
Route::any('sendIlcBackToVendor',array('as'=>'sendIlcBackToVendor','uses'=>'IlcController@sendIlcBackToVendor'));



/*Attorney ClientServices Routes*/
Route::any('attClientServices',array('as'=>'attClientServices','uses'=>'AttorneyClientServicesController@index'));
Route::any('paintProjectAttCS',array('as'=>'paintProjectAttCS','uses'=>'PaintController@paintProjectAttCS'));
Route::get('printBusinessAttCS',array('as'=>'printBusinessAttCS','uses'=>'AttorneyClientServicesController@printBusinessAttCS'));
Route::post('findProjectAttCS',array('as'=>'findProjectAttCS','uses'=>'AttorneyClientServicesController@findProjectAttCS'));
Route::post('finishAttCS',array('as'=>'finishAttCS','uses'=>'AttorneyClientServicesController@finishAttCS'));
Route::any('reportAttVendors',array('as'=>'reportAttVendors','uses'=>'AttorneyClientServicesController@reportAttVendors'));
Route::any('reportAttSelectMonthVendors',array('as'=>'reportAttSelectMonthVendors','uses'=>'AttorneyClientServicesController@reportAttSelectMonthVendors'));
Route::any('approveOrRejectTMandCR',array('as'=>'approveOrRejectTMandCR','uses'=>'AttorneyClientServicesController@approveOrRejectTMandCR'));

/*CallsController routes */
Route::any('recordCalls',array('as'=>'recordCalls','uses'=>'CallController@index'));
Route::any('changeLibrary',array('as'=>'changeLibrary','uses'=>'CallController@changeLibrary'));
Route::any('changeDescription',array('as'=>'changeDescription','uses'=>'CallController@changeDescription'));

/*CallsController routes */
Route::any('campaign',array('as'=>'campaign','uses'=>'CampaignController@index'));
Route::any('submitCampaign',array('as'=>'submitCampaign','uses'=>'CampaignController@submitCampaign'));

/*TicketController routes */
Route::any('launch/showTickets',array('as'=>'showTickets','uses'=>'TicketController@showTickets'));
Route::any('launch/showCreateTicket',array('as'=>'showCreateTicket','uses'=>'TicketController@showCreateTicket'));
Route::any('launch/createTicket',array('as'=>'createTicket','uses'=>'TicketController@createTicket'));
Route::any('launch/createReply',array('as'=>'createReply','uses'=>'TicketController@createReply'));
Route::any('launch/closeTicket',array('as'=>'closeTicket','uses'=>'TicketController@closeTicket'));

/*TicketControllerPSU*/
Route::any('showTicketsToCS',array('as'=>'showTicketsToCS','uses'=>'TicketControllerPSU@showTicketsToCS'));
Route::any('showTicketsFromProject',array('as'=>'showTicketsFromProject','uses'=>'TicketControllerPSU@showTicketsFromProject'));
Route::any('createReplyPSU',array('as'=>'createReplyPSU','uses'=>'TicketControllerPSU@createReplyPSU'));
Route::any('paintTicketPSU',array('as'=>'paintTicketPSU','uses'=>'TicketControllerPSU@paintTicketPSU'));
Route::any('closeTicketPSU',array('as'=>'closeTicketPSU','uses'=>'TicketControllerPSU@closeTicketPSU'));
Route::any('paintTicket',array('as'=>'paintTicket','uses'=>'PaintController@paintTicket'));


/*routes to test the auxiliary table*/
Route::any('showAuxTable',array('as'=>'showAuxTable','uses'=>'IlcController@showAuxTable'));
Route::any('sortingByColumn',array('as'=>'sortingByColumn','uses'=>'IlcController@sortingByColumn'));

/*ILCVendorsController*/
Route::any('ilcVendors', array('as'=>'ilcVendors','uses'=>'IlcVendorsController@index'));
Route::any('paintProjectILCVendor',array('as'=>'paintProjectILCVendor','uses'=>'PaintController@paintProjectILCVendor'));
Route::any('findProjectILCVendors',array('as'=>'findProjectILCVendors','uses'=>'IlcVendorsController@findProjectILCVendors'));
Route::any('loadProjectPortletILCVendor',array('as'=>'loadProjectPortletILCVendor','uses'=>'IlcVendorsController@loadProjectPortletILCVendor'));
Route::any('afterUploadFileILCVendor',array('as'=>'afterUploadFileILCVendor','uses'=>'IlcVendorsController@afterUploadFileILCVendor'));

/////routes for new layout
Route::any('home', function(){
    return view("omi.land.index",array());
});

Route::any('inventor-assistance', function(){
    return view("omi.land.inventorAssistance",array());
});
Route::any('invention-help-assistance', function(){
    return view("omi.land.inventionHelp",array());
});
Route::any('invention-protection', function(){
    return view("omi.land.inventionProtection",array());
});
Route::any('patent-searching', function(){
    return view("omi.land.patentSearching",array());
});
Route::any('intellectual-property-protection', function(){
    return view("omi.land.intellectualProtection",array());
});
Route::any('patent-assistance', function(){
    return view("omi.land.patentAssistance",array());
});
Route::any('patenting', function(){
    return view("omi.land.patenting",array());
});
Route::any('patent-filing', function(){
    return view("omi.land.patentFiling",array());
});
Route::any('invention-licensing', function(){
    return view("omi.land.inventionLicensing",array());
});
Route::any('invention-marketing', function(){
    return view("omi.land.inventionMarketing",array());
});
Route::any('trade-shows',array('as'=>'trade-shows','uses'=>'landToolsController@tradeshows'));
Route::any('download-page', function(){
    return view("omi.land.download",array());
});
Route::any('about-us', function(){
    return view("omi.land.about",array());
});
Route::any('faq', function(){
    return view("omi.land.faq",array());
});
Route::any('badReviews', function(){
    return view("omi.land.badReviews",array());
});
Route::any('awardedPatents', function(){
    return view("omi.land.awardedPatents",array());
});
Route::any('licensing', function(){
    return view("omi.land.licensing",array());
});
Route::any('terms-and-conditions', function(){
    return view("omi.land.terms",array());
});
Route::any('legal', function(){
    return view("omi.land.legal",array());
});
Route::any('privacy', function(){
    return view("omi.land.privacy",array());
});
Route::any('learn/{TITLE}',array('as'=>'learnIndex','uses'=>'landToolsController@learnIndex'));
Route::any('learningArt',array('as'=>'learningArt','uses'=>'landToolsController@learningArt'));
Route::any('bbbReviews', function(){
    return view("omi.land.bbbReviews",array());
});

//laravel version
/*Route::get('laravel-version', function()
{
    $laravel = app();
    return "Your Laravel version is ".$laravel::VERSION;
});*/