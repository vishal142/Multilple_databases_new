<?php 
$this->load->view('include/meta.php');?>
<?php $this->load->view('include/header.php');?>
<!--sidebar-->
<?php $this->load->view('include/sidebar.php');?>
<!--end Sidebar-->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page_title; ?>
      </h1>
      <ol class="breadcrumb">
        <?php echo $breadcrumb; ?>
      </ol>
    </section>
	
	<?php //print_r($page_title);?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">     
<?php
 if($this->session->flashdata('succmsg')): ?>
    <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert">
      <i class="ace-icon fa fa-times"></i>
    </button>
     <?php echo $this->session->flashdata('succmsg');?>
    <br>
    </div>
<?php endif; ?>

		   
		    <div class="alert alert-danger" id="user_delete" style="display:none">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                        Image Delete Successfully
                    <br>
                </div>
           
            <div class="box-header">
              <h3 class="box-title pull-right">
              <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/addon/add_addon'); ?>" title="Add Add-On Item"> <i class="ace-icon fa glyphicon-plus white"></i>Add New </a>
              
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL #</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
                 
                </tr>
                </thead>
                <tbody>
                 <?php
				if($recordset)
				{
				//print_r($recordset);
				$startRecord ='0';
				$i = '1';
					foreach($recordset as $row)
					{
					  $editLink = base_url('admin/addon/add_addon/').$row['id'];
				?>
                <tr id="tr<?php echo $row['id']; ?>">
                  <td><?php echo $i; ?></td>
                 
                  <td><img src="<?php echo base_url().'img.php?img=addon/'.$row['image'];?>&amp;mode=cm&amp;w=100&amp;h=60"></td>
                  <td><?php echo $row['addon_name']; ?></td>
                  <td><?php echo $row['addon_price']; ?></td>
                  <td><?php echo $row['status']; ?></td>
                  <td>
                  <a class="btn btn-xs btn-info" href="<?php echo $editLink;?>" title="Edit Add On Item"> <i class="ace-icon fa fa-pencil bigger-120"></i></a> 

                  <a class="btn btn-xs btn-danger" href="javascript:void(0);" title="Delete Add On Item" onclick="delete_user('<?php echo $row['id']; ?>');"> <i class="ace-icon fa fa-trash-o bigger-120"></i></a>
                  </td>
                
                </tr>
                <?php
                $i++;
					}
				}
				else
				{
				?>
                <tr>
                  <td colspan="8">No Records Found</td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<script>
$(window).load(function(e) {
    $('#example1 th:nth-child(1)').removeClass('sorting').removeClass('no_sort sorting_asc').css('width','21px');
	$('#example1 th:nth-child(7)').removeClass('sorting').removeClass('no_sort sorting_asc');
});

function change_status(id){
	
	if(confirm("Are you sure to change status of this record?"))
	{
		$.ajax({
			url : '<?php echo base_url('user/changestatus/'); ?>',
			type : 'POST',
			data : 'id=' + id,
			//dataType : 'json',
			beforeSend : function(jqXHR, settings ){
				//alert(url);
			},
			success : function(data, textStatus, jqXHR){
				$('#cng_status'+id).removeClass('activebutton').removeClass('inactivebutton').addClass(data.toLowerCase()+'button');
				$('#cng_status'+id).html(data);
			},
			/*complete : function(jqXHR, textStatus){
				alert(3);
			},*/
			error : function(jqXHR, textStatus, errorThrown){
			}
		});
	}
}

function delete_user(id,editID){
	if(confirm("Are you sure to delete of this Image ?"))
	{
		$.ajax({
			url : '<?php echo base_url('admin/gallery/image_delete/'); ?>',
			type : 'POST',
			data : 'id=' + id,
			//dataType : 'json',
			beforeSend : function(jqXHR, settings ){
				//alert(url);
			},
			success : function(data, textStatus, jqXHR){
				//alert(data);
				
				$('#tr'+id).slideUp("slow", function() { $('#tr'+id).remove();});
				$("#user_delete").show();
			},
			/*complete : function(jqXHR, textStatus){
				alert(3);
			},*/
			error : function(jqXHR, textStatus, errorThrown){
			}
		});
	}
}


</script>

<?php $this->load->view('include/footer.php');?>
