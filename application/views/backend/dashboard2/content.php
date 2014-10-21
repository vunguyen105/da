<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
                                                  <?php if($this->session->flashdata('message') != FALSE){?>
                                                    <div class="alert alert-error">
                                                      <button class="close" data-dismiss="alert"></button>
                                                      <span><?php echo $this->session->flashdata('message');?></span>
                                                    </div>
                                                    <?php }?>
						Blank page content goes here
                                                <a class="btn confirmbutton"><small>Confirm Box</small></a> &nbsp;
					</div>
				</div>
<!-- END PAGE CONTENT-->