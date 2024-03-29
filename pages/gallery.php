<?php
    session_start();
    if(empty($_SESSION['sess_fullname']) || $_SESSION['sess_fullname'] == ''|| $_SESSION['sess_role']!="Super-user"){
    header("Location: https://zephaniah-catering.com/");
    die();
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Zephaniah's Catering</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="../assets/img/logo.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="../assets/img/logo.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="../assets/img/logo.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
		<style>
        /* Track */
            ::-webkit-scrollbar-track {
              background: #f1f1f1; 
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
              background: #888; 
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
              background: #555; 
            }
            ::-webkit-scrollbar {
                height: 4px;              /* height of horizontal scrollbar ← You're missing this */
                width: 4px;               /* width of vertical scrollbar */
                border: 1px solid #d5d5d5;
              }
            
        </style>
	</head>
	<body>
<!--		<div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-logo">
					<img src="../assets/img/logo.png" alt="" width="100"/>
				</div>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div>-->

		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
			</div>
			<div class="header-right">
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<span class="micon bi bi-person"></span>
							</span>
							<span class="user-name"><?php echo $_SESSION['sess_fullname'] ?></span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="profile.php"
								><i class="dw dw-user1"></i> Profile</a
							>
							<a class="dropdown-item" href="../logout.php"
								><i class="dw dw-logout"></i> Log Out</a
							>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					Layout Settings
					<span class="btn-block font-weight-400 font-12"
						>User Interface Settings</span
					>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Header Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-white active"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
					<div class="sidebar-radio-group pb-10 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-1"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebaricon-1"
								><i class="fa fa-angle-down"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-2"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-2"
							/>
							<label class="custom-control-label" for="sidebaricon-2"
								><i class="ion-plus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-3"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-3"
							/>
							<label class="custom-control-label" for="sidebaricon-3"
								><i class="fa fa-angle-double-right"></i
							></label>
						</div>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
					<div class="sidebar-radio-group pb-30 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-1"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-1"
								><i class="ion-minus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-2"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-2"
							/>
							<label class="custom-control-label" for="sidebariconlist-2"
								><i class="fa fa-circle-o" aria-hidden="true"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-3"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-3"
							/>
							<label class="custom-control-label" for="sidebariconlist-3"
								><i class="dw dw-check"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-4"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-4"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-4"
								><i class="icon-copy dw dw-next-2"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-5"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-5"
							/>
							<label class="custom-control-label" for="sidebariconlist-5"
								><i class="dw dw-fast-forward-1"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-6"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-6"
							/>
							<label class="custom-control-label" for="sidebariconlist-6"
								><i class="dw dw-next"></i
							></label>
						</div>
					</div>

					<div class="reset-options pt-30 text-center">
						<button class="btn btn-danger" id="reset-settings">
							Reset Settings
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="../index.php">
					<img src="../assets/img/logo.png" alt="" class="dark-logo" width="50" />
					<img
						src="../assets/img/logo.png"
						width="50"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li class="dropdown">
							<a href="dashboard.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-house"></span
								><span class="mtext">Dashboard</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-calendar4-week"></span
								><span class="mtext">Booking</span>
							</a>
							<ul class="submenu">
								<li><a href="add-book.php">Add Booking</a></li>
								<li><a href="booking.php">All Book</a></li>
								<li><a href="list.php">View Payment</a></li>
							</ul>
						</li>
						<li>
							<a href="customer.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-people"></span
								><span class="mtext">Inquiries</span>
							</a>
						</li>
						<li>
							<a href="services.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-bag"></span
								><span class="mtext">Events Data Management</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
								><span class="mtext">Content Management</span>
							</a>
							<ul class="submenu">
								<li><a href="menu.php">Menu</a></li>
								<li><a href="gallery.php" class="active">Gallery</a></li>
								<li><a href="other-services.php">Other Services</a></li>
								<li><a href="service-charge.php">Service Charge</a></li>
							</ul>
						</li>
						<li>
							<a href="settings.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-laptop"></span
								><span class="mtext">Settings</span>
							</a>
						</li>
						<li>
							<a href="profile.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-person"></span
								><span class="mtext">Profile</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="xs-pd-20-10 pd-ltr-20">
				<div class="row">
			        <div class="col-lg-4 form-group">
					    <div class="card-box pd-20">
					        <div class="card-title">Upload Pictures</div>
					        <form method="POST" enctype="multipart/form-data" class="row" id="frmGallery">
					            <input type="hidden" name="action" value="upload"/>
					            <div class="col-12 form-group">
					                <label>Event Name</label>
					                <input type="text" class="form-control" name="file_name"/>
					            </div> 
					            <div class="col-12 form-group">
					                <label>File</label>
					                <input type="file" class="form-control" name="file"/>
					            </div> 
					            <div class="col-12 form-group">
					                <input type="submit" class="form-control btn btn-primary" id="btnSave"/>
					            </div> 
					        </form>
					    </div>
						<br/>
						<select class="form-control" id="sort">
							<option value="">Sort By</option>
							<option>Birthday</option>
							<option>Wedding</option>
							<option>Corporate</option>
						</select>
					</div>
					<div class="col-lg-8 form-group">
					    <div class="row" id="result" style="height:650px;overflow-y:auto;">
					       <div class="col-12"><center>No Data</center></div>    
					    </div>   
					</div>
				</div>
			</div>
		</div>
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script>
		    $('#document').ready(function()
		    {
		       load(); 
		       $(document).on('click','.remove',function()
		       {
		          var ask = confirm("Do you want to remove this selected Image?"); 
		          if(ask)
		          {
		              var val = $(this).val();
		              var action = "remove";
		              $.ajax({
    		            url:"../resources/upload.php",method:"POST",
    		            data:{action:action,value:val},
    		            success:function(data)
    		            {
    		                if(data==="success")
    		                {
    		                    load();
    		                }
    		                else
    		                {
    		                    alert(data);
    		                }
    		            }
    		        });
		          }
		       });
		    });

			$('#sort').change(function()
			{
				var val = $(this).val();
				var action = "sort";
				$('#result').html("<div class='col-12'><center>Loading....</center></div>");
		        $.ajax({
		            url:"../resources/upload.php",method:"POST",
		            data:{action:action,value:val},
		            success:function(data)
		            {
		                if(data==="")
		                {
		                    $('#result').html("<div class='col-12'><center>No Data</center></div>");
		                }
		                else
		                {
		                    $('#result').html(data);
		                }
		            }
		        });
			});

		    function load()
		    {
		        var action = "gallery";
		        $.ajax({
		            url:"../resources/upload.php",method:"POST",
		            data:{action:action},
		            success:function(data)
		            {
		                if(data==="")
		                {
		                    $('#result').html("<div class='col-12'><center>No Data</center></div>");
		                }
		                else
		                {
		                    $('#result').html(data);
		                }
		            }
		        });
		    }
		    $('#frmGallery').on('submit',function(evt)
            {
                evt.preventDefault();
                $.ajax({
                    url:"../resources/upload.php",method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('#btnSave').attr("disabled","disabled");
                        $('#frmGallery').css("opacity",".5");
                    },
                    success:function(data)
                    {
                        if(data==="success")
                        {
                            $('#frmGallery')[0].reset();
                            alert('Great! Successfully submitted');
                            load();
                        }
                        else
                        {
                            alert(data);
                        }
                        $('#frmGallery').css("opacity","");
                        $("#btnSave").removeAttr("disabled");
                    }
                });
            });
		</script>
	</body>
</html>
