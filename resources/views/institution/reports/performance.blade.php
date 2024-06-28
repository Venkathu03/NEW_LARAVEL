@extends('institution.layouts.app')
@section('institution-content')

<div class="card shadow-none bg-transparent border-bottom border-2">
   <div class="card-body">
      <div class="row align-items-center">
         <div class="col-md-12">
            <h4 class="mb-3 mb-md-0">Performance Report</h4>
         </div>
       
      </div>
   </div>
</div>
<div class="col">
   <div class="card">
      <div class="card-body">
       
         <div class="tab-content py-3">
            <div class="tab-pane fade show active" id="primaryprofile" role="tabpanel">
               <div class="row row-cols-1">
                 
               </div>
               <div class="card">
                  <div class="card-body">
                      <div id="buttons"></div>
                     <div class="table-responsive">
                        <table id="example21" class="table table-striped table-bordered">
                           <thead style="background-color: #E4E4E4;">
                              <tr>
                                  <th>S.No.</th>
                                  <th>Student Name</th>
                                  <th>Course Name</th>
                                  <th>Procedure Name</th>
                                  <th>Procedure Type Name</th>
                                  <th>Score</th>
                                 <th>Exam Date</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($performances as $key=>$performance)
                              <tr>
                                 <td>{{$key+1}}</td>
                                 <td>{{$performance->student->fullname}}</td>
                                  <td>@if(!is_null($performance->student->course))
                                      {{$performance->student->course->course_name}}
                                    @endif
                                  </td>
                                  <td>{{$performance->procedure->procedure_name}}</td>
                                  <td>{{$performance->proceduretype->procedure_type_name}}</td>
                                  <td>{{$performance->score}}</td>
                                  <td>{{$performance->created_at->format('Y-m-d')}}</td>
                                 
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
          
         </div>
      </div>
   </div>
</div>



@endsection