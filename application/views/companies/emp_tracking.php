

        <?php if($this->session->flashdata('success') != null &&  $this->session->flashdata('success') != ''){?>
         <input type='hidden' value='<?=$this->session->flashdata('success');?>' status='success' id='notification'>
        
        <?php }else if($this->session->flashdata('error') != null &&  $this->session->flashdata('error') != ''){?>


                <input type='hidden' value='<?=$this->session->flashdata('error');?>' 
                            status='failure' id='notification'>
        
        <?php } ?>
        </br>

           
          <div class="panel panel-default">

          
            <div class="panel-body">
            <!--<input type='text' id='pac-input' placeholder='Enter place name to add' value='' >-->
                <div class="form-group">
                            <div class="form-line">
                                <input type="text" autofocus   placeholder='Enter place or land mark to add'
                                value="<?php echo $this->input->post('Latitude'); ?>" 
                                class="form-control" id='pac-input' />
                            </div>
                        </div>
            <div id="map" style="width:100%;height:400px;background:yellow">
                
                           
            </div>

            
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h4>
                    Droping Points Listing
                </h4>
             </div>
            <div class="body table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Stop Name</th>
                      <th>Latitude</th>
                      <th>Longitude</th>
                      <th>Address</th>
                      <th>Sequence</th>
                      <th>IsWayPoint</th>

                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id='tbody'>

                    </tbody>
                    <!-- <?php foreach($droping_points as $d){ ?>
                    <tr>
                      <td><?php echo $d['StopName']; ?></td>
                      <td><?php echo $d['Latitude']; ?></td>
                      <td><?php echo $d['Longitude']; ?></td>
                      <td><?php echo $d['Address']; ?></td>
                      <td><?php echo $d['Sequence']; ?></td>
                       <td><?php if($d['iswaypoint']){echo 'Yes';}else{echo 'No';}; ?></td>
                      <td>
                            <a onclick="return confirm('Are you sure to delete the dropping/way point ?')"
                             href="<?php echo site_url('Droppingpoints_cntrl/remove/'.$d['RouteID'].'/'.$d['Sequence'].'/'.$d['Id']); ?>"
                              class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?> -->
                </table>
            </div>
        </div>
    </div>
  </div>
   

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style='z-index: 9999 !important'> 
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Droping Point</h4>
        </div>
       
         <?php echo form_open('droppingpoints_cntrl/add',array('onsubmit' => 'return validate();')); ?>

          <input type="hidden" name="subscription_key" 
                value="<?php echo $this->session->userdata('subscription_key'); ?>" 
                class="form-control" id="subscription_key" />
                <input type='hidden' name='RouteID' id='RouteID' value='<?=$RouteID?>'>
	
        <div class="modal-body">
         <div class="row clearfix">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="Latitude"  class="control-label">Latitude</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="Latitude" readonly
                                value="<?php echo $this->input->post('Latitude'); ?>" 
                                class="form-control" id="Latitude" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="Longitude"  class="control-label">Longitude</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="Longitude" readonly
                                value="<?php echo $this->input->post('Longitude'); ?>" 
                                class="form-control" id="Longitude" />
                            </div>
                        </div>
                    </div>
				</div>
		<div class="row clearfix">
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="Address" class="control-label">Address</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="Address"
                                 value="<?php echo $this->input->post('Address'); ?>" 
                                 class="form-control" id="Address" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="StopName" class="control-label">Stop Name</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"   name="StopName"
                                 value="<?php echo $this->input->post('StopName'); ?>" 
                                 class="form-control"  id="StopName" 
                                 required />
                            </div>
                            <span class='stopname_alert'></span>
                        </div>
                    </div>
            </div>
            <div class="row clearfix">
                   <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <label for="Seuqence" class="control-label">Sequence</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" onchange='check_sequence(this)'  name="Seuqence"
                                 value="<?php echo $this->input->post('Seuqence'); ?>" 
                                 class="form-control" pattern="\d{4}" id="Seuqence" min="1"  maxlength="4" 
                                 onKeyPress=" return (event.charCode == 8 || event.charCode == 0 || this.value.length > 3) 
                                            ? false : event.charCode >= 48 && event.charCode <= 57" required />
                            </div>
                            <span class='sequence_alert'></span>
                        </div>
                    </div>
                    </br></br>
                    <span id='err_msg'></span>
                    <div id='confirmUpdate' class="col-lg-12 col-md-12 col-sm-6 col-xs-12" style='display:none'>

                    <span>Given sequence is already exists do you want to update existing or  insert new</span><br>
                              </br>
                             
                              <input name="confirmUpdate" type="radio" id="radio_8" value='Insert' checked="" class="radio-col-pink">
                                <label for="radio_8">Insert New</label>
                               <input name="confirmUpdate" type="radio" id="radio_7" value='Update' class="radio-col-red" >
                                <label for="radio_7">Update Exist</label>
                                
                        </br></br>
                    </div>
                     </br></br></br>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <input type="checkbox" name="iswaypoint" value="1" id="iswaypoint" />
                        <label for="iswaypoint" class="control-label">Iswaypoint</label>
                    </div>
		</div>    
        </div>


        <div class="modal-footer">
         <input type="button" onclick='assignStops()'  id='save_button' class="btn btn-default"  value='Save'></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

     <?php echo form_close(); ?>   
      
    </div>
  </div>
  
<script>  
      
      var stops_list = [];
      var pk = localStorage.getItem('user_id');
      var org_id = localStorage.getItem('org_id');
      var config = {
          apiKey: "AIzaSyAJYfNfeuDpFqNacL6Ah1yPPOGUmkf77u8",
          authDomain: "vbb-dev.firebaseapp.com",
          databaseURL: "https://vbb-dev.firebaseio.com",
          projectId: "vbb-dev",
          storageBucket: "vbb-dev.appspot.com",
          messagingSenderId: "758201927049"
      };
      firebase.initializeApp(config);

     $(document).ready(function() {

               $('li').removeClass("active");	
              $('#rd_menu').addClass("active");
              if(localStorage.getItem('org_id') != null && localStorage.getItem('user_id') != null){

                console.log(localStorage.getItem('org_id'));
                console.log(localStorage.getItem('user_id'));
                getStopList();

              }

     });
     

     function getStopList() {
          
        var RouteId = "<?=$RouteId?>";
     
        var db = firebase.firestore();
        db.settings({ timestampsInSnapshots: true });
          console.log("Get stops");
          var collectionRef = db.collection("api_requests/"+pk+"/requests");
          var userObject = {
              organisation_id:org_id,
              route_id: RouteId // Optional
          }

          collectionRef.add({
              api_name:"stops_get_list",
              request:userObject
          })
          .then((docRef)=> {
              console.log("Request object successfully created")
              docRef.onSnapshot(doc => {
              console.log(doc.data().response);
                var res = doc.data().response;
                if(res !=  undefined && res['check'] && res['success']){

                  stops_list = res['stops'];
                  stops = '';
                  $.each(stops_list, function(key, value){

                    var iswaypoit = 'NO';
                    if(value['iswaypoint']){
                        
                        iswaypoit = 'YES'

                    }
                    stops += "<tr><td>"+value['name']+"</td>"
                            +"<td>"+value['location']['lat']+"</td>"
                            +"<td>"+value['location']['lng']+"</td>"
                            +"<td>"+value['address']+"</td>"
                            +"<td>"+value['sequence']+"</td>"
                            +"<td>"+iswaypoit+"</td>"
                            +"<td><button onclick='removeStop("+'"'+value['id']+""+'"'+")' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Delete</button>"                   
                            +"</td></tr>";

                  });
                  console.log(stops);
                  $('#tbody').html(stops);
                  myMap1();
                }

            })

          }).catch(err => {
              console.log(err)
          })
      }

     

     function assignStops() {

        $('#save_button').attr('disabled', true);
        var Latitude            = $('#Latitude').val();
        var Longitude           = $('#Longitude').val();
        var Address             = $('#Address').val();
        var Sequence            = $('#Seuqence').val();
        
        var RouteID             =	$('#RouteID').val();
        var iswaypoint          = $('#iswaypoint:checked').size();
        var action              = $('input:radio[name=confirmUpdate]:checked').val();
        var StopName            = $('#StopName').val();
        var error =   0;           
        if(Sequence == '' || Sequence == 0){

          $('.sequence_alert').html('Please enter the sequence of point on the route!').css('color','red').show();
          error = 1;
        }
        
        if(StopName == '' ){
          $('.stopname_alert').html('Please enter stop Name').css('color','red').show();
          error = 1;
        }

        if(error == 0){


              var db = firebase.firestore();
              db.settings({ timestampsInSnapshots: true });

              console.log("Assign Stops");
              var collectionRef = db.collection("api_requests/"+pk+"/requests");
              var userObject = {
                  organisation_id:org_id,	
                  stop_name: StopName,
                  sequence: Sequence,
                  address:Address,
                  location : {
                      lat: Latitude,
                      lng: Longitude
                  },
                  route_id: '<?=$RouteId?>',
                  is_waypoint: iswaypoint
              }

              collectionRef.add({
                  api_name:"routes_assign_stops",
                  request:userObject
              })
              .then((docRef)=> {
                  console.log("Request object successfully created")
                  docRef.onSnapshot(doc => {
                  console.log(doc.data().response);
                    res = doc.data().response;
                   if(res !=  undefined && res['check']){
                    
                        if(res['success']){
                            <?php $this->session->set_flashdata('success','Stop added successfully!');?>
                            location.reload(); 
                        }else{

                            $('#err_msg').html(res['message']);
                        }
                       
                   }else{

                       $('#save_button').attr('disabled', false);
                   }

                })

              }).catch(err => {
                $('#save_button').attr('disabled', false);
                  console.log(err)
              })

        }

       
    }

    function removeStop(stop_id) {
         
      var db = firebase.firestore();
      db.settings({ timestampsInSnapshots: true });
      console.log("Get stops");
      var collectionRef = db.collection("api_requests/"+pk+"/requests");
      var userObject = {
          organisation_id:org_id,	
          stop_id: stop_id
      }

      collectionRef.add({
          api_name:"stops_remove",
          request:userObject
      })
      .then((docRef)=> {
          console.log("Request object successfully created")
          docRef.onSnapshot(doc => {
            console.log(doc.data().response)
            res = doc.data().response;
            if(res !=  undefined && res['check'] && res['success']){
                  
                  <?php $this->session->set_flashdata('success','Stop has been deleted successfully!');?>
                  location.reload(); 
            }
        })

      }).catch(err => {
          console.log(err)
      })
    }



    var map='';
    var  newMarker ;
    function myMap1() {
        var mapOptions = {
            center: new google.maps.LatLng(17.403226796719768, 	78.47070693969727),
            zoom: 13,
           
        }
         var input = document.getElementById('pac-input');
         
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
         

        var autocomplete = new google.maps.places.Autocomplete(input);
        
       // console.log(autocomplete);

         var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var icons = {
          parking: {
            icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
          },
          library: {
            icon: iconBase + 'library_maps.png'
          },
          info: {
             icon: {
                path: google.maps.SymbolPath.CIRCLE,
                scale: 5
              },
          }
        };

      
      var jsonArr = [];
      var routeArr = [];

      $.each(stops_list, function(key, value){
          var icon = 'parking';
          if(value['iswaypoint']!= undefined && value['iswaypoint'] == 1){

              icon = 'info';
          }

           jsonArr.push({
                      position: new google.maps.LatLng(+value['location']['lat']	,+value['location']['lng']),
                      type: icon,
                       address: value['name']
                  });

            routeArr.push({
                        lat: +value['location']['lat']	,
                        lng: +value['location']['lng']
                    });
                
      });

        // Create markers.
        var i;
        jsonArr.forEach(function(feature) {
       
                var marker = new google.maps.Marker({
                position: feature.position,
                icon: icons[feature.type].icon,
                
                map: map
          });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                infowindow.setContent(feature.address);
                infowindow.open(map, marker);
                }
            })(marker, i));
        });
 
         var flightPath = new google.maps.Polyline({
          path: routeArr,
          geodesic: true,
          strokeColor: 'blue',
          strokeOpacity: 1.0,
          strokeWeight: 5
        });

        flightPath.setMap(map);


        google.maps.event.addListener(map,'click',function(event)
         {  
           // alert( event.latLng.lat() + ', ' + event.latLng.lng());
           var latlang = event.latLng.lat() + ', ' + event.latLng.lng();
          
           var lat = event.latLag
            $("#Latitude").val(event.latLng.lat());
           // $('#Latitude').val(event.latlag.lat());
            $('#Longitude').val(event.latLng.lng());
            
            geocodeLatLng(geocoder, map, infowindow,latlang);
         
         });
          autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });
          autocomplete.addListener('place_changed', function() {
          infowindow.close();
         //marker.setVisible(false);
          var place = autocomplete.getPlace();
         // console.log(place.geometry.latLag);
         // console.log(place.geometry.location.lat());


          var latlang = place.geometry.location.lat() + ', ' + place.geometry.location.lng();
         
            $("#Latitude").val(place.geometry.location.lat());
           // $('#Latitude').val(event.latlag.lat());
            $('#Longitude').val(place.geometry.location.lng());
        
            
            if (!place.geometry) {
              // User entered the name of a Place that was not suggested and
              // pressed the Enter key, or the Place Details request failed.
              window.alert("No details available for input: '" + place.name + "'");
              return;
            }

             geocodeLatLng(geocoder, map, infowindow,latlang);

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
            } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
          
                  infowindow.open(map, marker);
          }); 
    }


     function geocodeLatLng(geocoder, map, infowindow,latlang) {
        var input = latlang;
        //console.log(input);
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};

        //console.log(latlng);
        geocoder.geocode({'location': latlng}, function(results, status) {

          if (status === 'OK') {
            //console.log(results);
            //console.log(results[0]);
            if (results[0]) {
              map.setZoom(11);

              if(newMarker != null){

                  newMarker.setMap(null);

              }
               newMarker = new google.maps.Marker({
                position: latlng,
               
                map: map
              });

             // alert(results[1].formatted_address);
              //console.log(results[1].address_components);
              // displayPostcode(results[1].address_components);
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, newMarker);
              $("#Address").val(results[0].formatted_address);
              $("#Address").val(results[0].formatted_address);
              $('#myModal').modal('show');
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }

       /* function displayPostcode(address) {
    for (p = address.length-1; p >= 0; p--) {
      if (address[p].types.indexOf("postal_code") != -1) {
        console.log('in disply.');
        console.log(address[p].long_name);
        return true;
        
      }
    }
  }
*/
      function save_point(){
      
        var Latitude            = $('#Latitude').val();
        var Longitude           = $('#Longitude').val();
        var Address             = $('#Address').val();
        var Sequence            = $('#Seuqence').val();
        var subscription_key    = $('#subscription_key').val();
        var RouteID             =	$('#RouteID').val();
        var iswaypoint          = $('#iswaypoint:checked').size();
        var action              = $('input:radio[name=confirmUpdate]:checked').val();
        var StopName            = $('#StopName').val();
        var error =   0;           
        if(Sequence == '' || Sequence == 0){

          $('.sequence_alert').html('Please enter the sequence of point on the route!').css('color','red').show();
          error = 1;
        }
        
        if(StopName == '' ){
          $('.stopname_alert').html('Please enter stop Name').css('color','red').show();
          error = 1;
        }
        
        if(error == 0 ){

             $('.sequence_alert').html('');
            $.ajax({

              type:'post',
              url:'<?=site_url()?>/Droppingpoints_cntrl/add/'+RouteID,
              data:{'Latitude':Latitude,'Longitude':Longitude,'Address':Address,'subscription_key':subscription_key,
                    'iswaypoint':iswaypoint,'Sequence':Sequence,'RouteID':RouteID,'action':action,"StopName":StopName},
              async:false,
              success:function(response){

                  //console.log(response);
                  //alert(response);
                  if(response == 1){
                     //alert('point added successfully!');
                    $('#myModal').modal('hide');
                    location.reload();

                  }else{

                    alert('something went wrong!');
                  }

              }
            });

           //location.reload();
           
        }

      }


      function validate(){

        $Sequence = $('#Seuqence');
        var error = 0;

            if($Sequence == '' || $.trim($Sequence) == ''){

           $('#confirmUpdate').css('display','none');
        }else{
            var RouteID   =	$('#RouteID').val();
            var Sequence  =  $Sequence;
          
            $.ajax({

                type:'post',
                url:'<?=site_url()?>/Droppingpoints_cntrl/check_sequence/',
                data:{'RouteID':RouteID,'Sequence':Sequence},
                success:function(response){

                  // console.log(response);

                    if(response == 1){

                        $('.sequence_alert').html('sequence number is already exist!').css('color','red').show().fadeOut(3000);
                        //event.value = '';

                        $('#confirmUpdate').css('display','block');
                        error = 1
                          
                                
                    }else{

                          $('#confirmUpdate').css('display','none');
                    }
                }

            });

        }


        if(error == 1){
            return false;

        }else{

          return true;
        }
      }
   

      function check_sequence(event){
       
        if(event.value == ''){

           $('#confirmUpdate').css('display','none');
        }else{
            var RouteID   =	$('#RouteID').val();
            var Sequence  =  event.value;
          
            $.ajax({

                type:'post',
                url:'<?=site_url()?>/Droppingpoints_cntrl/check_sequence/',
                data:{'RouteID':RouteID,'Sequence':Sequence},
                success:function(response){

                  // console.log(response);

                    if(response >= 1){

                        $('.sequence_alert').html('sequence number is already exist!').css('color','red').show().fadeOut(3000);
                        //event.value = '';

                        $('#confirmUpdate').css('display','block');
                          
                                
                    }else{

                          $('#confirmUpdate').css('display','none');
                    }
                }

            });

        }

      }

      function cksqn(evt){

          var charCode = (evt.which) ? evt.which : event.keyCode
          alert(event.which);
         return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57;
        /*  if (charCode > 31 && (charCode < 48 || charCode > 57))
              return false;
          return true;
*/
      }


</script>

