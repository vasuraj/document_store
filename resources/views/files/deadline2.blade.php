@extends('app')

@section('page_title')
User Document and Amount Received
@endsection

@section('head_section')
{!! Html::style('plugins/datatables/datatables.min.css')  !!}
{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')  !!}
@endsection

@section('content')
<div class="container">
	
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
$(".DTFC_Cloned thead").css('background','#fff');


  } );
 </script>
@endsection