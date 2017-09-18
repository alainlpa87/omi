<select name="state" value="<?php echo e($state); ?>" id="state" class="form-control">
    <option value="">Select</option>
    <optgroup label="Australian Provinces">
        <option value="-AU-NSW" <?php echo e($state=="-AU-NSW"?"selected":""); ?>>New South Wales</option>
        <option value="-AU-QLD" <?php echo e($state=="-AU-QLD"?"selected":""); ?>>Queensland</option>
        <option value="-AU-SA"  <?php echo e($state=="-AU-SA"?"selected":""); ?>>South Australia</option>
        <option value="-AU-TAS" <?php echo e($state=="-AU-TAS"?"selected":""); ?>>Tasmania</option>
        <option value="-AU-VIC" <?php echo e($state=="-AU-VIC"?"selected":""); ?>>Victoria</option>
        <option value="-AU-WA"  <?php echo e($state=="-AU-WA"?"selected":""); ?>>Western Australia</option>
        <option value="-AU-ACT" <?php echo e($state=="-AU-ACT"?"selected":""); ?>>Australian Capital Territory</option>
        <option value="-AU-NT"  <?php echo e($state=="-AU-NT"?"selected":""); ?>>Northern Territory</option>
    </optgroup>
    <optgroup label="Canadian Provinces">
        <option value="AB" <?php echo e($state=="AB"?"selected":""); ?>>Alberta</option>
        <option value="BC" <?php echo e($state=="BC"?"selected":""); ?>>British Columbia</option>
        <option value="MB" <?php echo e($state=="MB"?"selected":""); ?>>Manitoba</option>
        <option value="NB" <?php echo e($state=="NB"?"selected":""); ?>>New Brunswick</option>
        <option value="NF" <?php echo e($state=="NF"?"selected":""); ?>>Newfoundland</option>
        <option value="NT" <?php echo e($state=="NT"?"selected":""); ?>>Northwest Territories</option>
        <option value="NS" <?php echo e($state=="NS"?"selected":""); ?>>Nova Scotia</option>
        <option value="NVT" <?php echo e($state=="NVT"?"selected":""); ?>>Nunavut</option>
        <option value="ON" <?php echo e($state=="ON"?"selected":""); ?>>Ontario</option>
        <option value="PE" <?php echo e($state=="PE"?"selected":""); ?>>Prince Edward Island</option>
        <option value="QC" <?php echo e($state=="QC"?"selected":""); ?>>Quebec</option>
        <option value="SK" <?php echo e($state=="SK"?"selected":""); ?>>Saskatchewan</option>
        <option value="YK" <?php echo e($state=="YK"?"selected":""); ?>>Yukon</option>
    </optgroup>
    <optgroup label="US States">
        <option value="AL"  <?php echo e($state=="AL"?"selected":""); ?>>Alabama</option>
        <option value="AK"  <?php echo e($state=="AK"?"selected":""); ?>>Alaska</option>
        <option value="AZ"  <?php echo e($state=="AZ"?"selected":""); ?>>Arizona</option>
        <option value="AR"  <?php echo e($state=="AR"?"selected":""); ?>>Arkansas</option>
        <option value="BVI" <?php echo e($state=="BVI"?"selected":""); ?>>British Virgin Islands</option>
        <option value="CA"  <?php echo e($state=="CA"?"selected":""); ?>>California</option>
        <option value="CO"  <?php echo e($state=="CO"?"selected":""); ?>>Colorado</option>
        <option value="CT"  <?php echo e($state=="CT"?"selected":""); ?>>Connecticut</option>
        <option value="DE"  <?php echo e($state=="DE"?"selected":""); ?>>Delaware</option>
        <option value="FL"  <?php echo e($state=="FL"?"selected":""); ?>>Florida</option>
        <option value="GA"  <?php echo e($state=="GA"?"selected":""); ?>>Georgia</option>
        <option value="GU"  <?php echo e($state=="GU"?"selected":""); ?>>Guam</option>
        <option value="HI"  <?php echo e($state=="HI"?"selected":""); ?>>Hawaii</option>
        <option value="ID"  <?php echo e($state=="ID"?"selected":""); ?>>Idaho</option>
        <option value="IL"  <?php echo e($state=="IL"?"selected":""); ?>>Illinois</option>
        <option value="IN"  <?php echo e($state=="IN"?"selected":""); ?>>Indiana</option>
        <option value="IA"  <?php echo e($state=="IA"?"selected":""); ?>>Iowa</option>
        <option value="KS"  <?php echo e($state=="KS"?"selected":""); ?>>Kansas</option>
        <option value="KY"  <?php echo e($state=="KY"?"selected":""); ?>>Kentucky</option>
        <option value="LA"  <?php echo e($state=="LA"?"selected":""); ?>>Louisiana</option>
        <option value="ME"  <?php echo e($state=="ME"?"selected":""); ?>>Maine</option>
        <option value="MP"  <?php echo e($state=="MP"?"selected":""); ?>>Mariana Islands</option>
        <option value="MPI"  <?php echo e($state=="MPI"?"selected":""); ?>>Mariana Islands (Pacific)</option>
        <option value="MD"  <?php echo e($state=="MD"?"selected":""); ?>>Maryland</option>
        <option value="MA"  <?php echo e($state=="MA"?"selected":""); ?>>Massachusetts</option>
        <option value="MI"  <?php echo e($state=="MI"?"selected":""); ?>>Michigan</option>
        <option value="MN"  <?php echo e($state=="MN"?"selected":""); ?>>Minnesota</option>
        <option value="MS"  <?php echo e($state=="MS"?"selected":""); ?>>Mississippi</option>
        <option value="MO"  <?php echo e($state=="MO"?"selected":""); ?>>Missouri</option>
        <option value="MT" <?php echo e($state=="MT"?"selected":""); ?>>Montana</option>
        <option value="NE" <?php echo e($state=="NE"?"selected":""); ?>>Nebraska</option>
        <option value="NV" <?php echo e($state=="NV"?"selected":""); ?>>Nevada</option>
        <option value="NH" <?php echo e($state=="NH"?"selected":""); ?>>New Hampshire</option>
        <option value="NJ" <?php echo e($state=="NJ"?"selected":""); ?>>New Jersey</option>
        <option value="NM" <?php echo e($state=="NM"?"selected":""); ?>>New Mexico</option>
        <option value="NY" <?php echo e($state=="NY"?"selected":""); ?>>New York</option>
        <option value="NC" <?php echo e($state=="NC"?"selected":""); ?>>North Carolina</option>
        <option value="ND" <?php echo e($state=="ND"?"selected":""); ?>>North Dakota</option>
        <option value="OH" <?php echo e($state=="OH"?"selected":""); ?>>Ohio</option>
        <option value="OK" <?php echo e($state=="OK"?"selected":""); ?>>Oklahoma</option>
        <option value="OR" <?php echo e($state=="OR"?"selected":""); ?>>Oregon</option>
        <option value="PA" <?php echo e($state=="PA"?"selected":""); ?>>Pennsylvania</option>
        <option value="PR" <?php echo e($state=="PR"?"selected":""); ?>>Puerto Rico</option>
        <option value="RI" <?php echo e($state=="RI"?"selected":""); ?>>Rhode Island</option>
        <option value="SC" <?php echo e($state=="SC"?"selected":""); ?>>South Carolina</option>
        <option value="SD" <?php echo e($state=="SD"?"selected":""); ?>>South Dakota</option>
        <option value="TN" <?php echo e($state=="TN"?"selected":""); ?>>Tennessee</option>
        <option value="TX" <?php echo e($state=="TX"?"selected":""); ?>>Texas</option>
        <option value="UT" <?php echo e($state=="UT"?"selected":""); ?>>Utah</option>
        <option value="VT" <?php echo e($state=="VT"?"selected":""); ?>>Vermont</option>
        <option value="USVI" <?php echo e($state=="USVI"?"selected":""); ?>>VI  U.S. Virgin Islands</option>
        <option value="VA" <?php echo e($state=="VA"?"selected":""); ?>>Virginia</option>
        <option value="WA" <?php echo e($state=="WA"?"selected":""); ?>>Washington</option>
        <option value="DC" <?php echo e($state=="DC"?"selected":""); ?>>Washington, D.C.</option>
        <option value="WV" <?php echo e($state=="WV"?"selected":""); ?>>West Virginia</option>
        <option value="WI" <?php echo e($state=="WI"?"selected":""); ?>>Wisconsin</option>
        <option value="WY" <?php echo e($state=="WY"?"selected":""); ?>>Wyoming</option>
    </optgroup>
    <option value="N/A" <?php echo e($state=="YK"?"selected":""); ?>>Other</option>
</select>