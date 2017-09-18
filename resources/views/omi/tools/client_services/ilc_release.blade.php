<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="ilc_release">
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <p class="pLogo">
            <img src="{{asset('/img/contracts/logo.png')}}" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
            <br><i>Giving the edge to Inventors!</i>
        </p>
        <p class="psmall">Congratulations on this tremendous accomplishment that few inventors ever achieve. As you are aware, Patent Services USA, INC. has an affiliate International Licensing Consultants, which assists clients with a patent pending status to begin networking and licensing their product.  If you choose not to participate with ILC, kindly sign the following release.</p>
        <p class="psmall">I hereby release International Licensing Consultants from any obligation or responsibility to represent my product and/or idea. I understand that any marketing, networking and licensing of my idea and/or product will heretofore be my responsibility. </p>
        <br><br><br><br>
        <div class="row">
        <div class="col-md-4">
            <div class="col-xs-4 sigPad sign-add-d">
                <ul class="sigNav">
                    <li class="clearButton" style="display: list-item;"><a href="#clear">Clear</a></li>
                </ul>
                <div class="sig sigWrapper current">
                    <canvas class="pad" width="290" height="50"></canvas>
                    <input type="hidden" name="output" class="output">
                </div>
            </div>
            <p style="margin-top: 0px !important;text-align: right;" class="pSmall" >Inventor</p>
        </div>
        </div>
        @for($i=0;$i<$coInvCount;$i++)
            <div class="row">
            <div class="col-md-4">
                <div class="col-xs-4 sigPad sign-add-d">
                    <ul class="sigNav">
                        <li class="clearButton" style="display: list-item;"><a href="#clear">Clear</a></li>
                    </ul>
                    <div class="sig sigWrapper current">
                        <canvas class="pad" width="290" height="50"></canvas>
                        <input type="hidden" name="output{{$i+1}}" class="output">
                    </div>
                </div>
                <p style="margin-top: 0px !important;text-align: right;" class="pSmall" >Co-Inventor</p>
            </div>
            </div>
        @endfor
        <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class='input-group date' id='inventor_date' style="margin-top: 45px;">
                <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>
            <p class="drawItDesc"  style="display: block;margin-bottom: 20px;">Date</p>
        </div>
        </div>
    </form>
</div>