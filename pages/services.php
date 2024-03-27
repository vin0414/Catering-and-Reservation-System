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
            .tableFixHead thead th { position: sticky; top: 0; z-index: 1;color:#fff;background-color: #0275d8;}

            /* Just common table stuff. Really. */
            table  { border-collapse: collapse; width: 100%; }
            th, td { padding: 8px 16px;color:#000; }
            tbody{color:#000;}
            tr:nth-child(even) {
              background-color: #f2f2f2;
            }
            .badge{color:#ffffff;}
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
							<a href="services.php" class="active dropdown-toggle no-arrow">
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
								<li><a href="gallery.php">Gallery</a></li>
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
				<div class="title pb-20">
					<h2 class="h3 mb-0">Product/Services</h2>
					<div class="row">
					    <div class="col-8">
					        <input type="search" class="form-control" id="search" placeholder="Search"/>
					    </div>
					    <div class="col-2">
					        <button type="button" class="btn btn-primary add"><span class="bi bi-plus"></span> Add</button>
					    </div>
					</div>
				</div>
				<div class="row">
				    <div class="col-lg-9 form-group">
				        <div class="card-box">
				            <div class="table-responsive tableFixHead" style="height:600px;overflow-y:auto;">
				                <table class="table nowrap">
				                    <thead>
				                        <th>Event</th>
				                        <th>Packages</th>
				                        <th>Description</th>
				                        <th>Rate</th>
				                        <th>Status</th>
				                        <th>Action</th>
				                    </thead>
				                    <tbody id="tblpackage">
				                        <tr><td colspan="6"><center>No Data</center></td></tr>
				                    </tbody>
				                </table>
				            </div>
				        </div>   
				    </div>
				    <div class="col-lg-3 form-group">
				        <div class="card-box">
				            <div class="table-responsive tableFixHead">
				                <table class="table nowrap">
				                    <thead>
				                        <th>Event Name</th>
				                        <th>Action</th>
				                    </thead>
				                    <tbody id="tblevent">
				                        <tr>
				                            <td colspan="2"><center>No Data</center></td>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				        </div>
				        <br/>
				        <div class="card-box pd-20">
				            <form method="post" class="row" id="frmEvent" enctype="multipart/form-data">
				                <input type="hidden" name="action" value="add-event"/>
				                <div class="col-12">
				                    <label>Event Name</label>
				                    <input type="text" class="form-control" name="event_name"/>
				                </div>
				                <div class="col-12">
				                    <label>Details</label>
				                    <textarea class="form-control" style="height:100px;" name="details"></textarea>
				                </div>
				                <div class="col-12">
				                    <label>Image</label>
				                    <input type="file" class="form-control" name="file"/>
				                </div>
				                <div class="col-12">
				                    <input type="submit" class="form-control btn btn-primary" id="btnAdd"/>
				                </div>
				            </form>
				        </div>
				    </div>
				</div>
			</div>
		</div>
		                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
									aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel">
													Add Entry
												</h5>
												<button
													type="button"
													class="close"
													data-dismiss="modal"
													aria-hidden="true"
												>
													×
												</button>
											</div>
											<div class="modal-body">
												<form method="post" class="row" id="frmEntry">
												    <input type="hidden" name="action" value="add-package"/>
												    <div class="col-12 form-group">
												        <label>Event Name</label>
												        <select class="form-control" id="event" name="event">
												            <option value="">Choose</option>
												        </select>
												    </div>
												    <div class="col-12 form-group">
												        <label>Package</label>
												        <select class="form-control" name="package">
												            <option value="">Choose</option>
												            <option>Standard Package</option>
												        </select>
												    </div>
												    <div class="col-12 form-group">
												        <label>Details/Description</label>
												        <textarea class="form-control" style="height:150px;" name="details"></textarea>
												    </div>
												    <div class="col-12 form-group">
												        <label>Rate</label>
												        <input type="text" class="form-control" name="rate"/>
												    </div>
												    <div class="col-12 form-group">
												        <input type="submit" class="form-control btn btn-primary" id="btnSave"/>
												    </div>
												</form>
											</div>
										</div>
									</div>
								</div>
								
								<div class="modal fade" id="editModal" tabindex="-1" role="dialog"
									aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel">
													Edit Product/Services
												</h5>
												<button
													type="button"
													class="close"
													data-dismiss="modal"
													aria-hidden="true"
												>
													×
												</button>
											</div>
											<div class="modal-body">
											    <div id="output"></div>
											</div>
										</div>
									</div>
								</div>
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script>
		    $(document).ready(function()
		    {
		       event();packages();fetch();
		       $(document).on('click','.add',function()
		       {
		           $('#addModal').modal('show');
		       });
		       $(document).on('click','.update',function(evt)
		       {
		           evt.preventDefault();
		           var confirmation = confirm("Do you want to apply some changes?");
		           if(confirmation)
		           {
		               var val = $(this).val();
		               var rate = $('#rate').val();
		               var desc = $('#description').val();
		               var stat = $('#status').val();
		               var action = "update";
		               $.ajax({
		                  url:"../resources/entry.php",method:"POST",
    		              data:{action:action,rate:rate,description:desc,status:stat,value:val},
    		              success:function(data)
    		              {
    		                  if(data==="success")
    		                  {
    		                      $('#editModal').modal('hide');
    		                    packages();
    		                  }
    		                  else
    		                  {
    		                      alert(data);
    		                  }
    		              } 
		               });
		           }
		       });
		       $(document).on('click','.edit',function()
		       {
		           var action = "edit";
		           var val = $(this).val();
		           $.ajax({
		              url:"../resources/entry.php",method:"POST",
		              data:{action:action,value:val},
		              success:function(data)
		              {
		                  $('#editModal').modal('show');
		                  $('#output').html(data);
		              }
		          });
		       });
		       $(document).on('click','.delete',function()
		       {
		          var confirmation = confirm("Remove this selected event?");
		          if(confirmation)
		          {
		              var action = "remove";
		              var val = $(this).val();
		              $.ajax({
		                  url:"../resources/entry.php",method:"POST",
		                  data:{action:action,value:val},
		                  success:function(data)
		                  {
		                      alert(data);
		                      event();
		                  }
		              });
		          }
		       });
		    });
		    function fetch()
		    {
		        var action ="fetch";
		        $.ajax({
		            url:"../resources/entry.php",method:"POST",
		            data:{action:action},
		            success:function(data)
		            {
		                $('#event').append(data);
		            }
		        });
		    }
		    $('#search').keyup(function()
		    {
		        var action = "search-Packages";
		        var val = $(this).val();
		        $('#tblpackage').html("<tr><td colspan='6'><center>Searching...</center></td></tr>");
		        $.ajax({
		            url:"../resources/entry.php",method:"POST",
		            data:{action:action,keyword:val},
		            success:function(data)
		            {
		                if(data==="")
		                {
		                    $('#tblpackage').html("<tr><td colspan='6'><center>No Data</center></td></tr>");
		                }
		                else
		                {
		                    $('#tblpackage').html(data);
		                }
		            }
		        });
		    });
		    function packages()
		    {
		        var action = "Packages";
		        $.ajax({
		            url:"../resources/entry.php",method:"POST",
		            data:{action:action},
		            success:function(data)
		            {
		                if(data==="")
		                {
		                    $('#tblpackage').html("<tr><td colspan='6'><center>No Data</center></td></tr>");
		                }
		                else
		                {
		                    $('#tblpackage').html(data);
		                }
		            }
		        });
		    }
		    function event()
		    {
		        var action = "Event";
		        $.ajax({
		            url:"../resources/entry.php",method:"POST",
		            data:{action:action},
		            success:function(data)
		            {
		                if(data==="")
		                {
		                    $('#tblevent').html("<tr><td colspan='2'><center>No Data</center></td></tr>");
		                }
		                else
		                {
		                    $('#tblevent').html(data);
		                }
		            }
		        });
		    }
		    
		    $('#frmEvent').on('submit',function(evt)
            {
                evt.preventDefault();
                $.ajax({
                    url:"../resources/entry.php",method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('#btnAdd').attr("disabled","disabled");
                        $('#frmEvent').css("opacity",".5");
                    },
                    success:function(data)
                    {
                        if(data==="success")
                        {
                            $('#frmEvent')[0].reset();
                            fetch();event();
                        }
                        else
                        {
                            alert(data);
                        }
                        $('#frmEvent').css("opacity","");
                        $("#btnAdd").removeAttr("disabled");
                    }
                });
            });
		    
		    $('#btnSave').on('click',function(evt)
		    {
		       evt.preventDefault();
		       var data = $('#frmEntry').serialize();
		       $.ajax({
		            url:"../resources/entry.php",method:"POST",
		            data:data,
		            success:function(data)
		            {
		                if(data==="success")
		                {
		                    packages();
		                    $('#addModal').modal('hide');
		                    $('#frmEntry')[0].reset();
		                }
		                else
		                {
		                    alert(data);
		                }
		            }
		        });
		    });
		    
		</script>
	</body>
</html>
