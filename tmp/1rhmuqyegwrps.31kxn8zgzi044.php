<table class="student_table highlight centered">
        <thead>
          <tr>
              <th></th>
              <th>Student No.</th>
              <th>Username</th>
              <th>Degree Program</th>
              <th>College</th>
          </tr>
        </thead>

        <?php foreach (($students?:[]) as $student): ?>
        <tbody>
          <tr>
            <td><?= ($student['student_id']) ?></td>
            <td><?= ($student['student_no']) ?></td>
            <td><?= ($student['student_username']) ?></td>
            <td><?= ($student['student_degree_program']) ?></td>
            <td><?= ($student['student_college']) ?></td>
          </tr>
        </tbody>
      <?php endforeach; ?>
      </table>