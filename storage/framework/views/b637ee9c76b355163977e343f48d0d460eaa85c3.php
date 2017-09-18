<div style="border:2px solid #0372A0;font-family:Arial, Helvetica, sans-serif;font-size:12px">
    <div style="padding:5px 5px;color:#fff;font-weight:bold;background-color:#0372A0"><strong>Project</strong></div>
    <h3 style="font-family:Arial, Helvetica, sans-serif;font-size:18px;padding-left:8px;padding-bottom:5px;color:#0372A0;">Patent Services -<?php echo e($project->lead->fileno); ?> / <?php echo e($project->lead->leadSource); ?> / <?php echo e(ucwords($project->consultant->usr)); ?> / <?php echo e($project->updated_at); ?></h3>
    <div style="padding-top:10px;">
        <div style="border:1px solid #000;"><table border="0" cellspacing="2" cellpadding="4">
                <tr>
                    <td colspan="2"><b> Details </b></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Name : </strong><?php echo e(ucwords($project->lead->fname." ".$project->lead->lname)); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Address : </strong><?php echo e($project->lead->street." ".$project->lead->street2); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>City : </strong><?php echo e($project->lead->city); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>State : <?php echo e($project->lead->state); ?></strong></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Zip : </strong><?php echo e($project->lead->zip); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Email Address : </strong><?php echo e($project->lead->email); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Primary Phone : </strong><?php echo e($project->lead->phone); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Secondary Phone : </strong><?php echo e($project->lead->phone2); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Best Time to Call : </strong><?php echo e($project->lead->best); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Age : </strong><?php echo e($project->lead->age()); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Occupation : </strong><?php echo e($project->lead->occupation); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Any Third Party Authorized Contact : </strong></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Name of Invention : </strong><?php echo e($project->ideaName); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>In a few words,What does your idea do? (the concept) : </strong><?php echo e($project->ideaConcept); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Give us the details of your product\'s function and parts. (How does it work, materials, etc.): </strong><?php echo e($project->descIdea); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Tell us when and how you thought of your invention : </strong><?php echo e($project->hisIdea); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>What similar product is on the market now? (Similar, but not the same): </strong><?php echo e($project->similarProduct); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Why do you believe your idea is unique, different or better? : </strong><?php echo e($project->uniIdea); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>What PROBLEM does your idea solve? What are the advantages and benefits of your idea\'s solution?: </strong><?php echo e($project->propIdea); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>How much will it cost to produce your idea?: </strong><?php echo e($project->costSpend); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>How much would you pay for your idea at retail or wholesale?: </strong><?php echo e($project->payIdea); ?></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Consultant Name (if known) : </strong><?php echo e(ucwords($project->consultant->fname." ".$project->consultant->lname)); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.print();
    window.close();
</script>