<link href="<?php echo e(asset('/css/pdf_client.css')); ?>" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<!--page 1-->
<p align="center" class="padd_cover">
    <img src="<?php echo e(asset('img/logo.png')); ?>" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
    <br><i style="font-size: 16px;color: darkblue;">Giving the edge to Inventors!</i>
</p>
<p class="psmall">Congratulations on this tremendous accomplishment that few inventors ever achieve. As you are aware, Patent Services USA, INC. has an affiliate International Licensing Consultants, which assists clients with a patent pending status to begin networking and licensing their product.  If you choose not to participate with ILC, kindly sign the following release.</p>
<p class="psmall">I hereby release International Licensing Consultants from any obligation or responsibility to represent my product and/or idea. I understand that any marketing, networking and licensing of my idea and/or product will heretofore be my responsibility. </p>
<br><br><br><br>
<p align="left" style="margin-bottom: 0px !important;" class="pSmall">____________________________</p>
<p align="left" style="margin-bottom: 0px !important;" class="pSmall">Inventor</p>
<br><br><br><br>
<?php for($i=0;$i<count($coinventors);$i++): ?>
    <p align="left" style="margin-bottom: 0px !important;" class="pSmall">____________________________</p>
    <p align="left" style="margin-bottom: 0px !important;" class="pSmall">Co-Inventor</p>
<br><br><br><br>
<?php endfor; ?>
<p align="left" style="margin-bottom: 0px !important;" class="pSmall">____________________________</p>
<p align="left" style="margin-bottom: 0px !important;" class="pSmall">Date</p>