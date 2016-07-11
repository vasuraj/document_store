@extends('app')

@section('page_title')
Amount received 
@endsection

@section('head_section')
{!! Html::style('plugins/datatables/datatables.min.css')  !!}

{!! Html::style('plugins/pickaday/pikaday.css')  !!}
{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')  !!}


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
				<div class="panel-heading">Amount Received</div>

				<div class="panel-body">
				
				
<div>
	

	{!! Form::open(array('url'=>'userAmountReceived/store','method'=>'POST', 'files'=>true)) !!}
	
	<?php

	echo Form::token();
	?>
	  <div class="form-group" style="width:49%; display:inline-block;">
    <label for="amount_received">Enter the Amount You received </label>
    <input type="number" required class="form-control" min="0"  name="amount_received" id="amount_received">
  	</div>
    

    <div class="form-group" style="width:50%;display:inline-block;">
    <label for="amount_received_on_date">Received On Date</label>
    <input type="text" required class="form-control" name="amount_received_on_date" id="amount_received_on_date">
    
    </div>

  	<div class="form-group">
    <label for="description">Remark</label>
    <textarea  required  name="remark" id="remark" class="form-control"   rows="2"></textarea>
    </div>

    <div style="text-align:right">
    	<input type="submit"  class="btn btn-primary" >
    </div>

	
	{!! Form::close() !!}



</div>
<hr>
<hr>

<!-- Panel Table Tools -->
      <div class="panel">
     
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="Farmers_table">
            <thead>
              <tr>
                
                <th>#</th>
                <th>Amount received</th>
                <th>Remark</th>
                <th>DD/MM/YYYY | Time</th>
              
           
               
               
              </tr>
            </thead>
      
            <tbody>
            <?php
            $i=0;
            ?> 
			@foreach($user_amount_received as $amountReceived)
              <tr>
                
                <td>{{++$i}}</td>
                <td>{{$amountReceived->amount}}</td>
                <td>{{$amountReceived->remark}}</td>
                <td>
                <?php

                $originalDate = $amountReceived->amount_received_on;
                echo $newDate = date("d/m/Y | h:i:s A", strtotime($originalDate));

                
                ?>

                <!-- <a onclick ='return confirm("Are you sure?");' href="{{ URL::to('/userAmountDelete')}}/{{$amountReceived->id}}/{{base64_encode(Request::url())}}"><span style="float:right;color:#fff; font-weight:bold;" class="btn btn-danger" >X</span></a> -->
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
{!!  Html::script('plugins/moment/moment.min.js')  !!}
{!!  Html::script('plugins/pickaday/pikaday.js')  !!}
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

	table.on( 'order.dt search.dt', function () {
        // table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        //     cell.innerHTML = i+1;
        // } );
        //  table.rows().invalidate('dom');

         //var iColumns = table.fnSettings().aoColumns.length;
        //alert(iColumns);
    } ).draw();

    var picker = new Pikaday(
      { 
        field: document.getElementById('amount_received_on_date')
       
      }
    );


  } );
 </script>
@endsection