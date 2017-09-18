<select name="state" value="{{$state}}" id="state" class="form-control">
    <option value="">Select</option>
    <optgroup label="Australian Provinces">
        <option value="-AU-NSW" {{$state=="-AU-NSW"?"selected":""}}>New South Wales</option>
        <option value="-AU-QLD" {{$state=="-AU-QLD"?"selected":""}}>Queensland</option>
        <option value="-AU-SA"  {{$state=="-AU-SA"?"selected":""}}>South Australia</option>
        <option value="-AU-TAS" {{$state=="-AU-TAS"?"selected":""}}>Tasmania</option>
        <option value="-AU-VIC" {{$state=="-AU-VIC"?"selected":""}}>Victoria</option>
        <option value="-AU-WA"  {{$state=="-AU-WA"?"selected":""}}>Western Australia</option>
        <option value="-AU-ACT" {{$state=="-AU-ACT"?"selected":""}}>Australian Capital Territory</option>
        <option value="-AU-NT"  {{$state=="-AU-NT"?"selected":""}}>Northern Territory</option>
    </optgroup>
    <optgroup label="Canadian Provinces">
        <option value="AB" {{$state=="AB"?"selected":""}}>Alberta</option>
        <option value="BC" {{$state=="BC"?"selected":""}}>British Columbia</option>
        <option value="MB" {{$state=="MB"?"selected":""}}>Manitoba</option>
        <option value="NB" {{$state=="NB"?"selected":""}}>New Brunswick</option>
        <option value="NF" {{$state=="NF"?"selected":""}}>Newfoundland</option>
        <option value="NT" {{$state=="NT"?"selected":""}}>Northwest Territories</option>
        <option value="NS" {{$state=="NS"?"selected":""}}>Nova Scotia</option>
        <option value="NVT" {{$state=="NVT"?"selected":""}}>Nunavut</option>
        <option value="ON" {{$state=="ON"?"selected":""}}>Ontario</option>
        <option value="PE" {{$state=="PE"?"selected":""}}>Prince Edward Island</option>
        <option value="QC" {{$state=="QC"?"selected":""}}>Quebec</option>
        <option value="SK" {{$state=="SK"?"selected":""}}>Saskatchewan</option>
        <option value="YK" {{$state=="YK"?"selected":""}}>Yukon</option>
    </optgroup>
    <optgroup label="US States">
        <option value="AL"  {{$state=="AL"?"selected":""}}>Alabama</option>
        <option value="AK"  {{$state=="AK"?"selected":""}}>Alaska</option>
        <option value="AZ"  {{$state=="AZ"?"selected":""}}>Arizona</option>
        <option value="AR"  {{$state=="AR"?"selected":""}}>Arkansas</option>
        <option value="BVI" {{$state=="BVI"?"selected":""}}>British Virgin Islands</option>
        <option value="CA"  {{$state=="CA"?"selected":""}}>California</option>
        <option value="CO"  {{$state=="CO"?"selected":""}}>Colorado</option>
        <option value="CT"  {{$state=="CT"?"selected":""}}>Connecticut</option>
        <option value="DE"  {{$state=="DE"?"selected":""}}>Delaware</option>
        <option value="FL"  {{$state=="FL"?"selected":""}}>Florida</option>
        <option value="GA"  {{$state=="GA"?"selected":""}}>Georgia</option>
        <option value="GU"  {{$state=="GU"?"selected":""}}>Guam</option>
        <option value="HI"  {{$state=="HI"?"selected":""}}>Hawaii</option>
        <option value="ID"  {{$state=="ID"?"selected":""}}>Idaho</option>
        <option value="IL"  {{$state=="IL"?"selected":""}}>Illinois</option>
        <option value="IN"  {{$state=="IN"?"selected":""}}>Indiana</option>
        <option value="IA"  {{$state=="IA"?"selected":""}}>Iowa</option>
        <option value="KS"  {{$state=="KS"?"selected":""}}>Kansas</option>
        <option value="KY"  {{$state=="KY"?"selected":""}}>Kentucky</option>
        <option value="LA"  {{$state=="LA"?"selected":""}}>Louisiana</option>
        <option value="ME"  {{$state=="ME"?"selected":""}}>Maine</option>
        <option value="MP"  {{$state=="MP"?"selected":""}}>Mariana Islands</option>
        <option value="MPI"  {{$state=="MPI"?"selected":""}}>Mariana Islands (Pacific)</option>
        <option value="MD"  {{$state=="MD"?"selected":""}}>Maryland</option>
        <option value="MA"  {{$state=="MA"?"selected":""}}>Massachusetts</option>
        <option value="MI"  {{$state=="MI"?"selected":""}}>Michigan</option>
        <option value="MN"  {{$state=="MN"?"selected":""}}>Minnesota</option>
        <option value="MS"  {{$state=="MS"?"selected":""}}>Mississippi</option>
        <option value="MO"  {{$state=="MO"?"selected":""}}>Missouri</option>
        <option value="MT" {{$state=="MT"?"selected":""}}>Montana</option>
        <option value="NE" {{$state=="NE"?"selected":""}}>Nebraska</option>
        <option value="NV" {{$state=="NV"?"selected":""}}>Nevada</option>
        <option value="NH" {{$state=="NH"?"selected":""}}>New Hampshire</option>
        <option value="NJ" {{$state=="NJ"?"selected":""}}>New Jersey</option>
        <option value="NM" {{$state=="NM"?"selected":""}}>New Mexico</option>
        <option value="NY" {{$state=="NY"?"selected":""}}>New York</option>
        <option value="NC" {{$state=="NC"?"selected":""}}>North Carolina</option>
        <option value="ND" {{$state=="ND"?"selected":""}}>North Dakota</option>
        <option value="OH" {{$state=="OH"?"selected":""}}>Ohio</option>
        <option value="OK" {{$state=="OK"?"selected":""}}>Oklahoma</option>
        <option value="OR" {{$state=="OR"?"selected":""}}>Oregon</option>
        <option value="PA" {{$state=="PA"?"selected":""}}>Pennsylvania</option>
        <option value="PR" {{$state=="PR"?"selected":""}}>Puerto Rico</option>
        <option value="RI" {{$state=="RI"?"selected":""}}>Rhode Island</option>
        <option value="SC" {{$state=="SC"?"selected":""}}>South Carolina</option>
        <option value="SD" {{$state=="SD"?"selected":""}}>South Dakota</option>
        <option value="TN" {{$state=="TN"?"selected":""}}>Tennessee</option>
        <option value="TX" {{$state=="TX"?"selected":""}}>Texas</option>
        <option value="UT" {{$state=="UT"?"selected":""}}>Utah</option>
        <option value="VT" {{$state=="VT"?"selected":""}}>Vermont</option>
        <option value="USVI" {{$state=="USVI"?"selected":""}}>VI  U.S. Virgin Islands</option>
        <option value="VA" {{$state=="VA"?"selected":""}}>Virginia</option>
        <option value="WA" {{$state=="WA"?"selected":""}}>Washington</option>
        <option value="DC" {{$state=="DC"?"selected":""}}>Washington, D.C.</option>
        <option value="WV" {{$state=="WV"?"selected":""}}>West Virginia</option>
        <option value="WI" {{$state=="WI"?"selected":""}}>Wisconsin</option>
        <option value="WY" {{$state=="WY"?"selected":""}}>Wyoming</option>
    </optgroup>
    <option value="N/A" {{$state=="YK"?"selected":""}}>Other</option>
</select>