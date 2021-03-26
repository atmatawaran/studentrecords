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
          <form action="#" method="POST">
            <input type="hidden" name="form" value="add">
            <td><button type="submit" value="<?= ($course['course_id']) ?>" name="added_course" class="green btn-floating"><i class="material-icons">edit</i></a></td>
          </form>
          <form action="#" method="POST">
            <input type="hidden" name="form" value="add">
            <td><button type="submit" value="<?= ($course['course_id']) ?>" name="added_course" class="red btn-floating"><i class="material-icons">delete</i></a></td>
          </form>
        </tr>
      </tbody>
    <?php endforeach; ?>
  </table>