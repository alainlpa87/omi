<link href="<?php echo e(asset('/css/pdf.css')); ?>" rel="stylesheet">

<p align="center">
    <img src="<?php echo e(asset('/img/contracts/logo.png')); ?>" name="Logo" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<h3>SOLD REPORT INFORMATION SHEET</h3>
<h3>[ X ]ONLINE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo e($contract->type=="IIG"?" X ":""); ?>]IIG&nbsp;<?php echo e($contract->type=="IIG" && $contract->project->IigType() != ''?$contract->project->IigType():""); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo e($contract->type=="IMG"?" X ":""); ?>]IMG</h3>
<table class="tableSold">
    <tr>
        <th>File Number</th>
        <td><?php echo e($contract->project && $contract->project->lead ? $contract->project->lead->fileno." - ".$contract->project->id : ""); ?></td>

    </tr>
    <tr>
        <th>Inventor<br><br>Circle one:Mr. Mrs. Ms.</th>
        <td><?php echo e($contract->project && $contract->project->lead ?$contract->project->lead->fname." ".$contract->project->lead->lname:""); ?></td>
    </tr>
    <tr>
        <th>Co - Inventor<br><br>Circle one:Mr. Mrs. Ms.</th>
        <td><?php echo e($contract->project ? $contract->project->coInventor:""); ?></td>
    </tr>
    <tr>
        <th>Relationship Between Inventors</th>
        <td><?php echo e($contract->project ? $contract->project->coInventorRelation: ""); ?></td>
    </tr>
    <tr>
        <th>Name of Invention</th>
        <td><?php echo e($contract->project ? $contract->project->ideaName : ""); ?></td>
    </tr>
    <tr>
        <th>Street Address</th>
        <td><?php echo e($contract->project && $contract->project->lead ? $contract->project->lead->street :""); ?></td>
    </tr>
    <tr>
        <th>City, State, Zip Code</th>
        <td><?php echo e($contract->project && $contract->project->lead ? $contract->project->lead->city.", ".$contract->project->lead->state.", ".$contract->project->lead->zip : ""); ?></td>
    </tr>
    <tr>
        <th>Telephone</th>
        <td><?php echo e($contract->project && $contract->project->lead ? $contract->project->lead->phone : ""); ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?php echo e($contract->project && $contract->project->lead ? $contract->project->lead->email : ""); ?></td>
    </tr>
    <tr>
        <th>Date of Payment</th>
        <td><?php echo e($paidDate); ?></td>
    </tr>
    <tr>
        <th>Name of Phase 1 Consultant</th>
        <td><?php echo e($contract->project && $contract->project->consultant ? ucwords($contract->project->consultant->fname." ".$contract->project->consultant->lname) : ""); ?></td>
    </tr>
    <tr>
        <th>Name of Phase 2 Consultant</th>
        <td></td>
    </tr>
    <tr>
        <th>Personal Information:<br>(Married?Spouse Name?<br>Children?Job?Hobbies)</th>
       <td><?php echo e($personal_info); ?></td>
    </tr>
</table>
<table width="100%">
    <tr>
        <th class="thFirst">
            <p >Consultant Signature</p>
            <p style="margin-top: 25px;">Date</p>
        </th>
        <th class="thSecond">
            <div class="littleBOx1">
                <p>ADMIN USE ONLY</p>
                <div class="boxAdmin">
                    <p><?php echo e($admin_notes); ?></p>
                </div>
            </div>
        </th>
    </tr>
</table>
