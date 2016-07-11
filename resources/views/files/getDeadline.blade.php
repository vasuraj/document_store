@extends('minimal')

@section('page_title')
User Document Upload status {{date('d-m-Y')}}
@endsection

@section('head_section')

<!-- {!! Html::style('plugins/datatables/dataTables.bootstrap.min.css')  !!} -->
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

	<div class="panel-body" style="margin-left:-9%; width:117%;">
  <?php

  foreach($users_uploads as $user_upload)
  {
    // print_r($user_upload);
    // echo "<hr>";
  }

  // $deadline=date_parse(base64_decode($deadline));
  // print_r($deadline);

  // echo base64_decode($deadline);

$deadline_date=base64_decode($deadline);

$deadline_date = new DateTime($deadline_date);


        $temp_date=strtotime(base64_decode($deadline));
        $formatted_date=date('Y-m-d',$temp_date);
                
        $new_date=new DateTime($formatted_date);
        $readable_deadline_date=$new_date->format('d-m-Y');

        // $readable_deadline_date=$new_date->format('d-m-Y [l]');

        // $readable_day=$new_date->format('l');
        // $file_name=explode('_-_',$file_upload->name);
                    
        // $file_upload_date = $file_upload->created_at;
                    
        // $file_upload_date = new DateTime($file_upload_date);




  ?>



<!-- Panel Table Tools -->
      <div class="panel">
     

     <h5 style="width:200px; display:inline; margin-top:-5px; float:right; margin-right:-6%; font-size:10px;">Deadline Date: {{$readable_deadline_date}}</h5>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="Deadline_table">
            <thead>
              <tr>
                
                <th style="max-width:1px;">#</th>
                <th>User</th>
               
                <th>status</th>
              
              
           
               
               
              </tr>
            </thead>
      
            <tbody>
          <?php

          // setting a counter varibale here for number of user
          $user_counter=0;

          ?>
            
          @foreach($users_uploads as $user_upload)
          <!-- each user's file upload information  -->
       
          <tr>

            <td>
                {{++$user_counter}}
            </td>
            <!-- User Name should appear here -->
            <td style="min-width:100px;">
        {{$user_upload->user_details->name}}
            </td>
            
            
            @if(!empty($user_upload->file_uploaded))
            
            @foreach($user_upload->file_uploaded as $file_upload)
                <?php

                    $temp_date=strtotime( $file_upload->created_at);
                    $formatted_date=date('Y-m-d',$temp_date);
                
                    $new_date=new DateTime($formatted_date);
                    $readable_date=$new_date->format('d-m-Y');

                    $readable_day=$new_date->format('l');
                    $file_name=explode('_-_',$file_upload->name);
                    
                    $file_upload_date = $file_upload->created_at;

                    $temp_date=strtotime($file_upload_date);
                    $formatted_date=date('Y-m-d',$temp_date);
                            
                    $new_date=new DateTime($formatted_date);
                    // $readable_file_upload_date=$new_date->format('d-m-Y:l');
                    $readable_file_upload_date=$new_date->format('d-m-Y');

                    
                    $file_upload_date = new DateTime($file_upload_date);


                  

                  ?>
              <?php
              $deadline_date=$deadline_date->format('Y-m-d');
              $file_upload_date=$file_upload_date->format('Y-m-d');
              ?>
          
              @if($deadline_date>=$file_upload_date)
                <td style="background:#dff0d8;">
               
              @else

                <td class="bg-warning">
                   
              @endif 
                <a  style="text-decoration:none;" href="{{ URL::to('/fileDownload')}}/download/{{$file_upload->name}}" data-toggle="tooltip" data-placement="right" title="{{$file_name[0]}} on Date {{$readable_date}} [{{$file_upload->description}}]"><span style="background:#FFD700; color:#222; margin-bottom:82px; border:2px solid #DAA520; text-decoration:none; border-radius:100px; padding:0px 7px; margin-bottom:5px; box-shadow:0px 1px 1px #333; display:inline;">{{$file_upload->abbreviation}}</span> |</a>
               {{ $readable_file_upload_date}}
               
               </td>        
            @endforeach  
            
            @else
            <td style="background:#f2dede;">
            No upload
            </td>  
            @endif
            

           
          </tr> 
          <!-- each user's file upload  info ends here-->
          @endforeach
     
            </tbody>
          </table>
        </div>

          
     
      </div>
      <!-- End Panel Table Tools -->





	</div>
</div>

@endsection

@section('body_end_section')

{!!  Html::script('plugins/datatables/jquery.dataTables.js')  !!}
{!!  Html::script('plugins/datatables/buttons.colVis.min.js') !!}

<script>
      $(document).ready(function() {

      var table = $('#Deadline_table').DataTable({
    

          "paging":true,
        
          "info":true,
          "pagingType": "full_numbers",
           colReorder: true,
          select: true,
            
         
           dom: 'Blfrtip',

     
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
         //      leftColumns: 2,
         //      rightColumns: 2
         //  },
            

    
      });

	table.on( 'order.dt search.dt', function () {
  
    } ).draw();

$("div.DTFC_LeftHeadWrapper").css('margin-bottom',-10);
$("div.DTFC_RightHeadWrapper").css('margin-bottom',-10);
$("table td").css('border','1px solid #eee');
$(".DTFC_Cloned thead").css('background','#fff');


  } );
 </script>
@endsection