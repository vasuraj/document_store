@extends('app')

@section('page_title')
Deadline
@endsection

@section('head_section')
<style>
  
  body, html
  {
    height:100%;

  }
</style>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12" style="height:100%;">
    <div class="panel panel-default">
  <div class="panel-heading">File Upload Status


    <select style=" margin-top:-7px; display:inline; width:50%; float:right"; class="selectpicker form-control" required id="abbreviation" name="abbreviation">
      
      <option value="none" data-deadline="">none</option>

    @foreach($unique_file_abbreviations as $abbreviation)
      <?php
        $file_name=explode('_-_',$abbreviation->name);


      ?>
      <option value="{{$abbreviation->abbreviation}}" data-deadline="{{base64_encode($abbreviation->deadline)}}">{{$abbreviation->abbreviation}} - {{$file_name[0]}}</option>
        

    @endforeach
    </select>
    
    </div>
  </div>



   <!--  <button class="btn btn-primary">Get status</button>
 -->

    <iframe src=""  id="Iframe" style="height:auto; width:100%; margin-top:-21px;"  frameborder="0"></iframe>


			</div>
		</div>
	</div>
</div>

@endsection

@section('body_end_section')

<script>
  
$(function(){
    $("#abbreviation").change(function(){

    var abbreviation=$(this).find(':selected').val();
    var deadline=$(this).find(':selected').attr('data-deadline');
    if(abbreviation!="none")
    {
        $.get("{{url('/fileUpload/deadline')}}", function(data){
          // alert("Data: " + data);

        $("iframe").attr('src',"{{url('/fileUpload/getdeadline')}}/"+abbreviation+'/'+deadline);

        });
    }
    else
    {
        $("iframe").attr('src','');

    }


    // Dynamic iframe height 

   setInterval(function(){
      document.getElementById("Iframe").style.height = document.getElementById("Iframe").contentWindow.document.body.scrollHeight-20 + 'px';
  },0)


    });




});



</script>
@endsection
