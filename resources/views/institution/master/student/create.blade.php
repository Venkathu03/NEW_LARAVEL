 <div class="modal-header">
                                          <h5 class="modal-title text-white" style="color: #000000!important;">Create Student</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body text-white">
                                          <form class="row g-3" action="{{ route('institution-student.store')}}" method="post">
                                             @csrf
                                             <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label" style="color: #000000!important;">Student Name</label>
                                                <input type="text" required class="form-control" name="fullname">
                                             </div>
                                            
                                             <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label" style="color: #000000!important;">Email Id</label>
                                                <input type="email" required class="form-control email" name="email">
                                                <span style="margin-top: 7px;" class="emailMatch"></span>
                                             </div>
                                              <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Password</label>
                                                <input type="number" class="form-control CheckPassword" id="passwod" name="password" required=''>
                                                  <span style="margin-top: 7px;" class="CheckcharPasswordMatch"></span>
                                             </div>
                                               <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Mobile Number</label>
                                                <input type="number" class="form-control mobile" name="phone_number" required='' pattern="[6-9]{1}[0-9]{9}">
                                                  <span style="margin-top: 7px;" class="mobileMatch"></span>
                                             </div>
                                               
                                             <div class="col-md-6">
                                                <label for="inputState" class="form-label" style="color: #000000;">Course Studying</label>
                                                <select required class="form-select course_name1" name="course_name" id="course_name1" style="border: 1px solid #40D4FF;">
                                                   <option value="">Choose...</option>
                                                    @foreach($courses as $course)
                                                    <option value="{{$course->id}}">{{$course->course_name}}</option>
                                                    @endforeach
                                                </select>
                                             </div>
                                              
                                               <div class="col-md-6">
                                                   <label class="form-label" style="color: #000000;">
                                                    Passing Year
                                                     </label>
                                                     <select class="form-select form-select-sm passing_year1" name="passing_year" required>
                                                          <option value="">Choose</option>
                                                     </select>
                                                     <span style="margin-top: 7px;" class="subscribelMatch"></span>
                                                     <input type="hidden" class="no_of_year" name="year_level">
                                              </div>
                                           
                                             <div class="col-12">
                                                <button type="submit" class="btn btn-primary px-5 btn-submit"><i class="lni lni-circle-plus"></i>Create Student</button>
                                             </div>
                                          </form>
                                       </div>