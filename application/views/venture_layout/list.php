<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="<?php echo base_url()?>assets/css/styles/style1.css" rel="stylesheet" id="bootstrap-css">
 <div class="container">
              <div class="row venture-list">
                <div class="col-xs-12 ">
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" onclick="makeActive('nav-home-tab','nav-home');" id="nav-home-tab" data-toggle="tab"  role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                      <a class="nav-item nav-link" onclick="makeActive('nav-profile-tab','nav-profile');" id="nav-profile-tab" data-toggle="tab"  role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                      <a class="nav-item nav-link" onclick="makeActive('nav-contact-tab','nav-contact');" id="nav-contact-tab" data-toggle="tab"  role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
                      <a class="nav-item nav-link" onclick="makeActive('nav-about-tab','nav-about');" id="nav-about-tab" data-toggle="tab"  role="tab" aria-controls="nav-about" aria-selected="false">About</a>
                    </div>
                  </nav>
                  <div class="tab-content  px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                      <?php 
                      if(count($ventures)>0){
                      foreach($ventures as $v){?>

                            <div class="col-lg-12 col-md-12">
                              <div class="listing-item-container list-layout">
                                <a href="<?php echo base_url()?>/CompanyVentures/showVenture/?v=<?php echo $v['VentureID'];?>&c=<?php echo $v['CompID'];?>" class="listing-item">
                                  
                                  <!-- Image -->
                                  <div class="listing-item-image">
                                    <?php if($v['VentureLogo']=="" || $v['VentureLogo']==null){
                                        $v['VentureLogo'] = ".\/uploads\/ventures\/1573209023virinchihills.png";
                                    }?>
                                    <img src="../../<?php echo $v['VentureLogo'];?>" alt="">
                                    <span class="tag"><?php echo $v['VentureName'];?></span>
                                  </div>
                                  
                                  <!-- Content -->
                                  <div class="listing-item-content">

                                    <div class="listing-item-inner">
                                    <h3><?php echo $v['VentureName'];?></h3>
                                    <span><?php echo $v['ZoneName'];?></span><br>
                                      <button class="btn btn-default">Available : <?php echo $v['Available_plots'];?></button>
                                    <button class="btn btn-default red"  >Sold : <?php echo $v['Registered_plots'];?></button>
                                    </div>


                                    <div class="listing-item-details">View Plots</div>
                                  </div>
                                </a>
                              </div>
                            </div>

                            <div class="col-md-6" style="display: none;" >
                                <a href="<?php echo base_url()?>/CompanyVentures/showVenture/?v=<?php echo $v['VentureID'];?>&c=<?php echo $v['CompID'];?>">
                                <div class="col-md-4">
                                    <?php if($v['VentureLogo']=="" || $v['VentureLogo']==null){
                                        $v['VentureLogo'] = ".\/uploads\/ventures\/1573209023virinchihills.png";
                                    }?>
                                    <img src="../<?php echo $v['VentureLogo'];?>" class="img img-responsive" />
                                </div>
                                <div class="col-md-8">
                                    <h5><?php echo $v['VentureName'];?></h5>
                                    <h5><?php echo $v['ZoneName'];?></h5>
                                    <button class="btn btn-default">Available : <?php echo $v['Available_plots'];?></button>
                                    <button class="btn btn-default red"  >Sold : <?php echo $v['Registered_plots'];?></button>
                                </div>
                                </a>
                            </div>
                        <?php }}else{?>
                            <div class="alert alert-warning">There are no ventures for the company.</div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      <?php if(count($ventures)>0){ echo $ventures[0]['AboutCompany'];}else{ echo "N/A";}?>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                      Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                    </div>
                    <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                      Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                    </div>
                  </div>
                
                </div>
              </div>
        </div>
      </div>
</div>
<script>
    function makeActive(menu,div){
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');

        $('#'+menu).addClass('active');

        $('#'+div).addClass('show active');
//tab-pane;
        //nav-link
    }
</script>