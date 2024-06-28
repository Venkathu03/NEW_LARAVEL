 <div class="modal-header">
                                                <h5 class="modal-title text-white" style="color: #000000!important;">Add a Course</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                             </div>
                                             <div class="modal-body text-white">
                                                <form class="row g-3" action="{{ route('course.store')}}" method="post">
                                                   @csrf
                                                   <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Enter the Course Name</label>
                                                      <input type="text" class="form-control" name="course_name" required>
                                                   </div>
                                                    <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Study Duration(In Years)</label>
                                                      <input type="number" class="form-control" min="1" max="10" name="study_duration" value="1" required>
                                                   </div>
                                                   <div class="col-12">
                                                      <button type="submit" class="btn btn-primary px-5"><i class="lni lni-circle-plus"></i>Create</button>
                                                   </div>
                                                </form>
                                             </div>