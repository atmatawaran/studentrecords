<div class="row homepage">
  <div class="col s8 push-s4">

    <table class="student_table highlight centered">
      <thead>
        <tr>
          <th></th>
          <th>Course No.</th>
          <th>Course Title</th>
          <th>Units</th>
          <th>Slots</th>
          <th></th>
        </tr>
      </thead>

      <h4 id="table_title"><b>List of Courses</b></h4>

      <?php foreach (($courses?:[]) as $course): ?>
        <tbody>
          <tr>
            <td><?= ($course['course_id']) ?></td>
            <td><?= ($course['course_code']) ?></td>
            <td><?= ($course['course_title']) ?></td>
            <td><?= ($course['course_units']) ?></td>
            <td><?= ($course['course_max_students']) ?></td>
            <form action="/" method="POST">
              <input type="hidden" name="form" value="add">
              <td <?= ($status) ?>><button type="submit" value="<?= ($course['course_id']) ?>" name="added_course" class="btn-floating"><i class="material-icons">add</i></a></td>
            </form>
          </tr>
        </tbody>
      <?php endforeach; ?>
    </table>

  </div> <!-- end of <div class="col s8 push-s4"> -->

  <div class="col s4 pull-s8 student-card">

    <div class="row">
      <div class="card black-text text-darken-2">
        <div class="card-content black-text">
          <span class="card-title"><b><?= ($current_user['student_lname']) ?>, <?= ($current_user['student_fname']) ?> <?= ($current_user['student_mname']) ?></b></span>
          <p>Student No: <?= ($current_user['student_no']) ?></p>
          <p>Degree Program: <?= ($current_user['student_degree_program']) ?></p>
          <p>Allowable load: <?= ($current_user['student_max_units']) ?></p>
        </div>
        <div class="card-action">
            <p><?= ($title) ?></p>

            <table>
              <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Units</th>
                    <th></th>
                </tr>
              </thead>
      
              <tbody>
                <?php foreach (($final_cart?:[]) as $cart): ?>
                  <tr>
                    <td><?= ($cart['course_code']) ?></td>
                    <td><?= ($cart['course_units']) ?></td>
                    <form action="/" method="POST">
                      <input type="hidden" name="form" value="remove">
                      <td <?= ($status) ?>><button type="submit" value="<?= ($cart['course_id']) ?>" name="removed_course" class="btn-floating red"><i class="material-icons">clear</i></a></td>
                    </form>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <td><b>Total</b></td>
                <td><b><?= ($total_units) ?>.00</b></td>
                <td></td>
              </tfoot>
            </table>

            <form <?= ($status) ?> action="/" method="POST">
              <input type="hidden" name="form" value="enroll">
              <button class="btn waves-effect waves-light enrollbtn" type="submit" name="action">Enroll</button>
            </form>

            <form <?= ($unenroll_status) ?> action="/" method="POST">
              <input type="hidden" name="form" value="unenroll">
              <button class="btn waves-effect waves-light unenrollbtn" type="submit" name="action">Unenroll</button>
            </form>

        </div>
      </div>
    </div>

  </div> </div> <!-- end of <div class="col s4 pull-s8"> -->
</div> <!-- end of row -->