<div style="border:2px solid #0372A0;font-family:Arial, Helvetica, sans-serif;font-size:12px">
    <div style="padding:5px 5px;color:#fff;font-weight:bold;background-color:#0372A0"><strong>Bussiness Profile</strong></div>
    <h3 style="font-family:Arial, Helvetica, sans-serif;font-size:18px;padding-left:8px;padding-bottom:5px;color:#0372A0;">Patent Services -{{$project->lead->fileno}} / {{$project->lead->leadSource}} / {{ucwords($project->consultant->usr)}} / {{$project->updated_at}}</h3>
    <div style="padding-top:10px;">
        <div style="border:1px solid #000;"><table border="0" cellspacing="2" cellpadding="4">
                <tr>
                    <td colspan="2"><b> Details </b></td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Invention Name : </strong>{{$project->ideaName}}</td>
                </tr>

                <tr>
                    <td style="font-size:12px"><strong>Invention Short Description : </strong>{{$project->ideaConcept}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Describe what makes your idea unique, how it looks/works: </strong>{{$project->ideaConcept}}</td>
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
                    <td style="font-size:12px"><strong>What PROBLEM does your idea solve? What are the advantages and benefits of your idea\'s solution?: </strong>{{$project->propIdea}}</td>
                </tr>

                <tr>
                    <td style="font-size:12px"><strong>How much will it cost to produce your idea?: </strong>{{$project->costSpend}}</td>
                </tr>

                <tr>
                    <td style="font-size:12px"><strong>How much would you pay for your idea at retail or wholesale?: </strong>{{$project->payIdea}}</td>
                </tr>

                <tr>
                    <td style="font-size:12px"><strong>What technical field(s) does your project fall into? : </strong>{{strlen($project->techField)>0?$project->techField:""}}</td>
                </tr>

                <tr>
                    <td style="font-size:12px"><strong>What companies, groups of people, products, processes or services could use your idea? : </strong>{{$project->targetMarket}}</td>
                </tr>

                <tr>
                    <td style="font-size:12px"><strong>What upgrades or modifications can you suggest to improve functionality, packaging, appeal, versatility, mechanics or affordability to a manufacturer or end user?:</strong>{{$project->modifications}}</td>
                </tr>

                <tr>
                    <td style="font-size:12px"><strong>Describe the environment (wet, dry, temperature, pressure, light, dark, etc.) in which your idea will function?:</strong></td>
                </tr>
                <tr>
                    <td style="font-size:12px">{{$project->environment}}</td>
                </tr>

                <tr>
                    <td style="font-size:12px"><strong>If your idea is a "device", what does it consume or produce? And what powers it? (Manual, electricity, gasoline, sunlight, water power, batteries, etc.):</strong></td>
                </tr>
                <tr>
                    <td style="font-size:12px">{{$project->device}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Is your idea software or an app?: </strong>{{$project->isApp == 1?"Yes":"No"}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Programming Language: </strong>{{$project->language!=''?ucwords($project->language):"N/A"}}</td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Any additional comments or information you wish to volunteer about yourself (inventor), any co-inventors or the invention?:</strong></td>
                </tr>
                <tr>
                    <td style="font-size:12px">{{$project->addNotes}}</td>
                </tr>
            </table>
            <label style="text-align:center;width:100%;font-size:14px;"><strong>Inventor Profile </strong></label>
            <table border="0">
                <tbody>
                <tr>
                    <td style="font-size:12px"><strong>Profession:</strong></td>
                    <td style="font-size:12px">{{$project->lead->profession}} </td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Degree:</strong></td>
                    <td style="font-size:12px"> {{$project->lead->degree}}  </td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>College:</strong></td>
                    <td style="font-size:12px">{{$project->lead->college}}  </td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Married:</strong></td>
                    <td style="font-size:12px"> {{$project->lead->married}}  </td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Spouse Name:</strong></td>
                    <td style="font-size:12px"> {{$project->lead->spouse}}  </td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Children Names:</strong></td>
                    <td style="font-size:12px"> {{$project->lead->children}}  </td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Date of Birth:</strong></td>
                    <td style="font-size:12px"> {{$project->lead->birth}}  </td>
                </tr>
                <tr>
                    <td style="font-size:12px"><strong>Hobby:</strong></td>
                    <td style="font-size:12px"> {{$project->lead->hobby}}  </td>
                </tr>
                </tbody>
            </table>
            @if($user == 'alain' || $user == 'production')
                <label style="text-align:center;width:100%;"><strong>Inventor Information Correction </strong></label>
                <table border="0">
                    <tbody>
                    <tr>
                        <td style="font-size:12px"><strong>Inventor Name: </strong></td>
                        <td style="font-size:12px">{{$project->lead->fname}} {{$project->lead->lname}}  </td>
                    </tr>
                    <tr>
                        <td style="font-size:12px"> <strong>Co-Inventor: </strong></td>
                        <td style="font-size:12px">{{$project->coInventor}} </td>
                    </tr>
                    <tr>
                        <td style="font-size:12px"><strong>Street Address:</strong></td>
                        <td style="font-size:12px">{{$project->lead->street}} {{$project->lead->street2}} </td>
                    </tr>
                    <tr>
                        <td style="font-size:12px"><strong>City:</strong></td>
                        <td style="font-size:12px">{{$project->lead->city}}</td>
                    </tr>
                    <tr>
                        <td style="font-size:12px"><strong>State:</strong></td>
                        <td style="font-size:12px">{{$project->lead->state}}</td>
                    </tr>
                    <tr>
                        <td style="font-size:12px"><strong>Zip:</strong></td>
                        <td style="font-size:12px">{{$project->lead->zip}}</td>
                    </tr>
                    <tr>
                        <td style="font-size:12px"><strong>Mobile</strong></td>
                        <td style="font-size:12px">{{$project->lead->phone}}</td>
                    </tr>
                    <tr>
                        <td style="font-size:12px"><strong>Home Tel:</strong></td>
                        <td style="font-size:12px">{{$project->lead->phone2}}</td>
                    </tr>
                    <tr>
                        <td style="font-size:12px"><strong>Inventors:</strong></td>
                        <td style="font-size:12px">{{$project->pInventor}}</td>
                    </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
<script type="text/javascript">
    window.print();
</script>