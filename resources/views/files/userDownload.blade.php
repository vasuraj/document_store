@extends('app')

@section('page_title')
Files Download
@endsection

@section('head_section')
{!! Html::style('plugins/datatables/datatables.min.css')  !!}

{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')  !!}

{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')  !!}

<style customestyle>

  body
  {
    overflow: hidden;
  }
    
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



</style>

@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">File/Document Download</div>

				<div class="panel-body">

  <?php
  // if(!empty(Input::file('file')))
  // {
  // 	print_r(Input::file('file'));
  // }
  ?>



<!-- Panel Table Tools -->
      <div class="panel">
     
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="Farmers_table">
            <thead>
              <tr>
                
                <th>#</th>
                <th>Code</th>
                <th>File Name</th>
                <th>Description</th>
                <th>Deadline</th>
               
              
           
               
               
              </tr>
            </thead>
      
            <tbody>
            <?php
            $i=0;
            ?> 
			@foreach($files as $file)
              <tr>
                
                <td>{{++$i}}</td>
                <td>{{$file->abbreviation}}</td>
                <td><a href="{{ URL::to('/fileDownload/download')}}/{{$file->name}}">
                <?php
                
                $file_name_parts=explode("_-_",$file->name);
                echo $file_name_parts[0];
                


                ?>
                </a></td>
                <td>{{$file->description}}</td>

                <?php

                $originalDate = $file->created_at;
                $newDate = date("d/m/Y | h:i:s A", strtotime($originalDate));
               
                ?>

                <td><a data-toggle="tooltip" href="#" data-placement="left" title="Uploaded by admin on : {{$newDate}}">
                <?php

                $originalDate = $file->deadline;
                echo $newDate = date("d/m/Y | h:i:s A", strtotime($originalDate));

                
                ?>
                </a>
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
      
      // dom: 'Bfrtip',
    
     
      // buttons: [
      
            
          
      //     // 'colvis',
      //   {
      //     extend: 'print',
      //             exportOptions: {
      //                 columns: ':visible'
      //             }
      //    },
      //    {
      //     extend: 'copy',
      //             exportOptions: {
      //                 columns: ':visible'
      //             }
      //    },
      // {
      //     extend: 'pdf',
      //           extend: 'pdfHtml5',
      //           orientation: 'landscape',
      //           pageSize: 'LEGAL',
      //             exportOptions: {
      //                 columns: ':visible'
      //             }
      //    },
      //    {
      //     extend: 'excel',
      //             exportOptions: {
      //                 columns: ':visible'
      //             }
      //    },
      //    {
      //     extend: 'csv',
      //             exportOptions: {
      //                 columns: ':visible'
      //             }
      //    },



      //     ],
          // columnDefs: [ {
          //     targets: -1,
          //     // chnage it if some colums are hidden
          //     visible: true
          // } ]

    

      });

	// table.on( 'order.dt search.dt', function () {
 //        // table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
 //        //     cell.innerHTML = i+1;
 //        // } );
 //        //  table.rows().invalidate('dom');

 //         //var iColumns = table.fnSettings().aoColumns.length;
 //        //alert(iColumns);
 //    } ).draw();




  } );
 </script>
@endsection