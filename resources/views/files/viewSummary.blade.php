@extends('app')

@section('page_title')
User Document Upload summary 
<?php
if(isset($user_name))
{ 
  echo "$user_name - $user_email - date('d-m-Y')";
}


?>

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

  <div class="page-options">
                <!-- <div colspan="2"><a href="{{ URL::route('users.create') }}" class="btn btn-primary btn-block">Create</a></div> -->
                <div width="80"><a id="edit_button" style="display:none;" class="btn btn-primary" href="#">Edit</a></div>
                <div width="80">
                <a   id="delete_button_form" style="display:none; float:right;color:#fff; font-weight:bold;" class="btn btn-danger"   >delete</a>

                </div>

    </div>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" >
        User summary 

        </div>

  <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a data-target="#file_upload" data-toggle="tab">File Upload</a></li>
        <li><a data-target="#budget" data-toggle="tab">Budget</a></li>
        <li><a data-target="#UC" data-toggle="tab">Utilization Certificates</a></li>
        <li><a data-target="#user_audit_report" data-toggle="tab">Audit report</a></li>
    
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="file_upload">



<!-- start usre's file upload summary -->
        <div class="panel-body">




        <?php

        $number_of_files_received=0;
        $total_amount_received=0;
        $total_upload_counter=0;
        ?>


      <div class="panel">
     
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="Files_table">
            <thead>
              <tr>
                
                <th style="width:30px;">#</th>
                <th style="max-width:100px;">Month</th>
                <th style="max-width:200px;">Files</th>
                <th style="max-width:30px;">Total Uploads</th>
                         
               
               
              </tr>
            </thead>
      
           <tbody>
          <?php

          // setting a counter varibale here for number of user
          $counter=0;

          ?>
        @if(isset($user_summary))
        @foreach($user_summary as $user_uploads)
        @if(!empty($user_uploads['files_uploaded']))
        <tr>
        <th>{{++$counter}}</th>
        <th>{{$user_uploads['month']}}</th>
        <th>
        @foreach($user_uploads['files_uploaded'] as $file_upload)
          <?php
                $temp_date=strtotime( $file_upload->created_at);
                $formatted_date=date('Y-m-d',$temp_date);
               
             
                $new_date=new DateTime($formatted_date);
                $readable_date=$new_date->format('d-m-Y');

                $readable_day=$new_date->format('l');
                $file_name=explode('_-_',$file_upload->name);

          ?>
        <a style="text-decoration:none;" href="{{ URL::to('/fileDownload')}}/download/{{$file_upload->name}}" data-toggle="tooltip" data-placement="bottom" title="{{$file_name[0]}} on Date {{$readable_date}} [{{$file_upload->description}}]"><span style="background:#FFD700;  color:#222; border:2px solid #DAA520; text-decoration:none; border-radius:100px; padding:0px 7px; margin-bottom:5px; box-shadow:0px 1px 1px #333; display:inline;">{{$file_upload->abbreviation}}</span></a>

        @endforeach

        </th>
        <th>
          <?php
          $total_upload_counter+=count($user_uploads['files_uploaded']);
          ?>
        {{count($user_uploads['files_uploaded'])}}

        </th>
        </tr>
        @endif
        @endforeach
        @endif   
         
  <!-- first loop ends with above line -->
            </tbody>


          </table>
          </div>

          
          <td>Total Number of Files Received : <b>{{$total_upload_counter}}</b></td>

           
      </div>
      </div>
      <!-- End user file upload sumary -->



      
      </div>
<!-- file upload tab ends with above div syntax -->


  <!-- budget summary tab start from here -->
  <div class="tab-pane" id="budget">
          



<!-- start usre's file upload summary -->
        <div class="panel-body">




        <?php

        $number_of_files_received=0;
        $total_amount_received=0;
        $total_upload_counter=0;
        $total_budget=0;
        
        ?>


      <div class="panel">
     
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="budget_table">
            <thead>
              <tr>
                
                <th style="width:30px;">#</th>
                <th style="max-width:100px;">Month</th>
                <th style="max-width:200px;">Budget</th>
                <th style="max-width:30px;">Monthly Budget</th>
                
                   
               
               
              </tr>
            </thead>
      
           <tbody>
          <?php

          // setting a counter varibale here for number of user
          $counter=0;

          ?>
        @if(isset($user_budget_summary))
        @foreach($user_budget_summary as $user_budgets)

        <?php
        $monthly_budget=0;
        ?>

        @if(!empty($user_budgets['budget']))
        <tr>
        <th>{{++$counter}}</th>
        <th>{{$user_budgets['month']}}</th>
        <th>
        @foreach($user_budgets['budget'] as $budget)
          <?php
                
                $temp_date=strtotime( $budget->created_at);
                $formatted_date=date('Y-m-d',$temp_date);
               
             
                $new_date=new DateTime($formatted_date);
                $readable_date=$new_date->format('d-m-Y');

                $readable_day=$new_date->format('l');
                $budget_amount=$budget->amount;
              $monthly_budget+=$budget_amount;
          ?>
        <a style="text-decoration:none;" href="#" data-toggle="tooltip" data-placement="bottom" title="{{$budget_amount}} on Date {{$readable_date}}  [{{$budget->remark}}]"><span style="background:#FFD700;  color:#222; border:2px solid #DAA520; text-decoration:none; border-radius:100px; padding:0px 7px; margin-bottom:5px; box-shadow:0px 1px 1px #333; display:inline;">{{$budget_amount}}</span></a>

        @endforeach

        </th>
        <th>
        
        {{$monthly_budget}}

        </th>
        </tr>
        @endif
        <?php
        $total_budget+=$monthly_budget;
        ?>
        @endforeach

        
        @endif   
         
  <!-- first loop ends with above line -->
            </tbody>


          </table>
          </div>

          
          <td>Total Budget received : <b>{{$total_budget}}</b></td>

           
      </div>
      </div>
      <!-- End user file upload sumary -->



  </div>

  <!-- budget summary tab ends on above syntax -->


<!-- UC summary tab start from here -->

<div class="tab-pane" id="UC">

  <div class="panel-body">

  @if(!empty($user_uc))
      <div class="panel" >
     
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="uc_table">
            <thead>
              <tr>
                
                <th style="width:50px;">#</th>
                <th style="max-width:100px;">Amount</th>
                <th style="max-width:200px;">Submit Date</th>
                <th style="max-width:30px;">Form date</th>
                <th style="max-width:30px;">To date</th>
                         
               
               
              </tr>
            </thead>
        
           <tbody>
           <?php
           $i=1;
           ?>

            @foreach($user_uc as $uc)
            <tr>
              <td>
              {{$i++}}       
              @if($user_role!='Guest')
              <div style="float:right; margin-top:-3px;">
              <input  type="radio" value="{{$uc->id}}" name="selected_uc_id" data-radio-type="uc" class="selected_radio" >
              </div>
              @endif
              
              </td>
              <td>{{$uc->amount}}</td>
              <td>
              <?php
                $originalDate = $uc->submit_date;
                // echo $newDate = date("d/m/Y | h:i:s A", strtotime($originalDate));
                echo $newDate = date("d/m/Y", strtotime($originalDate));
            
              ?>
              </td>
               <td>
              <?php
                $originalDate = $uc->from_date;
                // echo $newDate = date("d/m/Y | h:i:s A", strtotime($originalDate));
                echo $newDate = date("d/m/Y", strtotime($originalDate));
            
              ?>
              </td>
              <td>
              <?php
                $originalDate = $uc->to_date;
                // echo $newDate = date("d/m/Y | h:i:s A", strtotime($originalDate));
                echo $newDate = date("d/m/Y", strtotime($originalDate));
            
              ?>
              </td>            
              

            </tr>
            @endforeach
          </tbody>


          </table>
          </div>

       </div>

      @endif
     </div>
</div>

<!-- UC summary ends on above syntax -->


<!-- user_audit_report summary tab start from here -->
  <div class="tab-pane" id="user_audit_report">
     
    <div class="panel-body">

@if(!empty($user_audit_report))

       <div class="panel">
     
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="audit_report_table">
            <thead>
              <tr>
                
                <th style="width:30px;">#</th>
                <th style="max-width:100px;">Name</th>
                <th style="max-width:200px;">description</th>
                <th style="max-width:30px;">Form date</th>
                <th style="max-width:30px;">To date</th>
                         
               
               
              </tr>
            </thead>
        
           <tbody>
            <?php
           $i=1;
           ?>
            @foreach($user_audit_report as $audit_report)
            <tr>
              <td>{{$i++}}
              @if($user_role!='Guest')
              <div style="float:right; margin-top:-3px;">
              <input type="radio" value="{{$audit_report->id}}" name="selected_audit_report_id" data-radio-type="audit_report" class="selected_radio">
              </div>
              @endif
              </td>
                
              <td>
              <a  href="{{ URL::to('/fileDownload')}}/download/{{$audit_report->name}}">
                <?php                
                $file_name_parts=explode("_-_",$audit_report->name);
                echo $file_name_parts[0];
                ?>
              </a>
              </td>

               <td>{{$audit_report->description}}</td>
            
               <td>
              <?php
                $originalDate = $audit_report->from_date;
                // echo $newDate = date("d/m/Y | h:i:s A", strtotime($originalDate));
                echo $newDate = date("d/m/Y", strtotime($originalDate));
            
              ?>
              </td>
              <td>
              <?php
                $originalDate = $audit_report->to_date;
                // echo $newDate = date("d/m/Y | h:i:s A", strtotime($originalDate));
                echo $newDate = date("d/m/Y", strtotime($originalDate));
            
              ?>
              </td>            
              

            </tr>
            @endforeach
          </tbody>


          </table>
          </div>

       </div>
@endif
  </div>
</div>

<!-- user_audit_report summary ends on above syntax -->

       
      </div>





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

      var table = $('#Files_table').DataTable({
    
          "paging":true,
        
          "info":true,
          "pagingType": "full_numbers",
           colReorder: true,
            select: true,
            
            dom: 'Bfrtip',
            // "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 
           	// @for($i=1; $i<=31; $i++)
            //     {{$i+1}},
            //     @endfor 
            // ] } ],  
     
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


         //  scrollY:true,
         //  // scrollY:        "250px",
         //  scrollX:        true,
         // "sScrollXInner": "150%",
         //  fixedColumns:   {
         //      leftColumns: 1,
         //      // rightColumns: 2
         //  },
        
                

    
      });


      var table = $('#budget_table').DataTable({
    
          "paging":true,
        
          "info":true,
          "pagingType": "full_numbers",
           colReorder: true,
            select: true,
            
            dom: 'Bfrtip',
            // "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 
            // @for($i=1; $i<=31; $i++)
            //     {{$i+1}},
            //     @endfor 
            // ] } ],  
     
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


         //  scrollY:true,
         //  // scrollY:        "250px",
         //  scrollX:        true,
         // "sScrollXInner": "150%",
         //  fixedColumns:   {
         //      leftColumns: 1,
         //      // rightColumns: 2
         //  },
        
                

    
      });

	var table = $('#uc_table').DataTable({
    
          "paging":true,
        
          "info":true,
          "pagingType": "full_numbers",
           colReorder: true,
            select: true,
            
            dom: 'Bfrtip',
            // "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 
            // @for($i=1; $i<=31; $i++)
            //     {{$i+1}},
            //     @endfor 
            // ] } ],  
     
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


         //  scrollY:true,
         //  // scrollY:        "250px",
         //  scrollX:        true,
         // "sScrollXInner": "150%",
         //  fixedColumns:   {
         //      leftColumns: 1,
         //      // rightColumns: 2
         //  },
        
                

    
      });

var table = $('#audit_report_table').DataTable({
    
          "paging":true,
        
          "info":true,
          "pagingType": "full_numbers",
           colReorder: true,
            select: true,
            
            dom: 'Bfrtip',
            // "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 
            // @for($i=1; $i<=31; $i++)
            //     {{$i+1}},
            //     @endfor 
            // ] } ],  
     
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


         //  scrollY:true,
         //  // scrollY:        "250px",
         //  scrollX:        true,
         // "sScrollXInner": "150%",
         //  fixedColumns:   {
         //      leftColumns: 1,
         //      // rightColumns: 2
         //  },
        
                

    
      });

  

$("div.DTFC_LeftHeadWrapper").css('margin-bottom',-10);
$("div.DTFC_RightHeadWrapper").css('margin-bottom',-10);
$("table td").css('border','1px solid #eee');
$(".DTFC_Cloned thead").css('background','#fff');



  $(".selected_radio").click(function(){

      var selected_id=$(this).val();
      var selected_radio_type=$(this).attr('data-radio-type');

      if(selected_radio_type=='uc')
      {
      var href="{{ URL::to('/UCUpload')}}/delete/"+selected_id+"/{{base64_encode(Request::url())}}";
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
      else if(selected_radio_type=='audit_report')
      {
  

      var href="{{ URL::to('/AuditReportUpload')}}/delete/"+selected_id+"/{{base64_encode(Request::url())}}";
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


// hide delete button on clicking the tab header

$("#myTab li a").click(function(){

$("#delete_button_form").css("display","none"); 
$("input[type=radio]").prop('checked', false);

});


  });
 </script>
@endsection