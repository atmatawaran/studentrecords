    <!-- Modal Trigger -->
    <center>
        <a class="openModal waves-effect waves-light btn green darken-1 modal-trigger" href="#demo-modal">Add New Student</a>
    </center>
        
    <!-- Modal Structure -->
    <div id="demo-modal" class="modal">
        <div class="modal-content">
            <h4>Student Information</h4>
        
            <form method="POST" action="/students">
                <div class="input-field col s6">
                  <input id="student_fname" name="student_fname" type="text" class="validate" required>
                  <label for="student_fname">First Name</label>
                </div>
                <div class="input-field col s6">
                  <input id="student_mname" name="student_mname" type="text" class="validate" required> 
                  <label for="student_mname">Middle Name</label>
                </div>
                <div class="input-field col s6">
                    <input id="student_lname" name="student_lname" type="text" class="validate" required>
                    <label for="student_lname">Last Name</label>
                  </div>

                  <div class="row">
                    <div class="input-field col s6">
                      <input id="student_no" name="student_no" type="text" class="validate" required>
                      <label for="student_no">Student Number (format: 2015-XXXXX)</label>
                    </div>
                    <div class="input-field col s6">
                      <input id="student_degree_program" name="student_degree_program" type="text" class="validate" required>
                      <label for="student_degree_program">Degree Program (e.g. BS Statistics)</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s6">
                      <input id="student_college" name="student_college" type="text" class="validate" required>
                      <label for="student_college">College (e.g. CAS)</label>
                    </div>
                    <div class="input-field col s6">
                      <input id="student_max_units" name="student_max_units" type="number" step="0.01" class="validate" required>
                      <label for="student_max_units">Allowable load</label>
                    </div>
                  </div>

                  <div class="row credentials">
                    <div class="input-field col s6">
                      <input id="student_username" name="student_username" type="text" class="validate" required>
                      <label for="student_username">Assign a username</label>
                    </div>
                    <div class="input-field col s6">
                      <input id="student_password" name="student_password" type="text" class="validate" required>
                      <label for="student_password">Assign a password</label>
                    </div>
                  </div>


            </div>
  
            <div class="modal-footer">
              <div class="modal-footer">
                <input type="hidden" name="form" value="add">
                <button class="btn waves-effect waves-light" type="submit">Submit</button>
              </div>
            </div>
          </form>
        </div>


    <script>
        $(document).ready(function () {
            $('.modal').modal();
        })
    </script>

    <table class="highlight centered">
        <thead>
        <tr>
            <th></th>
            <th>Student No.</th>
            <th>Full Name</th>
            <th>Degree Program</th>
            <th>College</th>
            <th></th>
            <th></th>
        </tr>
        </thead>

        <?php foreach (($students?:[]) as $stud): ?>
        <tbody>
            <tr>
            <td><?= ($stud['student_id']) ?></td>
            <td><?= ($stud['student_no']) ?></td>
            <td><?= ($stud['student_lname']) ?>, <?= ($stud['student_fname']) ?> <?= ($stud['student_mname']) ?></td>
            <td><?= ($stud['student_degree_program']) ?></td>
            <td><?= ($stud['student_college']) ?></td>
            <td><button class="blue btn-floating" type="submit" onclick="window.location.href='/students/<?= ($stud['student_id']) ?>';" name="to_edit_course"><i class="material-icons">edit</i></button></td>
            <form action="/students" method="POST">
                <input type="hidden" name="form" value="delete">
                <td><button type="submit" value="<?= ($stud['student_id']) ?>" name="to_delete_student" class="red btn-floating"><i class="material-icons">delete</i></a></td>
            </form>
            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
    
  
</body>