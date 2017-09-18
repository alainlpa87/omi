<div style="border:2px solid #0372A0;font-family:Arial, Helvetica, sans-serif;font-size:12px">
    <div style="padding:5px 5px;color:#fff;font-weight:bold;background-color:#0372A0"><strong>Project</strong></div>
    <h3 style="font-family:Arial, Helvetica, sans-serif;font-size:18px;padding-left:8px;padding-bottom:5px;color:#0372A0;">Patent Services -{{$project->lead->fileno}} / {{$project->lead->leadSource}} / {{ucwords($project->consultant->usr)}} / {{$project->updated_at}}</h3>
    <div style="padding-top:10px;">
        <div style="border:1px solid #000;"><table border="0" cellspacing="2" cellpadding="4">
                <tr>
                    <td colspan="2"><b> Details </b></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Name : </strong>{{ucwords($project->lead->fname." ".$project->lead->lname)}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Address : </strong>{{$project->lead->street." ".$project->lead->street2}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>City : </strong>{{$project->lead->city}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>State : {{$project->lead->state}}</strong></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Zip : </strong>{{$project->lead->zip}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Email Address : </strong>{{$project->lead->email}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Primary Phone : </strong>{{$project->lead->phone}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Secondary Phone : </strong>{{$project->lead->phone2}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Best Time to Call : </strong>{{$project->lead->best}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Age : </strong>{{$project->lead->age()}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Occupation : </strong>{{$project->lead->occupation}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Any Third Party Authorized Contact : </strong></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Name of Invention : </strong>{{$project->ideaName}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>In a few words,What does your idea do? (the concept) : </strong>{{$project->ideaConcept}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Give us the details of your product\'s function and parts. (How does it work, materials, etc.): </strong>{{$project->descIdea}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Tell us when and how you thought of your invention : </strong>{{$project->hisIdea}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>What similar product is on the market now? (Similar, but not the same): </strong>{{$project->similarProduct}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Why do you believe your idea is unique, different or better? : </strong>{{$project->uniIdea}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>What PROBLEM does your idea solve? What are the advantages and benefits of your idea\'s solution?: </strong>{{$project->probIdea}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>How much will it cost to produce your idea?: </strong>{{$project->costSpend}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>How much would you pay for your idea at retail or wholesale?: </strong>{{$project->payIdea}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Is your idea software or an app?: </strong>{{$project->isApp == 1?"Yes":"No"}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Programming Language: </strong>{{$project->language!=''?ucwords($project->language):"N/A"}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Consultant Name (if known) : </strong>{{ucwords($project->consultant->fname." ".$project->consultant->lname)}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.print();
    window.close();
</script>