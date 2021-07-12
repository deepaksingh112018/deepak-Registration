<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <style>
      .error{
      color: red;
    }
    </style>
</head>
<body>
	<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Add Registration From
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Registration Form Modal </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="backend" id="registration-form">
   <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control"   placeholder="Name">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control"  aria-describedby="emailHelp" placeholder="example@gmail.com">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password"  class="form-control" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="mobile">Contact No</label>
    <input type="number" name="mobile" id="mobile"  class="form-control" placeholder="Mobile No">
  </div>
  <div class="form-group">
    <label for="village">Village</label>
    <input type="text" name="village" id="village" class="form-control"  placeholder="Village">
  </div>
  <input type="hidden" name="editId" id="editId">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>

{{-- table --}}
<table class="table" id="tbRegistration">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Email</th>
      <th>Password</th>
      <th>Mobile</th>
      <th>Village</th>
      <th>Date</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $key=> $detail)
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$detail->name}}</td>
      <td>{{$detail->email}}</td>
      <td>{{$detail->password}}</td>
      <td>{{$detail->mobile}}</td>
      <td>{{$detail->village}}</td>
      <td>{{$detail->created_at}}</td>
      <td><a onclick="editForm('{{$detail->id}}')" class="btn btn-primary">Edit</a></td>
      <td><a onclick="deleteForm('{{$detail->id}}',this)" class="btn btn-danger">Delete</a></td>
    </tr>
    @endforeach()
  </tbody>
</table>

</body>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('js/all.min.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<script>
  // validator

 $('#registration-form').validate({
  rules:{
    name:{
      required:true,
    },
    email:{
      required:true,
    },
    password:{
      required:true,
    },
    mobile:{
      required:true,
    },
    village:{
      required:true,
    }
  },
    submitHandler:function(){
      $('#registration-form').submit();
    }
 });

// deleteForm

  function deleteForm(userId,arg){
    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $.ajax({
      url:'delete',
      type:'get',
      data:{id:userId},
      success:function(response){
        swal("Success","Record Deleted Successfully","success");
        $(arg).closest('tr').remove();
        $.each($('tbRegistration tbody tr'),function(key,value){
          $(this).find('td:first-child').html(key+1);
        })
      }
    })
  } 
});
  }

  // edit
  function editForm(userId){
    $.ajax({
      url:'edit',
      type:'get',
      data:{id:userId},
      success:function(response){
        $('#editId').val(response.id);
        $('#name').val(response.name);
        $('#email').val(response.email);
        $('#password').val(response.password);
        $('#mobile').val(response.mobile);
        $('#village').val(response.village);
        $('#exampleModal').modal('show');
      }
    })

  }
 
</script>
</html>