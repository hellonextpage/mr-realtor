<!DOCTYPE html>
                
                <html>
                <body>
                <style>
                    p{
                        text-align:justify;
                        font-size:12px;
                    }
                    
                    .about{
                        line-height: 3px;
                        font-size:6px;
                    }
                    .to{
                        line-height: 3px;
                        font-size:12px;
                    }
                    
                    p{
                        font-size:12px;
                    }

                    .tableWithOuterBorder{
                border: 0.5px solid black;
                border-collapse: separate;
                border-spacing: 0;
            }
                    .tableWithOuterBorder td,th{
                        
                        border:1px solid gray;
                        text-align: left;
                        padding: 8px;
                        }

                    .tableWithOuterBorder td:nth-child(2) {
                        width:50%;
                    }
                 
                </style>
               
                    <p   style="width: 100%; font-size: 10px;">
                        <table>
                        <tr>
                            <td>
                                
                            </td>
                            <td style='text-align:right'> <strong style='float:right'>             </strong> </td>
                        </tr>
                        </table>
                    </p>
                  
                    <p align='left'><strong>Ref No.: <?=$quote_id?></strong ></p><p align='right'><strong>Date: <?=date('d.m.Y')?> </strong></p> 
                    
                   
                    <p class="to"><strong>To,</strong></p>
                    <p class="to"><strong><?=$lead_details['finlzatin_prsn_name']?>,</strong></p>
                    <p class="to"><strong> <?=$lead_details['area_name']?>, <?=$lead_details['city_name']?>,</strong></p>
                    <p class="to"><strong> <?=$lead_details['state_name']?>.</strong></p>
                    <p class="to"><strong>Mobile: <?=$lead_details['finlzatin_prsn_mobile']?></strong></p>
                    <p class="to"><strong>Email: <a><?=$lead_details['finlzatin_prsn_email']?></a></strong></p>
                    <p class="to"><strong>Kind Attn: <?=$lead_details['finlzatin_prsn_name']?></strong></p>
                    
                    <p class="content"><strong>Subject: Your requirement of <?=$product_det['kva_value']?> KVA,
                        <?=$product_det['phase_code'] == 'sngl' ? 'I':''?> <?=$product_det['phase_code'] == 'three' ? 'III':''?> Phase &ldquo;
                            <?=$product_det['engine_value']?> Engines&rdquo; powered Silent Diesel Generating Set.</strong></p>
                
                    <p class="content">Dear Sir,</p>
                    <p class="content">This has reference to your enquiry of Silent Diesel Generating Set. We are pleased to introduce ourselves as one of the largest genset manufacturer in India having manufacturing range of 5 KVA to 125 KVA Genset providing custom built power solutions.</p>
                    <p class="content"><strong>PINNACLE</strong> <span class="ff2">Diesel Generating Sets are powered by </span><strong>&lsquo;Eicher Engines&rsquo; / &lsquo;TMTL Engines&rsquo;</strong><span class="ff2"> manufactured by </span><strong>TAFE Motors and Tractors Limited</strong>, <span class="ff2">well known for their ruggedness, economics of performance &amp; high reliability. Our Diesel Engines have </span> earned the trust of millions of users as these engines can be operated for long periods without stopping the engine, require lowest maintenance cost offer best-in-class fuel economy and meet the latest emission norms.</p>
                    <p class="content">We are the authorized <strong>OEA of &lsquo;Eicher Engines&rsquo; / &lsquo;TMTL Engines&rsquo;</strong> powered PINNACLE Diesel Generating Sets.We have created an enviable position for ourselves in the Industry because of our commitment towards product quality and total customer satisfaction. Our state-of-the-art design &amp; manufacturing facilities, strong service support and customer friendly attitude have made &lsquo;PINNACLE&rsquo; DG sets the first choice for most telecom corporates such as <strong>Bharti Infratel, Indus Tower, Vodafone, Reliance, Idea, Nokia, CitiFinancial, IDMC, ICICI Prudential, ICICI bank Aditya Birla Retail</strong>, <strong>HDFC Bank, Kotak Mahindra Bank</strong>, and many others.</p>
                    <p class="content">We have also developed the capability to execute the complete project including civil works, Installation, electrical cabling &amp; earthing etc. Our team of expert engineers and installers shall guide you appropriately for installation of complete genset in the most economical way.</p>
                    <p class="content">Our manufacturing plant located at Cherlapally , Hyderabad are equipped with the latest machinery such as Amada make CNC Cutting, CNC Bending and a fully automated powder coating facility with pure Polyester powder and baking on automatic conveyorized plant resulting in good surface finish and protection against corrosion. All the products coming out of our plants conform to stringent quality control norms and are thoroughly tested for performance. Our Diesel Generating Sets are manufactured as per technical guidelines of TAFE Motors &amp; Tractors Limited.</p>
                    <p class="content">We are also pleased to inform you that all models of Diesel Generating Sets manufactured by us, are tested and certified as per latest Sound &amp; Emission norms, issued by CPCB <strong>II</strong></p>
                    <p class="content">Assuring you of our best attention at all times.</p>
                    <p class="content" style="line-height: 3px;">Thanking you,</p>
                    <p class="content" style="line-height: 3px;"><strong>Yours Sincerely,</strong></p>
                    <p class="content" style="line-height: 3px;"><strong>For Pinnacle Generators,</strong></p>
             
                <p style="line-height: 3px;"><strong><?=$manger_details['emp_name']?></strong></p>
				<?php if($manger_details['desig_id'] == MANAGER_DESIGNATION_ID) { ?>
					<p style="font-size: 10px; line-height: 3px;"><strong>Manager</strong></p>
				<?php }else if($manger_details['desig_id'] == REGIONAL_MANAGER_DESIGNATION_ID) { ?>
					<p style="font-size: 10px; line-height: 3px;"><strong>Zonal Manager</strong></p>
				<?php } ?>
                <p style="font-size: 10px; line-height: 3px;"><strong>Mobile: <?=$manger_details['mobile_no']?></strong></p>
                <p style="font-size: 10px; line-height: px;"><strong>Email ID: <?=$manger_details['email_id']?></strong></p>
               
                <p>&nbsp;</p>
                
                <p style='text-align:center;text-decoration:underline'><strong>SCOPE OF SUPPLY</strong></p>
                    SCOPE_OF_SUPPLY
                <br>
                 <p style='text-align:center;text-decoration:underline'><strong>PRICE SCHEDULE</strong></p>
                    
                <br>

                <?php 
                    
                        $gst = (18 / 100) * $product_det['list_price'];
                        $list_price = $product_det['list_price'];
					   $res = ($product_det['quoted_price'] * 100)/$actual_product_det['list_price'];
						$discount_value = 100- $res;			   
				?>
		
                    <table class="tableWithOuterBorder">
                        <tr>
                          <th >Sl.No</th>
                          <th >Description</th>
                          <th >Qty.</th>
                          <th >Amount (Rs.)</th>
                          <th >Total (Rs.)</th>
                        </tr>
                        <tr>
                          <td >1</td>
                          <td >
                              DESCRIPTION_CONTENT
                          </td>
                          <td ></td>
                          <td ></td>
                          
                          <td ></td>
                
                        </tr>
                
                        <tr>
                          <td >A</td>
                          <td > Actual Price (Including (CGST + SGST) @18% or IGST @18%)</td>
                          <td ></td>
                          <td ></td>
                          
                          <td ><?=$product_det['list_price'];?>/- </td>
                
                        </tr>
						
					<!-- 	<tr>
                          <td >B</td>
                          <td >Discount</td>
                          <td ></td>
                          <td ></td>
                          
                          <td ><?=$discount_value?>%</td>
                
                        </tr> -->
                
						<tr>
                          <td >C</td>
                          <td >Final Price(Including (CGST + SGST) @18% or IGST @18%) </td>
                          <td ></td>
                          <td ></td>
                          
                          <td ><?=$product_det['quoted_price']?></td>
                
                        </tr>
                        <tr>
                          <td >D</td>
                          <td >Transportation</td>
                          <td ></td>
                          <td ></td>
                          
                          <td ><?=$product_det['extrnl_trasport_charges']?>/- </td>
                
                        </tr>
                        
                        <tr>
                          <td >E</td>
                          <td >TOTAL</td>
                          <td ></td>
                          <td ></td>
                          
                          <td ><?=$product_det['extrnl_trasport_charges'] + $product_det['quoted_price'] ?></td>
                
                        </tr>
                
                </table>
      <p>&nbsp;</p>
                    
         
                
                
                <p style='text-decoration:underline'><strong>TERMS &amp; CONDITIONS</strong></p>
            
            <p><strong>(CGST+SGST) @ 18% / IGST @ 18%:</strong><br>
            Prices are<strong> Inclusive </strong>of<strong> Central Goods and Service Tax and State Goods and Service Tax @ 18% or Integrated Goods and Service Tax @ 18%. Any statutory variation in duty &amp; tax at the time of actual dispatch shall be to your account. </strong>Octroi / Entry Tax, if applicable shall be to your account. Road permit, if required, will be provided by customer prior to dispatch.</p>
            
            <p><strong>TERMS OF PAYMENT:</strong><br>
            35% payment as an advance along with order &amp; balance against Proforma invoice before dispatch in the name of <strong>M/s Pinnacle Generators</strong> only, vide demand draft payable at Hyderabad only.</p>
            
            <p><br>
            <strong>FREIGHT &amp; TRANSIT INSURANCE:</strong><br>
            Prices F.O.R Factory, Cherlapalli, Hyderabad. Prices are Exclusive of freight, transit insurance charges &amp; unloading.</p>
            
            <p><br>
            <strong>APPROVALS: </strong>Approvals from concerned authorities shall be to customers account.</p>
            
            <p><strong>DELIVERY LEAD TIME:</strong><br>
            Supply within <strong>6-9 Days</strong> from the date of receipt of your order along with advance, subject to force majeure conditions and unforeseen delay, which is beyond our / our manufacturers’ control.</p>
            
            <p><br>
            <strong>STANDARD WARRANTY:</strong><br>
            The offered Eicher Engine is warranted for a period of 26 months from the date of dispatch from factory OR 24 months from the date of commissioning OR 5000 Hrs. of operation from the date of commissioning, whichever is earlier, against any manufacturing defect/defective materials only. However, electrical and other proprietary items would be covered as per their respective manufacturer’s standard warranty clause. The warranty will not cover the normal wear and tear or damages caused by accident, wrong handling and improper maintenance.</p>
            
            <p><br>
            <strong>EXTENDED WARRANTY:</strong> <strong>As per the attached Annexure on 5 critical components</strong>-<br>
            Cylinder Block, Crank Shaft,Camshaft, Cylinder Head, and Connecting Rod.</p>
            
            <p><strong>VALIDITY:</strong><br>
            Our offer shall remain valid for a period of <strong>30 Days</strong> from the date of our offer and subject to our confirmation thereafter.</p>
            
            <p><br>
            <strong>SCOPE OF SUPPLY:</strong><br>
            Our offer confines to whatever is specifically included and stipulated in the technical and commercial clauses and is subject to changes as may be mutually agreed upon finalization of the contract.</p>
            
            <p><br>
            <strong>CANCELLATION OF CONTRACT:</strong><br>
                10% of the total ORDER value will be charged as cancellation charges, in case of cancellation.</p>
            
            <p><br>
            <strong>PURCHASE ORDER:</strong> The purchase order shall be released in the name &amp; address as given below:</p>
            
            <p>
            
                <strong>M/s. Pinnacle Generators,<br>
                        Plot No.10/8, 2nd Floor,<br>
                        Block-A, CDC Towers,<br>
                        Road No.5, IDA Nacharam,<br>
                        Hyderabad – 500076 </strong>
            </p>
            
            <p><br>
            <strong>Our RTGS Details:</strong><br>
                    A/c. No: 560101000015127<br>
                    Bank: Corporation Bank<br>
                    IFSC Code: CORP0000623<br>
                    Branch: Tarnaka Branch, Secunderabad.<br>
                    Branch Code: 623, MICR Code: 500017011</p>
            
            <p><br>
            <strong>Yours Sincerely,<br>
            For Pinnacle Generators,</strong></p>
            
            <p><br>
			
            <strong><?=$manger_details['emp_name']?><br>
				<?php if($manger_details['desig_id'] == MANAGER_DESIGNATION_ID) { ?>
					Manager
				<?php }else if($manger_details['desig_id'] == REGIONAL_MANAGER_DESIGNATION_ID) { ?>
					Zonal Manager
				<?php } ?><br>
            Mobile: <?=$manger_details['mobile_no']?><br>
            Email ID: <?=$manger_details['email_id']?></strong></p>
            
            <p>&nbsp;</p>


                </body></html>