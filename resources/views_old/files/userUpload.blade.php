@extends('app')

@section('page_title')
Files Uploaded
@endsection

@section('head_section')
{!! Html::style('plugins/datatables/datatables.min.css')  !!}
{!! Html::style('plugins/datatables/dataTables.bootstrap.min.css')  !!}
{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')  !!}
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">File/Document Upload</div>

				<div class="panel-body">
				
				
<div>
	

	{!! Form::open(array('url'=>'fileUpload/store','method'=>'POST', 'files'=>true)) !!}
	
	<?php

	echo Form::token();
	?>
	<div class="form-group">
    <label for="file">Choose a file to upload </label>
    <input type="file" required class="form-control" name="file" id="file">
  	</div>

  	<div class="form-group">
    <label for="description">Write a description about the file</label>
    <textarea  required  name="description" id="" class="form-control"   rows="2"></textarea>
    </div>

    <div style="text-align:right">
    	<input type="submit"  class="btn btn-primary" >
    </div>

	
	{!! Form::close() !!}



</div>
<hr>
<hr>

<?php
if(!empty(Input::file('file')))
{
	print_r(Input::file('file'));
}
?>



<!-- Panel Table Tools -->
      <div class="panel">
     
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="Farmers_table">
            <thead>
              <tr>
                
                <th>#</th>
                <th>File Name</th>
                <th>Description</th>
                <th>DD/MM/YYYY | Time</th>
              
           
               
               
              </tr>
            </thead>
      
            <tbody>
            <?php
            $i=0;
            ?> 
			@foreach($files as $file)
              <tr>
                
                <td>{{++$i}}</td>
                <td><a  href="{{ URL::to('/fileDownload')}}/download/{{$file->name}}">
                <?php
                
                $file_name_parts=explode("_-_",$file->name);
                echo $file_name_parts[0];
                


                ?>
                </a></td>
                <td>{{$file->description}}</td>
                <td>
                <?php

                $originalDate = $file->created_at;
                echo $newDate = date("d/m/Y | h:i:s A", strtotime($originalDate));

                
                ?>

                <a onclick ='return confirm("Are you sure?");' href="{{ URL::to('/fileUpload')}}/delete/{{$file->id}}/{{base64_encode(Request::url())}}"><span style="background:#ddd; float:right; padding:0px 5px; border:0px solid #000; color:red; font-weight:bold;">X</span></a>
                </td>
                
              </tr>

            @endforeach
        
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Panel Table Tools -->





				</div>
			</div>
		</div>
	</div>
</div>

@endsection


@section('body_end_section')

{!!  Html::script('plugins/datatables/jquery.dataTables.js')  !!}
{!!  Html::script('plugins/datatables/buttons.colVis.min.js') !!}

<script>
      $(document).ready(function() {

      var table = $('#Farmers_table').DataTable({
    

        "paging":true,
        
          "info":true,
          "pagingType": "full_numbers",
          "scrollX": true,
           colReorder: true,
      select: true,
      
      dom: 'Bfrtip',
    
     
      buttons: [
      
            
          
          'colvis',
        {
          extend: 'print',
                  exportOptions: {
                      columns: ':visible'
                  }
         },
         {
          extend: 'copy',
                  exportOptions: {
                      columns: ':visible'
                  }
         },
      {
          extend: 'pdf',
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                  exportOptions: {
                      columns: ':visible'
                  }
         },
         {
          extend: 'excel',
                  exportOptions: {
                      columns: ':visible'
                  }
         },
         {
          extend: 'csv',
                  exportOptions: {
                      columns: ':visible'
                  }
         },



          ],
          columnDefs: [ {
              targets: -1,
              // chnage it if some colums are hidden
              visible: true
          } ]

    

      });

	table.on( 'order.dt search.dt', function () {
        // table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        //     cell.innerHTML = i+1;
        // } );
        //  table.rows().invalidate('dom');

         //var iColumns = table.fnSettings().aoColumns.length;
        //alert(iColumns);
    } ).draw();




  } );
 </script>
@endsection