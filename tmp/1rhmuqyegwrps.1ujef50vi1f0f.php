    <!-- Modal Trigger -->
  <center>
      <a class="openModal waves-effect waves-light btn green darken-1 modal-trigger" href="#add-modal">Add New Course</a>
  </center>
      
  <!-- Modal Structure -->
  <div id="add-modal" class="modal">
      <div class="modal-content">
          <h4>Add Course Information</h4>
      
          <form method="POST" action="/courses">
            <div class="row">
              <div class="input-field col s6">
                <input id="course_code" name="course_code" type="text" class="validate" required>
                <label for="course_code">Course Code</label>
              </div>
              <div class="input-field col s6">
                <input id="course_title" name="course_title" type="text" class="validate" required>
                <label for="course_title">Course Title</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s6">
                <input id="course_units" name="course_units" type="number" step="0.01" class="validate" required>
                <label for="course_units">Course Units</label>
              </div>
              <div class="input-field col s6">
                <input id="course_max_students" name="course_max_students" type="number" class="validate" required>
                <label for="course_max_students">Course Max Students</label>
              </div>
            </div>


            </div>

            <div class="modal-footer">
              <input type="hidden" name="form" value="add">
              <button class="btn waves-effect waves-light" type="submit">Submit</button>
            </div>
        </form>
      </div>

      <!-- Modal Structure -->
  <div id="edit-modal" class="modal">
    <div class="modal-content">
        <h4>Edit Course Information</h4>
    
        <form method="POST" action="/courses">
          <div class="row">
            <div class="input-field col s6">
              <input id="course_code" name="course_code" type="text" class="validate" value="<?= ($to_edit['course_code']) ?>" required>
              <label for="course_code">Course Code</label>
            </div>
            <div class="input-field col s6">
              <input id="course_title" name="course_title" type="text" class="validate" value="<?= ($to_edit['course_title']) ?>" required>
              <label for="course_title">Course Title</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s6">
              <input id="course_units" name="course_units" type="number" step="0.01" class="validate" value="<?= ($to_edit['course_units']) ?>" required>
              <label for="course_units">Course Units</label>
            </div>
            <div class="input-field col s6">
              <input id="course_max_students" name="course_max_students" type="number" class="validate" value="<?= ($to_edit['course_max_students']) ?>"required>
              <label for="course_max_students">Course Max Students</label>
            </div>
          </div>


          </div>

          <div class="modal-footer">
            <input type="hidden" name="form" value="add">
            <button class="btn waves-effect waves-light" type="submit">Submit</button>
          </div>
      </form>
    </div>

  <script>
      $(document).ready(function () {
          $('.modal').modal();
      })
  </script>

<table class="student_table highlight centered">
    <thead>
      <tr>
        <th></th>
        <th>Course No.</th>
        <th>Course Title</th>
        <th>Units</th>
        <th>Slots</th>
        <th></th>
        <th></th>
      </tr>
    </thead>

    <?php foreach (($courses?:[]) as $course): ?>
      <tbody>
        <tr>
          <td><?= ($course['course_id']) ?></td>
          <td><?= ($course['course_code']) ?></td>
          <td><?= ($course['course_title']) ?></td>
          <td><?= ($course['course_units']) ?></td>
          <td><?= ($course['course_max_students']) ?></td>
          <td><button class="blue btn-floating" type="submit" onclick="window.location.href='/courses/<?= ($course['course_id']) ?>';" name="to_edit_course"><i class="material-icons">edit</i></button></td>
          <form action="/courses" method="POST">
            <input type="hidden" name="form" value="delete">
            <td><button class="red btn-floating" type="submit" value="<?= ($course['course_id']) ?>" name="to_delete_course"><i class="material-icons">delete</i></button></td>
          </form>
        </tr>
      </tbody>
    <?php endforeach; ?>
  </table>