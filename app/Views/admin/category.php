<?php
	$table = '';
	$catParentOption = '';
	if($category != []){
		foreach($category as $item){
			$parent = "No";
			if(!empty($item["parent"])){
				$parent = $item["parentname"];
			}
			$table .= '<tr>
					<td>'.$item["id"].'</td>
					<td>'.$item["name"].'</td>
					<td>'.$parent.'</td>
					<td>'.$item["created_at"].'</td>
				</tr>';
			$catParentOption .= '<option value="'.$item["id"].'">'.$item["name"].'</option>';
		}		
	}
?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
		<div class="p-4">
			<div class="d-flex justify-content-end mb-2" id="categorBtnDiv">
				<button type="button" class="btn btn-success" id="addCategory"><i class="fa fa-edit f-left"></i>&nbsp;Add</button>
			</div>
			<div class="row mb-4 d-none" id="addCategoryDiv">
				<div class="col-sm-4 form-group">
					<label for="categorName">Name</label>
					<input id="categorName" type="text" class="form-control" name="categorName" value=""/>
				</div>
				<div class="col-sm-4 form-group">
					<label for="">Parent</label>
					<select id="categorParent" name="categorParent" class="form-control">
						<option value="">Select parent</option>
						<?php echo $catParentOption; ?>
					</select>
				</div>
				<div class="col-sm-2 form-group">
					<label for="createCategory" class="p-2"></label>
					<input type="button" class="btn btn-success mt-4" id="createCategory" value="Add"/>
				</div>
				<div class="col-sm-2 form-group">
					<label for="closeAddCategory" class="p-2"></label>
					<input type="button" class="btn btn-secondary mt-4" id="closeAddCategory" value="Close"/>
				</div>
			</div>
			<table id="categoryList">
				<thead>
					<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Parent</th>
					<th>Last Modified</th>
					</tr>
				<thead>
				<tbody>
					<?php echo $table;?>
				</tbody>
				<tfoot>
					<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Parent</th>
					<th>Last Modified</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="modal fade modal-child" id="statusModalLong" style="background-color: rgba(211, 211, 211, 0.57);" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="statusModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" style="justify-content: center;" role="document">
				<center>
					<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
					  <span class="sr-only">Loading...</span>
					</div>
				</center>
			</div>
		</div>
		<div class="modal fade modal-child" id="messageModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="messageModalLongTitle" aria-hidden="true" data-modal-parent="#statusModalLong">
			<div class="modal-dialog modal-dialog-centered"  role="document">
				<div class="modal-content">
					<div id="msgStsCnt" class="alert" role="alert">
					  <h4 id="msgHeading" class="alert-heading">Well done!</h4>
					  <p id="msgPara"></p>
					</div>
				</div>
			</div>
		</div>
<script type="text/javascript">
    $(document).ready(function() {
        let catTable = $('#categoryList').DataTable({
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'Category',
                    filename: 'Jewellary Category',
                    
                }, 
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    text: 'Export to PDF',
                    title: 'Jewellary Category',
                    filename: 'Jewellary Category',
                    
                }, 
				{
                    extend: 'print',
                    title: 'Jewellary Category', // Custom title for print view
                    
                },'colvis'
            ]
        });
		catTable.columns.adjust().draw();
		
		$('#addCategory').on('click',function(){
			$('#addCategoryDiv').removeClass("d-none");
			$('#categorBtnDiv').removeClass("d-flex").addClass('d-none');
			innitAddCatDiv();
		});
		$('#closeAddCategory').on('click',function(){
			$('#addCategoryDiv').addClass("d-none");
			$('#categorBtnDiv').removeClass("d-none").addClass('d-flex');
			innitAddCatDiv();
		});
		$('#createCategory').on('click',function(){
			let name = $('#categorName').val();
			let parent = $('#categorParent').val();
			if(name != ""){
				let formdata = {name:name,parent:parent};
				$.ajax({
					url: '<?php echo base_url().'admin/api/addCategory'?>', 
					method: 'POST',
					dataType: 'json',
					data: JSON.stringify(formdata),
					beforeSend: function(xhr) {
						$('#statusModalLong').modal('show');
					},
					success: function(response) {
						if(response.status){
							$('#msgStsCnt').removeClass('alert-danger').addClass('alert-success');
							$('#msgHeading').html('Success !');
							$('#msgPara').html(response.message);
							let newData = [];
							let parentOptions = '<option value="">Select parent</option>';
							response.categories.forEach((row) => {
								let parent = (row.parent) ? row.parentname : "No";
								newData.push([(row.id).toString(),row.name,parent,(row.created_at).toString()]);
								parentOptions += '<option value="'+row.id+'">'+row.name+'</option>';
							});
							catTable.clear().draw();
							catTable.rows.add(newData).draw();
							$('#messageModal').modal('show');
							$('#categorParent').html(parentOptions);
							innitAddCatDiv();
						}else{
							$('#msgStsCnt').removeClass('alert-success').addClass('alert-danger');
                            $('#msgHeading').html('Failure !');
                            $('#msgPara').html(response.message);
						}
						setTimeout(function() {
                            $('#messageModal').modal('hide');
                        }, 3000);
					},
					error: function(xhr, status, error) {
						console.log(error);
						$('#msgStsCnt').removeClass('alert-success').addClass('alert-danger');
                        $('#msgHeading').html('Failure !');
                        $('#msgPara').html("something went wrong.");
                        setTimeout(function() {
                            $('#messageModal').modal('hide');
                        }, 3000);
					},
					complete: function() {
						setTimeout(function() {
							$('#statusModalLong').modal('hide');
						}, 2000); 
					},				
					
				});
			}else{
				alert("Please enter category name");
			}
		});
		function innitAddCatDiv(){
			$('#categorName').val("");
			$('#categorParent').val("");
		}
    } );
</script>