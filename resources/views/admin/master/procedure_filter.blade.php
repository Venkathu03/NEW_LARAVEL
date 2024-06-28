<script>

      $(document).ready(function() {
			var table = $('#filter').DataTable( {	
			} );
            });

</script>

<table id="filter" class="table table-striped table-bordered">
                                 <thead style="background-color: #E4E4E4;">
                                    <tr>
                                       <th>S.No</th>
                                       <th>Procedure ID</th>
                                       <th>Procedure Name</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($procedures as $key=>$procedure)
                                    <tr>
                                       <td>{{ $key+1}}</td>
                                       <td>{{$procedure->id}}</td>
                                       <td>{{$procedure->procedure_name}}</td>
                                       <td><span  class="view_master"  
                                          style="text-decoration: underline; color: #000000;" 
                                          data-form-type="procedure" data-value="{{$procedure->id}}">Edit</span>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
