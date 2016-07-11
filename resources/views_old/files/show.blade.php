@extends('app')

@section('page_title')
User Document and Amount Received
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
				<div class="panel-heading" >
        User Document and Cash received
        <div id="month_scroller">
        <!-- Month name with next and prev button -->
        <?php

          $monthNum  = $month;
          $dateObj   = DateTime::createFromFormat('!m', $monthNum);
          $monthName = $dateObj->format('F'); 
          
        ?>
        <div id="prev_button" >
        @if($month==1)
        <a  class="btn btn-primary" href="{{ url('/fileDownload/show') }}/12/{{$year-1}}"> Prev</a>
        @else
        <a class="btn btn-primary" href="{{ url('/fileDownload/show') }}/{{$month-1}}/{{$year}}"><</a>
        @endif
        </div>

        <div id="month_name">{{$monthName}}</div>
        
        <div id="next_button">
        @if($month==12)
        <a class="btn btn-primary" href="{{ url('/fileDownload/show') }}/01/{{$year+1}}"> Prev</a>
        @else
        <a class="btn btn-primary" href="{{ url('/fileDownload/show') }}/{{$month+1}}/{{$year}}">></a>
        @endif
        </div>
        
        </div> 
        <!-- month scrooler ends above -->


        </div>

        </div>

				<div class="panel-body">

  <?php

  // foreach($users_upload as $user_upload)
  // {
  //   print_r($user_upload);
  //   echo "<br><br><br><br>";
  // }

  $number_of_files_received=0;
  $total_amount_received=0;

  ?>



<!-- Panel Table Tools -->
      <div class="panel">
     
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="Farmers_table">
            <thead>
              <tr>
                
                <th>#</th>
                <th>User</th>
                @for($i=1; $i<=$days_in_the_month; $i++)
                <th>{{$i}}</th>
                @endfor
                <th>Total Uploads<br> in the month</th>
                <th>Total Amount<br> received</th>
              
           
               
               
              </tr>
            </thead>
      
            <tbody>
          <?php

          // setting a counter varibale here for number of user
          $user_counter=0;

          ?>
            
          @foreach($users_upload as $user_upload)
          <!-- each user's file upload information  -->
          <?php

            $total_amount_per_user=0;
          ?>

          <tr>

            <td>
                {{++$user_counter}}
            </td>
            <!-- User Name should appear here -->
            <td style="min-width:100px;">
                {{$user_upload->user_details->name}}
            </td>

            
             @for($i=1; $i<=$days_in_the_month; $i++)
                

                <td>
                 @foreach($user_upload->file_uploaded as $file_upload)
                

                <?php
                

                $temp_date=strtotime( $file_upload->created_at);
                $formatted_date=date('Y-m-d',$temp_date);
                // echo $formatted_date,"<br>";
                $start_date;
                $date_part=explode(' ',$start_date);

                $new_date=new DateTime($formatted_date);
                $readable_date=$new_date->format('d-m-Y');

                $readable_day=$new_date->format('l');
                 // echo "|<br><br>";
                 // echo "<div style='background:#000; color:#fff;'>$formatted_date</div>"
                 // $string_date=$start_date->toDateTimeString();
                 // echo $string_date->toDateTimeString();
                ?>

                


                @if($date_part[0]==(string)$formatted_date)
                  <?php
                    $file_name=explode('_-_',$file_upload->name);
                  ?>
                 
                <a  href="{{ URL::to('/fileDownload')}}/download/{{$file_upload->name}}" data-toggle="tooltip" data-placement="right" title="{{$file_name[0]}} on Date {{$readable_date}} [{{$readable_day}}] [{{$file_upload->description}}]"><span style="background:red; color:red; padding:0px 7px; margin-bottom:5px; box-shadow:0px 1px 1px #333; display:inline;">.</span></a>

                @else
                {{--$date_part[0]--}}
                
                <br>
                

                @endif
            
                 
              
              @endforeach
              
              <!-- for amount received -->


                @foreach($user_upload->amount_received as $user_amount_received)
                

                <?php
                

                $temp_date=strtotime( $user_amount_received->amount_received_on);
                $formatted_date=date('Y-m-d',$temp_date);
                // echo $formatted_date,"<br>";
                $start_date;
                $date_part=explode(' ',$start_date);

                 // echo "|<br><br>";
                 // echo "<div style='background:#000; color:#fff;'>$formatted_date</div>"
                 // $string_date=$start_date->toDateTimeString();
                 // echo $string_date->toDateTimeString();
                ?>

                


                @if($date_part[0]==(string)$formatted_date)
                <?php
                $total_amount_per_user+=$user_amount_received->amount;
                $new_date=new DateTime($formatted_date);
                $readable_date=$new_date->format('d-m-Y');

                $readable_day=$new_date->format('l');
                ?>
                <a  data-toggle="tooltip" data-placement="right" title="{{$user_amount_received->amount}} on Date {{$readable_date}} [{{$readable_day}}]"><span style="background:yellow; color:#333; padding:2px 5px; box-shadow:0px 1px 2px #555; display:inline-block;">{{$user_amount_received->amount}}</span></a>
               
                @else
                {{--$date_part[0]--}}
                
                <br>
                

                @endif
            
                 
              
              @endforeach

              <!-- amount received code ends here -->




              <!-- add a day each time -->
                  <?php
                    $start_date->addDays(1);
                  ?>  
                    
                </td>
             @endfor
              <?php
                 $start_date=\Carbon\Carbon::create($year,$month,01,0);
              ?>
            
             <td>{{count($user_upload->file_uploaded)}}
             <?php

             $number_of_files_received+=count($user_upload->file_uploaded);
             ?></td>
             

<!-- amount received per user-->

              <td>{{$total_amount_per_user}}
             <?php

             $total_amount_received+=$total_amount_per_user;
             ?></td>
             


           
          </tr>
          <!-- each user's file upload  info ends here-->
          @endforeach
     
            </tbody>
          </table>
        </div>

          
          <td>Total Number of Files Received : <b>{{$number_of_files_received}}</b></td>
          <td>Total Amount Received: <b>{{$total_amount_received}}</b></td>
           
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
              // visible: true
          } ],


          scrollY:true,
          // scrollY:        "250px",
          scrollX:        true,
         "sScrollXInner": "150%",
          fixedColumns:   {
              leftColumns: 2,
              rightColumns: 2
          },
            

    
      });

	table.on( 'order.dt search.dt', function () {
  
    } ).draw();

$("div.DTFC_LeftHeadWrapper").css('margin-bottom',-10);
$("div.DTFC_RightHeadWrapper").css('margin-bottom',-10);
$("table td").css('border','1px solid #eee');


  } );
 </script>
@endsection