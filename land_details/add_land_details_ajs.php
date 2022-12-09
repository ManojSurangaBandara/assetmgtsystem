<?php
include '../view/header_angular.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>

<script>
$(document).ready(function() {
    $('.date').datepicker({dateFormat: 'yy-mm-dd',
        maxDate: '0',
		changeMonth : true,
        changeYear: true});
	$("input, select").focus(function(){
		setMessage(0);
		});
//	$('#sidebar1').delegate('li', 'click', function() {
 //       var id = $(this).attr('id');
//		alert(id);
//		    });
setMessage(<?php echo $error ?>);
//showSidebar(3);		
}); // end ready	
function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
function setMessage(err)
{
	switch (err) {
		case 0:
			$('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title"><?php echo $errors[0][$lang]?></strong></li>');
			break;		
		case 1:
			$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>');
			break;
		case 2:
			$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Updated.</strong></li>');
			break;
		case 3:
			$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Assets Identification Number Already Entered</strong></li>');
			break;
		case 4:
			$('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Modify Data and Press Update Land Details Button.</strong></li>');
			break;
		case 5:
			$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
			break;
		case 6:
			$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
			break;
	}
}
    function showSidebar(id){
        $.ajax({
            type: "GET",
            url: "index.php",
            data: "action=showSidebar&id=" + id,
            success: function(result) {
                $('#sidebar1').empty();
                var item = $.parseJSON(result);
                var options = '';
                $.each(item, function(key, value) {
                    $("#sidebar1").append('<li id="' + value.id + '"><a href="#">' + value.identificationno + '</a></li>');
                });
            }
        });
    }

	var app = angular.module('myApp', []);
	app.controller('assetscentre', function($scope, $http) {
    $scope.assetscenters = <?php echo json_encode($ac); ?>;
	$scope.assetsunits = <?php echo json_encode($au); ?>;
	$scope.provinces = <?php echo json_encode($prov); ?>;
	$scope.categorys = <?php echo json_encode($categorys); ?>;
	$scope.natureOwnerships = ["ACQUIRED", "DONATION", "LEASE", "PURCHASE"];
	$scope.ownerships = ["ARMY LAND", "OTHER LAND"];
	$scope.areaMeasures = ["IMPERIAL UNITS", "METRIC UNITS"];
	$scope.acquisitionInstitutes = ["GOVERNMENT", "PRIVATE"];
	$scope.ipmtomet = function() {
		$scope.land.area = (parseInt($scope.land.acre,10) * 0.404685642)+(parseInt($scope.land.rood,10) * 0.101171410)+(parseInt($scope.land.parch,10) * 0.00252928526);
    };
	$scope.mettoipm = function() {
			$scope.land.acre = Math.floor($scope.land.area / 0.40468564224047);
            var roodTem = $scope.land.area % 0.40468564224047;
			$scope.land.rood = Math.floor(roodTem / 0.101171410560120);
			parchTem = roodTem % 0.101171410560120;
            $scope.land.parch = parchTem / 0.0025292852640029;
	}; 
	////////////
	$scope.updateunit = function() {
	TestCtrl();
	}
	function TestCtrl(){
		$http({
        url: "index.php?action=findAssetsUnitsByCenter_AJS",
        method: "POST",
        data: {
            assetscenter: $scope.land.assetscenter
        }
		}).success(function(response) {
			$scope.assetsunits = response;
			//alert(response);
		});
	}
	$scope.updatedistrict = function() {
		$http({
        url: "index.php?action=findDistrictByProvince_AjS",
        method: "POST",
        data: {
            province: $scope.land.province
        }
		}).success(function(response) {
			$scope.districts = response;
			//alert(response);
		});
	}
	$scope.updatedsDivision = function() {
		$http({
        url: "index.php?action=findDSByDistrict_AJS",
        method: "POST",
        data: {
            district: $scope.land.district
        }
		}).success(function(response) {
			$scope.dsDivisions = response;
			//alert(response);
		});
	}
	$scope.updategsDivision = function() {
		$http({
        url: "index.php?action=findGSByDS_AJS",
        method: "POST",
        data: {
            dsDivision: $scope.land.dsDivision
        }
		}).success(function(response) {
			$scope.gsDivision = response;
			//alert(response);
		});
	}
	$scope.getAssetsno = function() {
		$http({
        url: "index.php?action=findAssetsnoByCategory_AJS",
        method: "POST",
        data: {
            category: $scope.land.category
        }
		}).success(function(response) {
			$scope.land.assetsno = response[0];
			$scope.land.classificationno = response[1];
			//alert(response);
		});
	}
	
	$scope.generatecode = function() {
		$http({
        url: "index.php?action=generateCode_AJS",
        method: "POST",
        data: {
			assetsUnit: $scope.land.assetunit,
			district: $scope.land.district,
			ownership: $scope.land.ownership,
			id: $scope.land.id,
			counterID: $scope.land.counterID,
			assetsno: $scope.land.assetsno
        }
		}).success(function(response) {
			$scope.land.identificationno = response;
			//alert(response);
		});
	} 
	$scope.submitForm = function() {
		$http({
        url: "index.php?action=Add_Land_Detail_AJS",
        method: "POST",
        data: $scope.land
		}).success(function(response) {
			setMessage(parseInt(response));
			$("html, body").animate({scrollTop: 0}, "slow");
			//alert(response);
		});
	}
	$scope.NotApproved = <?php echo json_encode($Items); ?>;
	//////
	$scope.sideBarClick = function(id) {
		$http({
        url: "index.php?action=update_Details_AJS",
        method: "POST",
        data: {
			id: id
        }
		}).success(function(response) {
			$scope.land = response;
			$scope.assetsunits = TestCtrl();
			$scope.districts = $scope.updatedistrict();
			$scope.dsDivisions = $scope.updatedsDivision();
			$scope.dgDivisions = $scope.updategsDivision();
			$scope.land.assetunit = response.assetunit;
			alert($scope.land.assetunit);
		});
	}
	});
</script>

<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2><?php if ($id == 0) {echo $title[$lang];} else {echo $identificationnoTem;} ?></h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
								     <ul class="system_messages" id="message">
                                    </ul>
								<form name="landForm" class="form-horizontal" ng-init="land.id = 0; land.counterID = 0">
									<div class="form-group">
										  <label class="control-label col-sm-3" for="sel1"><?php echo $tList[0][$lang]?></label>
										  <div class="col-sm-5">
												<select class="form-control" ng-model="land.assetscenter" ng-init="land.assetscenter='<?php echo $assetscenter ?>'"	ng-options="c for c in assetscenters" required>
												<option value=""></option>
												</select>
										  </div>
										</div>
										<div class="form-group">
										  <label class="control-label col-sm-3" for="sel2"><?php echo $tList[1][$lang]?></label>
										  <div class="col-sm-5">
											  <select class="form-control" ng-model="land.assetunit" ng-init="land.assetunit='<?php echo $assetunit ?>'"required>
												<option value=""></option>
												<option ng-repeat="c in assetsunits" value="{{c}}">{{c}}</option>
												</select>
										  </div>
										</div>
									<div class="form-group">
										<label class="control-label col-sm-3" for="province"><?php echo $tList[2][$lang]?></label>
										<div class="col-sm-5">
											<select class="form-control" ng-model="land.province"
													ng-change="updatedistrict()" required>
													<option value=""></option>
													<option ng-repeat="c in provinces" value="{{c}}">{{c}}</option>
												</select>
									</div>
								  </div>
								  <div class="form-group">
										<label class="control-label col-sm-3" for="land.district"><?php echo $tList[3][$lang]?></label>
										<div class="col-sm-5">
											<select class="form-control" ng-model="land.district"
													ng-change="updatedsDivision()" required>
													<option value=""></option>
													<option ng-repeat="c in districts" value="{{c}}">{{c}}</option>
												</select>
									</div>
								  </div>
								  <div class="form-group">
										<label class="control-label col-sm-3" for="land.dsDivision"><?php echo $tList[4][$lang]?></label>
										<div class="col-sm-5">
											<select class="form-control" ng-model="land.dsDivision"
													ng-change="updategsDivision()" ng-options="c for c in dsDivisions"  required>
												</select>
									</div>
								  </div>
								  <div class="form-group">
										<label class="control-label col-sm-3" for="land.gsDivision"><?php echo $tList[5][$lang]?></label>
										<div class="col-sm-5">
											<select class="form-control" ng-model="land.gsDivision"
													ng-options="c for c in gsDivision" required>
												</select>
									</div>
								  </div>
								  <div class="form-group">
										<label class="control-label col-sm-3" for="land.category"><?php echo $tList[6][$lang]?></label>
										<div class="col-sm-5">
											<select class="form-control" ng-model="land.category"
													ng-change="getAssetsno()" ng-options="c for c in categorys" required>
											</select>
									</div>
								  </div>
								  <div class="form-group">
									<label class="control-label col-sm-3" for="assetsno"><?php echo $tList[7][$lang]?></label>
									<div class="col-sm-2">
									  <input type="text" class="form-control" ng-model="land.assetsno" readonly required>
									</div>
									<div class="col-sm-3">
									  <input type="text" class="form-control" ng-model="land.classificationno" readonly required>
									</div>
								  </div>
								  <div class="form-group">
									<label class="control-label col-sm-3" for="landNature"><?php echo $tList[15][$lang]?></label>
									<div class="col-sm-5"> 
									  <input type="text" class="form-control" ng-model="land.landNature" name="landNature" id="landNature" style="text-transform: uppercase;" required>
									  <span ng-show="landForm.landNature.$error.required" ng-if="landForm.landNature.$dirty" style="color:red">
										This is a required field
										</span>
									</div>
								  </div>
								  <div class="form-group">
										<label class="control-label col-sm-3" for="land.natureOwnership"><?php echo $tList[8][$lang]?></label>
										<div class="col-sm-5">
											<select class="form-control" ng-model="land.natureOwnership" name="natureOwnership"
													ng-options="c for c in natureOwnerships" required>
											</select>
										<span ng-show="landForm.natureOwnership.$error.required" ng-if="landForm.landNature.$dirty" style="color:red">
										This is a required field
										</span>
									</div>
								  </div>
								  <div class="form-group">
										<label class="control-label col-sm-3" for="land.ownership"><?php echo $tList[9][$lang]?></label>
										<div class="col-sm-5">
											<select class="form-control" ng-model="land.ownership"
													ng-options="c for c in ownerships" required>
											</select>
									</div>
								  </div>								  
								  <div class="form-group">
									<label class="control-label col-sm-3" for="register"><?php echo $tList[10][$lang]?></label>
									<div class="col-sm-5"> 
									  <input type="text" class="form-control" ng-model="land.register" id="register" style="text-transform: uppercase;" required>
									</div>
								  </div>
								  <div class="form-group">
									<label class="control-label col-sm-3" for="landname"><?php echo $tList[11][$lang]?></label>
									<div class="col-sm-5"> 
									  <input type="text" class="form-control" ng-model="land.landname" id="landname" style="text-transform: uppercase;">
									</div>
								  </div>
								   <div class="form-group">
									<label class="control-label col-sm-3" for="planno"><?php echo $tList[12][$lang]?></label>
									<div class="col-sm-5"> 
									  <input type="text" class="form-control" ng-model="land.planno" id="planno" style="text-transform: uppercase;">
									</div>
								  </div>
								   <div class="form-group">
									<label class="control-label col-sm-3" for="deedno"><?php echo $tList[13][$lang]?></label>
									<div class="col-sm-5"> 
									  <input type="text" class="form-control" ng-model="land.deedno" id="deedno" style="text-transform: uppercase;">
									</div>
								  </div>
								   <div class="form-group">
									<label class="control-label col-sm-3" for="deeddate"><?php echo $tList[14][$lang]?></label>
									<div class="col-sm-5"> 
									  <input type="text" class="form-control date" ng-model="land.deeddate" id="deeddate">
									</div>
								  </div>
								  	<div class="form-group">
									<label class="control-label col-sm-3" for="acquisitiondate"><?php echo $tList[20][$lang]?></label>
									<div class="col-sm-5"> 
									  <input type="text" class="form-control date" ng-model="land.acquisitiondate" id="acquisitiondate">
									</div>
								  </div>
								  <div class="form-group">
										<label class="control-label col-sm-3" for="land.areaMeasure"><?php echo $tList[16][$lang]?></label>
										<div class="col-sm-2">
											<select class="form-control" ng-model="land.areaMeasure" ng-init="land.areaMeasure='IMPERIAL UNITS'"
													ng-options="c for c in areaMeasures">
											</select>
										</div>
										
								  </div>
								  <div class="form-group">
									<label class="control-label col-sm-3" for="area">Area :</label>
									  <div class="col-sm-2">
											<input type="text" min="0" onkeypress="validate(event)" class="form-control col-sm-2" ng-model="land.acre" id="acre" ng-readonly="land.areaMeasure == 'METRIC UNITS'" ng-init="land.acre = 0" ng-change="ipmtomet()" style="text-align:right;" required>
											<label class="control-label col-sm-1">Acres</label>
										</div>						
										 <div class="col-sm-2">
											<input type="text" min="0" ng-max="3" onkeypress="validate(event)" class="form-control col-sm-2" ng-model="land.rood" id="rood" ng-readonly="land.areaMeasure == 'METRIC UNITS'" ng-init="land.rood = 0" ng-change="ipmtomet()" style="text-align:right;" required>
											<label class="control-label col-sm-1">Rood</label>
										</div>
										 <div class="col-sm-2">
											<input type="text" min="0" onkeypress="validate(event)"class="form-control col-sm-2" ng-model="land.parch" id="parch" ng-readonly="land.areaMeasure == 'METRIC UNITS'" ng-init="land.parch = 0" ng-change="ipmtomet()" style="text-align:right;" required>
											<label class="control-label col-sm-1">Perch</label>
										</div>
											<div class="col-sm-2">
											<input type="text" min="0" onkeypress="validate(event)" class="form-control col-sm-2" ng-model="land.area" id="area" ng-readonly="land.areaMeasure == 'IMPERIAL UNITS'" ng-init="land.area = 0" ng-change="mettoipm()" style="text-align:right;" required>
											<label class="control-label col-sm-1">Hectare</label>
										</div>
								  </div>
								  <div class="form-group">
										<label class="control-label col-sm-3" for="land.estimatedValue"><?php echo $tList[18][$lang]?></label>
										<div class="col-sm-2">
											<input type="text" min="0" onkeypress="validate(event)" class="form-control col-sm-2 pull-right" ng-model="land.estimatedValue" id="estimatedValue" style="text-align:right;" required>
										</div>
										
								  </div>
								  <div class="form-group">
										<label class="control-label col-sm-3" for="land.acquisitionInstitute"><?php echo $tList[19][$lang]?></label>
										<div class="col-sm-2">
											<select class="form-control" ng-model="land.acquisitionInstitute" ng-options="c for c in acquisitionInstitutes">
											</select>
										</div>
										<div class="col-sm-5"> 
											<input type="text" class="form-control" ng-model="land.previousownership" id="previousownership" style="text-transform: uppercase;">
										</div>
								  </div>
								  <div class="form-group">
										<label class="control-label col-sm-3" for="land.remarks"><?php echo $tList[21][$lang]?></label>
										<div class="col-sm-7"> 
											<input type="text" class="form-control" ng-model="land.remarks" id="remarks" style="text-transform: uppercase;">
										</div>
								  </div>
								  <div class="form-group">
										<label class="control-label col-sm-3" for="land.identificationno"><?php echo $tList[22][$lang]?></label>
										<div class="col-sm-5"> 
										<div class="input-group">
											<input type="text" class="form-control" ng-model="land.identificationno" id="identificationno" readonly required>
											<span class="input-group-btn">
												<button class="btn btn-primary" type="button" ng-click="generatecode()" ng-disabled="!land.district || !land.ownership || !land.assetsno"> Generate Number</button>
										</div>
										</div>
								  </div>
								  <div class="form-group"> 
									<div class="col-sm-offset-3 col-sm-5">
									  <button type="submit" ng-click="submitForm()" class="btn btn-primary" ng-disabled="landForm.$invalid">Add Land Details</button>
									</div>
								  </div>
								</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="sidebar">
    <div class="inner">
        <p>&nbsp;</p>
        <div class="section">
            <div class="section">
                <div class="title_wrapper">
                            <h2><?php echo $slideBar[2][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                </div>
                <div class="section_content">
                    <div class="sct">
                        <div class="sct_left">
                            <div class="sct_right">
                                <div class="sct_left">
                                    <div class="sct_right" >
									<div id="nav">
                                        <ul class="sidebar_menu" id="sidebar1">
											<li ng-repeat="x in NotApproved" ng-click="sideBarClick(x.id)"><a href="#">
												{{ x.identificationno }}
											</a></li>                                                     
                                        </ul>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                </div>
            </div>
        </div>
        <?php
        switch ($slidebartype) {
            case 12:
            case 1:
			case 3:
			case 4:
			case 27:
                include 'sidebar_sub.php';
                break;
        }
        ?>       
        <?php include '../view/quick_info.php'; ?>
    <P>

	</P>

	</div>
</div>
<?php
//include('sidebar.php');

include '../view/footer.php';
?>










