$(document).ready(function () {

    var mapbackgroundimage = "";

    var gardenimagesarray;

    var projectid = "";
    var pattern1 = "", pattern7 = "", pattern2 = "", pattern3 = "", pattern4 = "", pattern5 = "", pattern6 = "", pattern8 = "";
    pattern9 = "", pattern10 = "", pattern11 = "", pattern12 = "", pattern13 = "", pattern14 = "", pattern15 = "";
    // $.ajax({
        // url: "https://maps.bbgindia.com/Home/getid",
        // type: 'GET',
        // dataType: 'json',
        // async: false,
        // processData: false,
        // cache: false,
        // success: function (data) {
            // projectid = data;

        // },
        // error: function (xhr, textStatus, errorThrown) {

        // }

    // });
 $.ajaxSetup({ async: false });
   
    /* $.post("https://maps.bbgindia.com/Home/getid", function(data) {
        debugger;
        var dataT = data['data']; */
        projectid = '209520';

   /*  }); */

    var url_string = window.location.href; 
    var location_utl = new URL(url_string);
    var VentureID = 1;//location_utl.searchParams.get("v");
    var CompID = 1;//location_utl.searchParams.get("c");
   
 if (projectid.indexOf(",") == -1) {
    console.log(VentureID);
        var pid = projectid;
        var dataurl = "http://13.235.113.76/mrrealtor/CompanyVentures/Getplots/"+VentureID+"/"+CompID;
        $.ajax({
            url: dataurl,
            type: 'GET',             
            dataType: 'json',
            async: false,
            processData: false,
            cache: false,
            async: false,
            success: function (data) {
                //debugger;
                var html = "";
                var facing_Div = "";
                var plots = "";
                var plot_no = "";
                var plotno = "";
                for (var i = 0; i < data.length; i++) {


                    var pt = data[i].No_;
                    var length = pt.length;
                    var n = pt.indexOf('-');
                    if (n != -1) {
                        var plotid = data[i].No_.substring(n + 1, length);
                        var plotno1 = plotid.replace(/\s+/g, '');
                        plotno = plotno1.replace(/\b0+/g, '');
                    }
                    else {
                        var n = pt.indexOf('/');
                        if (n != -1) {
                            var plotid = data[i].No_.split('/');
                            var plotno1 = plotid[1].replace(/\s+/g, '');
                            plotno = plotno1.replace(/\b0+/g, '');
                        }
                        else {
                            plotno = data[i].No_;
                        }
                    }
                    console.log(data[i]);
                    html = html + "<input type='hidden' id='hid_" + plotno + "' value=" + data[i].Status + " />"
                    facing_Div = facing_Div + "<input type='hidden' id='hidfacing_" + plotno + "' value=" + data[i].Facing + " />"

                }
                document.getElementById("div_hids").innerHTML = html;
                document.getElementById("div_facing").innerHTML = facing_Div;
                var available = 0, booked = 0, reg = 0;
                for (var j = 0; j < data.length; j++) {
                   
                    var plotstatus = "";
                    var facing = "";
                    if (data[j].Status == 'A') {
                        plotstatus = "Available";
                        available++;
                    }
                    if (data[j].Status == 'P') {
                        plotstatus = "Booked";
                        booked++;
                    }
                    if (data[j].Status == 'P') {
                        plotstatus = "Booked";
                        booked++;
                    }
                    if (data[j].Status == 'NA') {
                        plotstatus = "Registered";
                        reg++;
                    }
                    else { }
                    if (data[j].Facing == 1) {
                        facing = "East";
                    }
                    else if (data[j].Facing == 2) {
                        facing = "West";
                    } else if (data[j].Facing == 3) {
                        facing = "North";
                    } else if (data[j].Facing == 4) {
                        facing = "South";
                    } else if (data[j].Facing == 5) {
                        facing = "NorthWest";
                    } else if (data[j].Facing == 6) {
                        facing = "SouthEast";
                    } else if (data[j].Facing == 7) {
                        facing = "NorthEast";
                    } else {
                        facing = "SouthWest";
                    }

                    var pt = data[j].No_;
                    var n = pt.indexOf('-');
                    var length = pt.length;
                    if (n != -1) {
                        var plotid = data[j].No_.substring(n + 1, length);
                        var plotno1 = plotid.replace(/\s+/g, '');
                        plot_no = plotno1.replace(/\b0+/g, '');
                    }
                    else {
                        var n = pt.indexOf('/');
                        if (n != -1) {
                            var plotid = data[j].No_.split('/');
                            var plotno1 = plotid[1].replace(/\s+/g, '');
                            plot_no = plotno1.replace(/\b0+/g, '');
                        }
                        else {
                            plot_no = data[j].No_;
                        }
                    }

                    if (data[j]['Customer Name'] != "") {
                       plots = plots + "<div style='display:none;text-align:left;' id='divpt_" + plot_no + "'>Customer Name-" + data[j]['Customer Name'] + "<br/>Plot no-" + data[j].No_ + "<br />Plot Facing- " + facing + "<br />Plot Area-" + data[j]['Saleable Area'] + "<br />Plot Status-" + plotstatus + "<br />Plot Measurement:" + data[j]['Measurements'] + "</div>";
					  
					    /* plots = plots + "<div style='display:none;text-align:left;' id='divpt_" + plot_no + "'>Customer Name-" + data[j]['Customer Name'] + "<br/>Stall no-" + data[j].No_ + "<br />Stall Status-" + plotstatus + "<br />Stall Measurement:" + data[j]['Measurements'] + "</div>";*/
                    }
                    else {
                        plots = plots + "<div style='display:none;text-align:left;' id='divpt_" + plot_no + "'>Plot no-" + data[j].No_ + "<br />Plot Facing- " + facing + "<br />Plot Area-" + data[j]['Saleable Area'] + "<br />Plot Status-" + plotstatus + "<br />Plot Measurement:" + data[j]['Measurements'] + "</div>";
					    /* plots = plots + "<div style='display:none;text-align:left;' id='divpt_" + plot_no + "'>Stall no-" + data[j].No_ + "<br />Stall Status-" + plotstatus + "<br />Stall Measurement:" + data[j]['Measurements'] + "</div>";*/
                    }
                }
                document.getElementById("divplot").innerHTML = plots;
                document.getElementById("txt_totalplots").innerText = available + booked + reg;
                document.getElementById("txt_alloted").innerHTML = booked + reg;
                document.getElementById("txt_available").innerHTML = available;
            },
            error: function (xhr, textStatus, errorThrown) {

            }

        });
    }
    else {


        var projectcode = [];
        debugger;
        
        projectcode = projectid.split(',');
        if (projectcode.length > 0) {
            var html = "";
            var facing_div = "";
            var plots = "";
            var available = 0, booked = 0, reg = 0;
            for (var k = 0; k < projectcode.length; k++) {
                var dataurl = "http://13.235.113.76/mrrealtor/CompanyVentures/Getplots/"+VentureID+"/"+CompID;
                console.log(dataurl);
                $.ajax({
                    url: dataurl,
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    processData: false,
                    // contentType:"application/json; charset=utf-8",
                    cache: false,

                    success: function (data) {

                        debugger;
                        var plot_no = "";
                        var plotno = "";
                        for (var i = 0; i < data.length; i++) {

                            //  var string = "ctrl/h4-h6";

                            var pt = data[i].No_;
                            var length = pt.length;
                            var n = pt.indexOf('-');
                            if (n != -1) {
                                //var plotid = string.split('-');
                                var plotid = data[i].No_.substring(n + 1, length);
                                var plotno1 = plotid.replace(/\s+/g, '');
                                plotno = plotno1.replace(/\b0+/g, '');
                            }
                            else {
                                var n = pt.indexOf('/');
                                if (n != -1) {
                                    var plotid = data[i].No_.split('/');
                                    var plotno1 = plotid[1].replace(/\s+/g, '');
                                    plotno = plotno1.replace(/\b0+/g, '');
                                }
                                else {
                                    plotno = data[i].No_;
                                }
                            }
                            
                            html = html + "<input type='hidden' id='hid_" + plotno + "' value=" + data[i].Status + " />"
                            facing_div = facing_div + "<input type='hidden' id='hidfacing_" + plotno + "' value=" + data[i].Facing + " />"

                        }


                        for (var j = 0; j < data.length; j++) {

                            var plotstatus = "";
                            var facing = "";
                            if (data[j].Status == 'A') {
                                plotstatus = "Available";
                                available++;
                            }
                            if (data[j].Status == 'P') {
                                plotstatus = "Blocked";
                                booked++;   
                            }
                            if (data[j].Status == 'P') {   
                                plotstatus = "Booked";
                                booked++;
                            }
                            if (data[j].Status == "NA") {
                                plotstatus = "Registered";
                                reg++;
                            }
                            else { }
                            if (data[j].Facing == 1) {
                                facing = "East";
                            }
                            else if (data[j].Facing == 2) {
                                facing = "West";
                            } else if (data[j].Facing == 3) {
                                facing = "North";
                            } else if (data[j].Facing == 4) {
                                facing = "South";
                            } else if (data[j].Facing == 5) {
                                facing = "NorthWest";
                            } else if (data[j].Facing == 6) {
                                facing = "SouthEast";
                            } else if (data[j].Facing == 7) {
                                facing = "NorthEast";
                            } else {
                                facing = "SouthWest";
                            }

                            var pt = data[j].No_;
                            var n = pt.indexOf('-');
                            var length = pt.length;
                            if (n != -1) {
                                var plotid = data[j].No_.substring(n + 1, length);
                                var plotno1 = plotid.replace(/\s+/g, '');
                                plot_no = plotno1.replace(/\b0+/g, '');
                            }
                            else {
                                var n = pt.indexOf('/');
                                if (n != -1) {
                                    var plotid = data[j].No_.split('/');
                                    var plotno1 = plotid[1].replace(/\s+/g, '');
                                    plot_no = plotno1.replace(/\b0+/g, '');
                                }
                                else {
                                    plot_no = data[j].No_;
                                }
                            }

                            if (data[j]['Customer Name'] != "") {

                                plots = plots + "<div style='display:none;text-align:left;' id='divpt_" + plot_no + "'>Customer Name-" + data[j]['Customer Name'] + "<br/>Plot no-" + data[j].No_ + "<br />Plot Facing- " + facing + "<br />Plot Area-" + data[j]['Saleable Area'] + "<br />Plot Status-" + plotstatus + "<br />Plot Measurement: " + data[j]['Measurements']  +"</div>";
							    /*plots = plots + "<div style='display:none;text-align:left;' id='divpt_" + plot_no + "'>Customer Name-" + data[j]['Customer Name'] + "<br/>Stall no-" + data[j].No_ + "<br />Stall Status-" + plotstatus + "<br />Stall Measurement:" + data[j]['Measurements'] + "</div>";*/
                            }
                            else {
                                plots = plots + "<div style='display:none;text-align:left;' id='divpt_" + plot_no + "'>Plot no-" + data[j].No_ + "<br />Plot Facing- " + facing + "<br />Plot Area-" + data[j]['Saleable Area'] + "<br />Plot Status-" + plotstatus + "<br />Plot Measurement: " + data[j]['Measurements'] + "</div>"; 
								 /*plots = plots + "<div style='display:none;text-align:left;' id='divpt_" + plot_no+  "<br/>Stall no-" + data[j].No_ + "<br />Stall Status-" + plotstatus + "<br />Stall Measurement:" + data[j]['Measurements'] + "</div>";*/
                            }
                        }

                    },
                    error: function (xhr, textStatus, errorThrown) {

                    }

                });
            }

            document.getElementById("div_hids").innerHTML = html;
            document.getElementById("div_facing").innerHTML = facing_div;
            document.getElementById("divplot").innerHTML = plots;
            document.getElementById("txt_totalplots").innerText = available + booked + reg;
            document.getElementById("txt_alloted").innerHTML = booked + reg;
            document.getElementById("txt_available").innerHTML = available;
        }
    }
    $.ajax({
        url: "http://13.235.113.76/mrrealtor/CompanyVentures/projectgardenimages",
        type: 'GET',
        
        dataType: 'json',
        async: false,
        processData: false,
        cache: false,
        success: function (data) {

            gardenimagesarray = data;
        },
        error: function (xhr, textStatus, errorThrown) {

        }

    });
    let url = "http://13.235.113.76/mrrealtor/CompanyVentures/getPlot_details/"+VentureID+"/"+CompID;
    console.log(url);
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        async: false,
        processData: false,
        cache: false,
        success: function (data) {
            //debugger;
            for (var i = 0; i < data.length; i++) {

                mapbackgroundimage = data[i].map_bgimage;
                var long = data[i].config_longitude;
                var latt = data[i].config_latitude;
                var zoom = parseFloat(data[i].config_zoom);
                var minzoom = parseFloat(data[i].config_minzoom);
                var maxzoom = parseFloat(data[i].config_maxzoom);

                var minlong = parseFloat(data[i].config_minlong);
                var minlat = parseFloat(data[i].config_minlat);
                var maxlong = parseFloat(data[i].config_maxlong);
                var maxlat = parseFloat(data[i].config_maxlat);
                var v1 = parseFloat(long);
                var v2 = parseFloat(latt);
                var center = ol.proj.fromLonLat([v1, v2]);
                var extents = ol.proj.get("EPSG:4326").getExtent();
                var rotation = parseFloat(data[i].CONFIG_ROTATION);
                var container = document.getElementById('popup');
                var content = document.getElementById('popup-content');
                var closer = document.getElementById('popup-closer');
                var textscale = data[i].config_textscale;
                var controls = ol.control.defaults({ rotate: false});
                var interactions = ol.interaction.defaults({ altShiftDragRotate: false, pinchRotate: false });
                var maxExtent = ol.proj.transformExtent(
                    [0, 0, 1300, 768], 'EPSG:4326', 'EPSG:3857');

                var overlay = new ol.Overlay(({
                    element: container,
                    autoPan: false,
                    autoPanAnimation: {
                        duration: 250
                    }
                }));
                closer.onclick = function () {
                    overlay.setPosition(undefined);
                    closer.blur();
                    return false;
                };
                console.log(data[i].CONFIG_BACKGROUNDIMAGE);
                var plotsource = new ol.source.Vector({
                    url: data[i].CONFIG_BACKGROUNDIMAGE,
                    format: new ol.format.GeoJSON()

                });
                var plotlayer = new ol.layer.Vector({

                    title: 'plots',
                    source: plotsource,
                    style: polygonstylefunction
                });


                var gardenlayer = new ol.layer.Vector({

                    title: 'plots',
                    source: new ol.source.Vector({
                        url: data[i].config_gardenjs,
                        format: new ol.format.GeoJSON()

                    }),

                });
                
                var roadlayer = new ol.layer.Vector({

                    title: 'plots',
                    source: new ol.source.Vector({
                        url: data[i].CONFIG_ROADJSON.replace('http', 'http'),
                        format: new ol.format.GeoJSON()

                    }),
                    style: roadpolygonstyle

                });
                var sidelayer = new ol.layer.Vector({

                    title: 'plots',
                    source: new ol.source.Vector({
                        url: data[i].PROJECT_LAYERJSON.replace('http', 'http'),
                        format: new ol.format.GeoJSON()

                    })


                });

                // var gmap = new google.maps.Map(document.getElementById('map'), {
                //   disableDefaultUI: true,
                // keyboardShortcuts: false,
                //draggable: false,
                //   disableDoubleClickZoom: true,
                // scrollwheel: false,
                //streetViewControl: false,
                //mapTypeControl: true,
                //mapTypeId: 'satellite'

                //});
                var x = window.matchMedia("(max-width: 700px)");
                if (x.matches) { // If media query matches
                    var view = new ol.View({
                    center: [0,0],
                    zoom: 17,
                    minZoom: minzoom,
                    maxZoom: maxzoom,
                    rotation: rotation,
                    enableRotation: false

                });
                  } else {
                   var view = new ol.View({
                    center: [0,0],
                    zoom: zoom,
                    minZoom: minzoom,
                    maxZoom: maxzoom,
                    rotation: rotation,
                    enableRotation: false

                });
                  }

                var view = new ol.View({
                    center: [0,0],
                    zoom: zoom,
                    minZoom: minzoom,
                    maxZoom: maxzoom,
                    rotation: rotation,
                    enableRotation: false
                });

                //view.on('change:center', function () {
                //    var center = ol.proj.transform(view.getCenter(), 'EPSG:3857', 'EPSG:4326');
                //    gmap.setCenter(new google.maps.LatLng(center[1], center[0]));
                //});
                //view.on('change:resolution', function () {
                //    gmap.setZoom(view.getZoom());
                //});

               // var olMapDiv = document.getElementById('olmap');
                var map = new ol.Map({
                    overlays: [overlay],
                    controls: controls,
                    renderer: 'canvas',
                    view: view,
                    interactions: ol.interaction.defaults({
                        altShiftDragRotate: false,
                        dragPan: false,
                        pinchRotate:false
                    }).extend([
    new ol.interaction.DragPan({kinetic: false}),
    new ol.interaction.MouseWheelZoom({duration: 0})
  ]),
                    target: 'map',

                });
                //view.setCenter([0, 0]);
                //view.setZoom(1);

                //olMapDiv.parentNode.removeChild(olMapDiv);
                //gmap.controls[google.maps.ControlPosition.TOP_LEFT].push(olMapDiv);

                var extent = [minlong, minlat, maxlong, maxlat];
                extent = ol.extent.applyTransform(extent, ol.proj.getTransform("EPSG:4326", "EPSG:3857"));



                function setTextPathStyle() {
                    //  debugger;
                    roadlayer.setTextPathStyle(function (f) {
                        var zoom = map.getView().getZoom();
                        if (zoom >= 17) {
                            var font_size = zoom * 10;
                            return [new ol.style.Style(
                            {

                                text: new ol.style.TextPath(
                                {
                                    text: f.get("name"),
                                    font: font_size - '168' + 'px Calibri,sans-serif',
                                    fill: new ol.style.Fill({ color: "#fff" }),
                                    textBaseline: "middle",
                                    textAlign: "center",
                                    rotateWithView: true,
                                    stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 0.5 })
                                }),


                            })]
                        }
                        else {
                            return [new ol.style.Style(
                            {

                                text: new ol.style.TextPath(
                                {
                                    text: f.get("name"),
                                    font: 0 + 'px Calibri,sans-serif',
                                    fill: new ol.style.Fill({ color: "#fff" }),
                                    textBaseline: "middle",
                                    textAlign: "center",
                                    rotateWithView: true,
                                    stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 0.5 })
                                }),


                            })]
                        }
                    })

                }

                function roadpolygonstyle(feature) {

                    if (feature) {

                        return new ol.style.Style({

                            fill: new ol.style.Fill({
                                color: 'black'
                            })

                        });
                    }


                }


                function polygonstylefunction(feature, resolution) {

                    if (feature) {
                        var zoom = map.getView().getZoom();
                        if (zoom >= 17) {
                            var font_size = zoom * 10;
                            return new ol.style.Style({
                                text: new ol.style.Text({
                                    text: feature.get('name'),
                                    scale: textscale,
                                    font: font_size - '168' + 'px Calibri,sans-serif',
                                    fill: new ol.style.Fill({ color: '#000' })
                                }),
                                fill: new ol.style.Fill({
                                    color: fillcolor(feature)
                                }),
                                stroke: new ol.style.Stroke({ color: 'rgba(0,0,0,0.9)', width: 2 })
                            });
                        }
                        else {
                            return new ol.style.Style({
                                text: new ol.style.Text({
                                    text: feature.get('name'),
                                    font: 0 + 'px Calibri,sans-serif',
                                    fill: new ol.style.Fill({ color: '#000' })
                                }),
                                fill: new ol.style.Fill({
                                    color: fillcolor(feature)
                                }),
                                stroke: new ol.style.Stroke({ color: 'rgba(0,0,0,0.9)', width: 2 })
                            });

                        }
                    }

                }
                function fillcolor(feature) {
                    if (document.getElementById('hid_' + feature.get('name')) != null) {
                        //console.log('hid_' + feature.get('name'));
                        var status = document.getElementById('hid_' + feature.get('name')).value;
                        
                        if (status == "A") {

                            var color;
                            color = data[i - 1].CONFIG_OPENCOLOR
                            return color;
                        }
                        else if (status == "P") {

                            var color;
                            color = data[i - 1].CONFIG_BOOKEDCOLOR
                            return color;
                        }

                        else if (status == "M") {

                            var color;
                            color = data[i - 1].CONFIG_MARTGAGECOLOR
                            return color;
                        }
                        else if (status == "NA") {

                            var color;
                            color = data[i - 1].CONFIG_REGISTEREDCOLOR
                            return color;
                        }
                        else {
                            var color;
                            color = data[i - 1].CONFIG_BOOKEDCOLOR;
                            return color;
                        }
                    }
                    else {
                        var color;
                        color = data[i - 1].CONFIG_BOOKEDCOLOR;
                        return color;
                    }
                }

                var pattern = "";
                var cnv = document.createElement('canvas');
                var ctx = cnv.getContext('2d');
                var img = new Image();
                img.src = 'https://maps.bbgindia.com/ADMIN/img/gtc.jpg'
                img.onload = function () {
                    pattern = ctx.createPattern(img, 'repeat');
                    gardenlayer.setStyle(new ol.style.Style({
                        fill: new ol.style.Fill({
                            color: pattern
                        })
                    }));

                }

                function gardenstyle(features) {


                    if (features.get('Name') == "park 1") {

                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park1") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img = new Image();
                                img.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img.onload = function () {
                                    pattern1 = ctx.createPattern(img, 'repeat');
                                }
                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern1
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 2") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park2") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img2 = new Image();
                                img2.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img2.onload = function () {
                                    pattern2 = ctx.createPattern(img2, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern2
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 3") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park3") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img3 = new Image();
                                img3.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img3.onload = function () {
                                    pattern3 = ctx.createPattern(img3, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern3
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 4") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park4") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img4 = new Image();
                                img4.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img4.onload = function () {
                                    pattern4 = ctx.createPattern(img4, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern4
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 5") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park5") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img5 = new Image();
                                img5.src = gardenimagesarray[i].GARDEN_IMGURL;
                                img5.onload = function () {
                                    pattern5 = ctx.createPattern(img5, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern5
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    else if (features.get('Name') == "park 6") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park6") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img6 = new Image();
                                img6.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img6.onload = function () {
                                    pattern6 = ctx.createPattern(img6, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern6
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 7") {

                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park7") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img7 = new Image();
                                img7.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img7.onload = function () {
                                    pattern7 = ctx.createPattern(img7, 'repeat');


                                }
                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern7
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 8") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park8") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img8 = new Image();
                                img8.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img8.onload = function () {
                                    pattern8 = ctx.createPattern(img8, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern8
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 9") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park9") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img9 = new Image();
                                img9.src = gardenimagesarray[i].GARDEN_IMGURL;
                                img9.onload = function () {
                                    pattern9 = ctx.createPattern(img9, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern9
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 10") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park10") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img10 = new Image();
                                img10.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img10.onload = function () {
                                    pattern10 = ctx.createPattern(img10, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern10
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 11") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park11") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img11 = new Image();
                                img11.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img11.onload = function () {
                                    pattern11 = ctx.createPattern(img11, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern11
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 12") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park12") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img12 = new Image();
                                img12.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img12.onload = function () {
                                    pattern12 = ctx.createPattern(img12, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern12
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 13") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park13") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img13 = new Image();
                                img13.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img13.onload = function () {
                                    var pattern13 = ctx.createPattern(img13, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern13
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 14") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park14") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img14 = new Image();
                                img14.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img14.onload = function () {
                                    pattern14 = ctx.createPattern(img14, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern14
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    if (features.get('Name') == "park 15") {
                        for (var i = 0; i < gardenimagesarray.length; i++) {
                            if (gardenimagesarray[i].garden_name == "park15") {

                                var cnv = document.createElement('canvas');
                                var ctx = cnv.getContext('2d');
                                var img15 = new Image();
                                img15.src = gardenimagesarray[i].GARDEN_IMGURL.replace('http', 'http');
                                img15.onload = function () {
                                    pattern15 = ctx.createPattern(img15, 'repeat');
                                }

                            }
                        }
                        return new ol.style.Style({
                            text: new ol.style.Text({
                                text: features.get('Name'),
                            }),
                            fill: new ol.style.Fill({
                                color: pattern15
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                    else {
                        return new ol.style.Style({
                            fill: new ol.style.Fill({
                                color: 'green'
                            }),
                            stroke: new ol.style.Stroke({ color: 'rgba(89,40,35,0.9)', width: 1 })
                        });
                    }
                }



                setTextPathStyle();
                map.addLayer(plotlayer);
                map.addLayer(roadlayer);
                map.addLayer(gardenlayer);
                map.addLayer(sidelayer);

                var plofeatures;

                plotsource.once('change', function (evt) {
                    if (plotsource.getState() === 'ready') {
                        // now the source is fully loaded
                        //debugger;
                        if (plotlayer.getSource().getFeatures().length > 0) {

                            plofeatures = plotlayer.getSource().getFeatures();
                            map.getView().fit(plotsource.getExtent(), map.getSize());


                        }
                    }
                });
                document.getElementById("select2").style.display = "none";
                document.getElementById("select3").style.display = "none";
                $('#select1').change(function () {
                    //debugger;
                    if ($('#select1 :selected').val() == 1) {
                        document.getElementById("txt_search").style.display = "block";
                        document.getElementById("select2").style.display = "none";
                        document.getElementById("select3").style.display = "none";
                    }
                    else if ($('#select1 :selected').val() == 2) {
                        document.getElementById("txt_search").style.display = "none";
                        document.getElementById("select2").style.display = "block";
                        document.getElementById("select3").style.display = "block";
                    }
                    else {
                        document.getElementById("txt_search").style.display = "none";
                        document.getElementById("select2").style.display = "none";
                        document.getElementById("select3").style.display = "block";
                    }

                });

                var emptyStyle = new ol.style.Style({ visible: 'none' });
                $('#btn_apply').click(function () {

                    
                    if ($('#select1 :selected').val() == 1) {
                        var plotid = document.getElementById("txt_search").value;
                        if(plotid.length == 1) 
                            plotid = "00"+plotid;
                        if(plotid.length == 2) 
                            plotid = "0"+plotid;
                        for (var i = 0; i < plofeatures.length; i++) {
                            
                            if (plotid == plofeatures[i].get('name')) {
                                var polygon = (plofeatures[i].getGeometry());
                                var size = (map.getSize());
                                view.fit(polygon, size);
                            }
                        }
                    }

                    if ($('#select1 :selected').val() == 2) {

                        for (var i = 0; i < plofeatures.length; i++) {

                            if (document.getElementById('hid_' + plofeatures[i].get('name')) != null) {
                                var statusid = document.getElementById('hid_' + plofeatures[i].get('name')).value;
                                //debugger;
                                if ($('#select2 :selected').val() == 'A') {
                                    document.getElementById("select3").style.display = "block";
                                    if (statusid == "A") {
                                        if ($('#select3 :selected').val() != 0) {
                                            var facingid = document.getElementById('hidfacing_' + plofeatures[i].get('name')).value;
                                            console.log(facingid,$('#select3 :selected').val());
                                            if ($('#select3 :selected').val() == facingid) {
                                                var feature = plofeatures[i];
                                                feature.setStyle(null);
                                            }
                                            else {
                                                var feature = plofeatures[i];
                                                feature.setStyle(emptyStyle);
                                            }
                                        }
                                        else {
                                            var feature = plofeatures[i];
                                            feature.setStyle(null);
                                        }

                                    }
                                    else {
                                        var feature = plofeatures[i];
                                        feature.setStyle(emptyStyle);
                                    }

                                }
                                else if ($('#select2 :selected').val() == 'NA') {

                                    if ((statusid == 'NA') || (statusid == 'M') || (statusid == 'P')) {

                                        var feature = plofeatures[i];
                                        feature.setStyle(null);
                                    }
                                    else {
                                        var feature = plofeatures[i];
                                        feature.setStyle(emptyStyle);
                                    }
                                }


                            }
                            else {
                                var feature = plofeatures[i];
                                feature.setStyle(emptyStyle);;
                            }

                        }


                    }

                    if ($('#select1 :selected').val() == 3) {
                        for (var i = 0; i < plofeatures.length; i++) {
                            if (document.getElementById('hidfacing_' + plofeatures[i].get('name')) != null) {
                                var statusid = document.getElementById('hidfacing_' + plofeatures[i].get('name')).value;
                                if ($('#select3 :selected').val() == 1) {
                                    if ((document.getElementById('hidfacing_' + plofeatures[i].get('name')).value == 1) || (document.getElementById('hidfacing_' + plofeatures[i].get('name')).value == 4)) {
                                        var feature = plofeatures[i];
                                        feature.setStyle(null);
                                    }
                                    else {
                                        var feature = plofeatures[i];
                                        feature.setStyle(emptyStyle);;

                                    }

                                }
                                else if ($('#select3 :selected').val() == 2) {
                                    if ((document.getElementById('hidfacing_' + plofeatures[i].get('name')).value == 2) || (document.getElementById('hidfacing_' + plofeatures[i].get('name')).value == 3)) {
                                        var feature = plofeatures[i];
                                        feature.setStyle(null);
                                    }
                                    else {
                                        var feature = plofeatures[i];
                                        feature.setStyle(emptyStyle);;

                                    }
                                }
                                else if ($('#select3 :selected').val() == document.getElementById('hidfacing_' + plofeatures[i].get('name')).value) {
                                    var feature = plofeatures[i];
                                    feature.setStyle(null);
                                }

                                else {
                                    var feature = plofeatures[i];
                                    feature.setStyle(emptyStyle);;

                                }

                            }
                        }
                    }
                });

                $('#btn_reset').click(function () {

                    var plofeatures = plotlayer.getSource().getFeatures();
                    for (var i = 0; i < plofeatures.length; i++) {
                        var feature = plofeatures[i];
                        feature.setStyle(null);
                    }
                    map.getView().fit(plotsource.getExtent(), map.getSize());

                });

                $('#resetmap').click(function () {

                    var plofeatures = plotlayer.getSource().getFeatures();
                    for (var i = 0; i < plofeatures.length; i++) {
                        var feature = plofeatures[i];
                        feature.setStyle(null);
                    }
                    map.getView().fit(plotsource.getExtent(), map.getSize());

                });

                var clickfun = "";
                if (data[i]["popup_click"] == 1) {
                    var clickfun = 'click';
                }
                else {
                    var clickfun = 'pointermove';
                }
                map.on(clickfun, function (evt) {

                    var feature = map.forEachFeatureAtPixel(evt.pixel,
                    function (feature) {
                        return feature;
                    });
                    if (feature) {
                        var cord = evt.coordinate;
                        // var coordinates = feature.getGeometry().getCoordinates();
                        if (document.getElementById('divpt_' + feature.get('name')) != null) {
                            content.innerHTML = ("<div style='text-align: left;'>" + document.getElementById('divpt_' + feature.get('name')).innerHTML + "</div>");
                            overlay.setPosition(cord);
                        }

                    }
                });


            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log('Error in Operation');
        }
    });
/* <!--$('.ol-unselectable').css('background-image', 'url("' + mapbackgroundimage + '")');--> */

});
