@extends('app')

@section('page_title')
Audit Report
@endsection

@section('head_section')
{!! Html::style('plugins/datatables/datatables.min.css')  !!}

{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')  !!}
{!! Html::style('plugins/pickaday/pikaday.css')  !!}

<style customestyle>

   .custom
    {
      background: red;
    }


    .dt-buttons
    {
      font-size: 10px;
      width:350px;

      position: absolute;
      display: inline;
      margin-top:-20px;
      font-weight: bold;
    
    
    }

    .dataTables_filter
    {
      display: inline;
      width:200px;
      float:right;
      margin-top: -10px;
      margin-right: 40px;

    }

     .dataTables_filter label
    {
      display: inline;
      width:100px;
      
    }

     .dataTables_filter input
    {
      display: inline;
          width:120px;
          margin-right: -33px;
          margin-top: 2px;

      
    }

    .dataTables_length
    {
      margin-top: -20px;
    }


    table
    {
      font-size: 10px;
      font-weight: 400;
    }

    table .btn
    {
        font-size: 8px;
      padding: 2px 4px;
    
    }

    #table_row_counter
    {
      max-width: 10px;
    }



</style>

@endsection

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Audit Report</div>

				<div class="panel-body">
				
				
<div>
	

	{!! Form::open(array('url'=>'AuditReportUpload/store','method'=>'POST', 'files'=>true)) !!}
	
	<?php

	echo Form::token();
	?>
	  <div class="form-group col-md-3" >
    <label for="file">Choose a file to upload </label>
    <input type="file" required class="form-control" name="file" id="file">
    </div>
    
  

    <div class="form-group  col-md-3" >
    <label for="from_date">From Date</label>
    <input type="text" required class="form-control" name="from_date" id="from_date">
    </div>

 
    <div class="form-group  col-md-3" >
    <label for="to_date">To Date</label>
    <input type="text" required class="form-control" name="to_date" id="to_date">
    </div>



  	<div class="form-group col-md-3">
    <label for="description">Description</label>
    <textarea  required  name="description" id="" class="form-control"  style="height:35px;"></textarea>
    </div>


    <div class="form-group" style="text-align:right;">
    	<input type="submit"  id="submit_form" class="btn btn-primary" >
    </div>

	
	{!! Form::close() !!}



</div>


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
          <table class="table table-hover dataTable table-striped width-full" id="Files_table">
            <thead>
              <tr>
                
                <th>#</th>
              
                <th>File Name</th>
                <th>Description</th>
                <th>From Date</th>
                <th>To Date</th>
                
              
           
               
               
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
                $originalDate = $file->from_date;
                echo $newDate = date("d/m/Y", strtotime($originalDate));              
                ?>
                </td>
                <td>
                <?php
                $originalDate = $file->to_date;
                // echo $newDate = date("d/m/Y | h:i:s A", strtotime($originalDate));              
                echo $newDate = date("d/m/Y", strtotime($originalDate));              

                ?>
                </td>
                
                



                <!-- <a  onclick ='return confirm("Are you sure?");' href="{{ URL::to('/fileUpload')}}/delete/{{$file->id}}/{{base64_encode(Request::url())}}" ><span style="float:right;color:#fff; font-weight:bold;" class="btn btn-danger"  >X</span></a> -->
                
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
{!!  Html::script('plugins/moment/moment.min.js')  !!}
{!!  Html::script('plugins/pickaday/pikaday.js')  !!}

<script>
      $(document).ready(function() {

        // check for the file code if it is already uploaded

        // $('#submit_form').click(function(e)
        //   {
        //       e.preventDefault();
        //       var fileCode=$('#abbreviation').val();
        //       if(fileCode==='none')
        //       {
        //         $('#modal_msg_title').text('File Code Error');
        //         $('#modal_msg').text('Please select a valid file code from the list');
        //         $('#myModal').modal('show');

        //       }
        //       else
        //       {
        //         $(this).unbind('submit').submit();
        //       }

        //   });



      var table = $('#Files_table').DataTable({
    

        "paging":true,
        
          "info":true,
          "pagingType": "full_numbers",
          "scrollX": true,
           colReorder: true,
      select: true,
      
      dom: 'Bfrtip',
    
     
      buttons: [
      
            
          
          // 'colvis',
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


// pick a day

   var picker_from = new Pikaday(
      { 
        field: document.getElementById('from_date'),
        onSelect: function() {
        picker_to.setMinDate(this.getDate());
        }
      });

       var picker_to = new Pikaday(
      { 
        field: document.getElementById('to_date'),
        onSelect: function() {
        picker_from.setMaxDate(this.getDate());
        }
      });



  } );
 </script>
@endsection