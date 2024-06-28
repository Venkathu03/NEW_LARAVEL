<div class="modal-header">
                                                <h5 class="modal-title text-white" style="color: #000000!important;">Add a Subscription</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                             </div>
                                             <div class="modal-body text-white">
                                                <form class="row g-3" action="{{ route('subscription.store')}}" method="post">
                                                   @csrf
                                                   <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Institution Name</label>
                                                      <select type="text" class="form-select institution_name" name="institution_id" required>
                                                         <option value="">--Select Institution--</option>
                                                         @foreach($institutions as $institution)
                                                         <option value="{{$institution->id}}">{{$institution->institution_name}}</option>
                                                         @endforeach
                                                      </select>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Course Name</label>
                                                      <select type="text" class="form-select course_name" name="course_id" required>
                                                         <option value="">--Select Course--</option>
                                                         @foreach($courses as $course)
                                                         <option value="{{$course->id}}">{{$course->course_name}}</option>
                                                         @endforeach
                                                      </select>
                                                   </div>
                                                
                                                    <div class="row show-class"></div>
                                                    
                                                   <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Course Started At</label>
                                                       <select type="text" class="form-select course_start_at" name="course_start_at" required>
                                                              <option value="">Choose</option>
                                                            <option value="1">January</option>
                                                            <option value="2">February</option>
                                                            <option value="3">March</option>
                                                             <option value="4">April</option>
                                                             <option value="5">May</option>
                                                             <option value="6">June</option>
                                                             <option value="7">July</option>
                                                             <option value="8">August</option>
                                                             <option value="9">September</option>
                                                             <option value="10">October</option>
                                                             <option value="11">November </option>
                                                             <option value="12">December</option>
                                                           
                                                       </select>
                                                   </div>
                                                    
                                                     <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Course End At</label>
                                                       <select type="text" class="form-select course_start_at" name="course_end_at" required>
                                                            <option value="">Choose</option>
                                                            <option value="1">January</option>
                                                            <option value="2">February</option>
                                                            <option value="3">March</option>
                                                             <option value="4">April</option>
                                                             <option value="5">May</option>
                                                             <option value="6">June</option>
                                                             <option value="7">July</option>
                                                             <option value="8">August</option>
                                                             <option value="9">September</option>
                                                             <option value="10">October</option>
                                                             <option value="11">November </option>
                                                             <option value="12">December</option>
                                                           
                                                       </select>
                                                   </div>
                                                    
                                                    <span style="margin-top: 7px;" id="emailMatch"></span>
                                                   <div class="col-12">
                                                      <button type="submit" class="btn btn-primary px-5 btn-submit"><i class="lni lni-circle-plus"></i>Create</button>
                                                   </div>
                                                </form>
                                             </div>