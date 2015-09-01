@if (count($errors) > 0)
   <div class="alert alert-danger">
     <strong>Whoops!</strong>
     There were some problems with your input.<br><br>
     <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
     </ul>
   </div>
@endif
@if (session('failure'))
   <div class="alert alert-danger alert-dismissible">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <strong>Oops!</strong>
         {{ session('failure') }}<br><br>
   </div>
@endif
