<td style="display: inline-flex;">
  <a href="#" style="text-decoration: underline; color: #000000;" class="edit_detail" data-value="{{$id}}" data-url="/admin/edit/student">Edit</a>
  &nbsp     
  <span type="button" class="show_confirm"  style="text-decoration:underline;color:#000000;" data-toggle="tooltip" title='Delete' onclick="confirmDelete('{{$id}}')"> Delete</span>

  <form method="POST" action="/admin/student/destroy/{{$id}}" id="deleteForm_{{$id}}">
    @csrf
    <input name="_method" type="hidden" value="DELETE">
  </form>
</td>


<script>
  function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this student?")) {
      // If the user confirms, submit the form with the DELETE request
      document.getElementById(`deleteForm_${id}`).submit();
    }
  }
</script>
