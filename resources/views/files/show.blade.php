@extends('app')
    <?php

          $monthNum  = $month;
          $dateObj   = DateTime::createFromFormat('!m', $monthNum);
          $monthName = $dateObj->format('F'); 
          
        ?>
@section('page_title')
User Document and Amount Received [ {{$monthName}}-{{$year}} ]
@endsection

@section('head_section')
{!! Html::style('plugins/datatables/datatables.min.css')  !!}

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
      margin-top:-5px;
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
      margin-top: -0px;
    }


    table
    {
      font-size: 10px;
      font-weight: 400;
    }



</style>


@endsection

@section('content')
  <div class="page-options">
                <!-- <div colspan="2"><a href="{{ URL::route('users.create') }}" class="btn btn-primary btn-block">Create</a></div> -->
                <div width="80"><a id="edit_button" style="display:none;" class="btn btn-primary" href="#">Edit</a></div>
                <div width="80">
                <a   id="delete_button_form" style="display:none; float:right;color:#fff; font-weight:bold;" class="btn btn-danger"   >delete</a>

                </div>

    </div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" >
        User Document and Cash received <b> [ {{$monthName}} ] </b>
        <div id="month_scroller">
        <!-- Month name with next and prev button -->
    

        <select name="month" id="month" class="form-control" style="margin-top:-7px;">
        @for($i=1;$i<=12;$i++)
         
          <option value="{{ url('/fileDownload/show') }}/{{$i}}/{{$year}}" @if($i==(int)$month) selected @endif >{{$i}}/{{$year}}</option>
       
        @endfor
        </select>

     <!--    <div id="prev_button" >
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
         -->
        </div> 
        <!-- month scrooler ends above -->


        </div>

        </div>



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
      <div class="panel" style="width:100%; margin-top:-20px; border-radius:0px; overflow:hidden; ">
     
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="Farmers_table">
            <thead>
              <tr>
                
                <th>#</th>
                <th>User</th>
                @for($i=1; $i<=$days_in_the_month; $i++)
                <th>{{$i}}</th>
                @endfor
                <th>Total Uploads</th>
                <th>Amount<br> received</th>
              
           
               
               
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
                <a target="_blank" href="{{ URL::to('/fileUpload')}}/viewSummary/{{$user_upload->user_details->id}}" data-toggle="tooltip" data-placement="bottom" title="View summary ">{{$user_upload->user_details->name}}</a>

            </td>

            
             @for($i=1; $i<=$days_in_the_month; $i++)
                

                <td style="padding:0px; vertical-align:top;">
                 @foreach($user_upload->file_uploaded as $file_upload)
                

                <?php
                

                $temp_date=strtotime( $file_upload->created_at);
                $formatted_date=date('Y-m-d',$temp_date);
                // echo $formatted_date,"<br>";
                $start_date;
                $date_part=explode(' ',$start_date);

                $new_date=new DateTime($formatted_date);
                $readable_date=$new_date->format('d-m-Y');

                // $readable_day=$new_date->format('l');
                 // echo "|<br><br>";
                 // echo "<div style='background:#000; color:#fff;'>$formatted_date</div>"
                 // $string_date=$start_date->toDateTimeString();
                 // echo $string_date->toDateTimeString();
                ?>

                


                @if($date_part[0]==(string)$formatted_date)
                  <?php
                    $file_name=explode('_-_',$file_upload->name);
                  ?>
                <div style="display:inline; margin-top: 0px; float:left; width:50px; background:#FFD700; color:#222; margin-bottom:82px; padding:2px 3px; text-decoration:none; margin-bottom:5px; box-shadow:0px 1px 1px #888;" >
                
                @if($user_role=="admin")
                <input type="radio"  style="float:left; margin-top:0px; margin-right:3px;"  class="selected_radio" name="selected_radio" value="{{$file_upload->id}}" data-radio-type="File"/>
                @endif
                <a  style="text-decoration:none; color:#444; font-weight:bold; " href="{{ URL::to('/fileDownload')}}/download/{{$file_upload->name}}" data-toggle="tooltip" data-placement="bottom" title="{{$file_name[0]}} on Date {{$readable_date}}] [{{$file_upload->description}}]">

                <span >

                {{$file_upload->abbreviation}}
               
                </span>
                </a>
                @else
                {{--$date_part[0]--}}
            
                @endif
             </div>
                 
              
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

                // $readable_day=$new_date->format('l');
                ?>
                <div style="background:#90EE90; width: 70px; vertical-align:top; color:#333; font-weight:bold; padding:2px 5px; box-shadow:0px 1px 2px #555;" >
                
                @if($user_role=="admin")
                <input type="radio" style="float:left; margin-top:0px; margin-right:3px;" class="selected_radio" name="selected_radio" value="{{$user_amount_received->id}}" data-radio-type="Amount"/>
                @endif
                <a  data-toggle="tooltip" style="vertical-align:top; display:inline; text-decoration:none; color:#222;" data-placement="bottom" title="Received {{$user_amount_received->amount}} on Date {{$readable_date}} ">
                <span >
                {{$user_amount_received->amount}}
                </span>
                </a>
                
                @else
                {{--$date_part[0]--}}
             
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
            
            dom: 'Blfrtip',
            "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 
           	@for($i=1; $i<=$days_in_the_month; $i++)
                {{$i+1}},
                @endfor 
            ] } ],  
     
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

$("div.DTFC_LeftHeadWrapper").css('margin-bottom',-1);
$("div.DTFC_RightHeadWrapper").css('margin-bottom',-1);
$("table td").css('border','1px solid #eee');
$(".DTFC_Cloned thead").css('background','#fff');



$("#month").change(function()
{

var href=$(this).val();
window.location.assign(href);
});


  $(".selected_radio").click(function(){

      var selected_id=$(this).val();
      var selected_radio_type=$(this).attr('data-radio-type');

      if(selected_radio_type=='File')
      {
      var href="{{ URL::to('/fileUpload')}}/delete/"+selected_id+"/{{base64_encode(Request::url())}}";
      // $("#edit_button").css("display","block").attr('href','{{URL::to("users")}}/'+selected_id+'/edit');
      $("#delete_button_form").css("display","block").attr('action',href); 
      
      $("#delete_button_form").click(function(e){
        e.preventDefault();
        var is_confirm=confirm("Are you sure?");
        if(is_confirm==true)
        {
          window.location.href = href;
          // $("#delete_button_form").click();
           // $(this).unbind('#delete_button_form').click();
        }

        });
       }
      else if(selected_radio_type=='Amount')
      {
  

      var href="{{ URL::to('/userAmountDelete')}}/"+selected_id+"/{{base64_encode(Request::url())}}";
      // $("#edit_button").css("display","block").attr('href','{{URL::to("users")}}/'+selected_id+'/edit');
      $("#delete_button_form").css("display","block").attr('action',href); 
      
      $("#delete_button_form").click(function(e){
        e.preventDefault();
        var is_confirm=confirm("Are you sure?");
        if(is_confirm==true)
        {
          window.location.href = href;
          // $("#delete_button_form").click();
           // $(this).unbind('#delete_button_form').click();
        }

      });


       }





    });

// amount redio button functionality

  // $(".selected_amount_radio").click(function(){

  //     var selected_id=$(this).val();


  //     var href="{{ URL::to('/userAmountDelete')}}/"+selected_id+"/{{base64_encode(Request::url())}}";
  //     // $("#edit_button").css("display","block").attr('href','{{URL::to("users")}}/'+selected_id+'/edit');
  //     $("#delete_button_form").css("display","block").attr('action',href); 
      
  //     $("#delete_button_form").click(function(e){
  //       e.preventDefault();
  //       var is_confirm=confirm("Are you sure?");
  //       if(is_confirm==true)
  //       {
  //         window.location.href = href;
  //         // $("#delete_button_form").click();
  //          // $(this).unbind('#delete_button_form').click();
  //       }

  //     });
     
  //   });



  });

</script>

@endsection