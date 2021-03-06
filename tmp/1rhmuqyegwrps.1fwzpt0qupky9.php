<h5 class="course_update course_update_title"><b>Edit Student Information</b></h5>
    
        <form class="update_course_form" method="POST" action="<?= ($BASE) ?><?= ($PARAMS[1]) ?>">
            <div class="input-field col s6 course_update">
                <input id="student_fname" name="student_fname" type="text" class="validate" value="<?= (isset($POST['student_fname'])?htmlspecialchars($POST['student_fname']):'') ?>" required>
                <label for="student_fname">First Name</label>
              </div>
              <div class="input-field col s6 course_update">
                <input id="student_mname" name="student_mname" type="text" class="validate" value="<?= (isset($POST['student_fname'])?htmlspecialchars($POST['student_mname']):'') ?>" required> 
                <label for="student_mname">Middle Name</label>
              </div>
              <div class="input-field col s6 course_update">
                  <input id="student_lname" name="student_lname" type="text" class="validate" value="<?= (isset($POST['student_fname'])?htmlspecialchars($POST['student_lname']):'') ?>" required>
                  <label for="student_lname">Last Name</label>
                </div>

                <div class="row course_update_row">
                  <div class="input-field col s6">
                    <input id="student_no" name="student_no" type="text" class="validate" value="<?= (isset($POST['student_no'])?htmlspecialchars($POST['student_no']):'') ?>" required>
                    <label for="student_no">Student Number (format: 2015-XXXXX)</label>
                  </div>
                  <div class="input-field col s6">
                    <input id="student_degree_program" name="student_degree_program" type="text" class="validate" value="<?= (isset($POST['student_degree_program'])?htmlspecialchars($POST['student_degree_program']):'') ?>" required>
                    <label for="student_degree_program">Degree Program (e.g. BS Statistics)</label>
                  </div>
                </div>

                <div class="row course_update_row">
                  <div class="input-field col s6">
                    <input id="student_college" name="student_college" type="text" class="validate" value="<?= (isset($POST['student_college'])?htmlspecialchars($POST['student_college']):'') ?>" required>
                    <label for="student_college">College (e.g. CAS)</label>
                  </div>
                  <div class="input-field col s6">
                    <input id="student_max_units" name="student_max_units" type="number" step="0.01" class="validate" value="<?= (isset($POST['student_max_units'])?htmlspecialchars($POST['student_max_units']):'') ?>" required>
                    <label for="student_max_units">Allowable load</label>
                  </div>
                </div>

                <input type="hidden" name="form" value="edit">
                <button class="course_update course_updatebtn btn" type="submit">Save Changes</button>

            </form>