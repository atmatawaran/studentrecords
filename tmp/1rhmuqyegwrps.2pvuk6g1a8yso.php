<h4 class="course_update">Edit Course Information</h4>
    
        <form method="POST" action="<?= ($BASE) ?><?= ($PARAMS[1]) ?>">
            <div class="input-field col s6 course_update"> 
              <input id="course_code" name="course_code" type="text" class="validate" value="<?= (isset($POST['course_code'])?htmlspecialchars($POST['course_code']):'') ?>" required>
              <label for="course_code">Course Code</label>
            </div>
            <div class="input-field col s6 course_update">
              <input id="course_title" name="course_title" type="text" class="validate" value="<?= (isset($POST['course_title'])?htmlspecialchars($POST['course_title']):'') ?>" required>
              <label for="course_title">Course Title</label>
            </div>

            <div class="input-field col s6 course_update">
              <input id="course_units" name="course_units" type="number" step="0.01" class="validate" value="<?= (isset($POST['course_units'])?htmlspecialchars($POST['course_units']):'') ?>" required>
              <label for="course_units">Course Units</label>
            </div>
            <div class="input-field col s6 course_update">
              <input id="course_max_students" name="course_max_students" type="number" class="validate" value="<?= (isset($POST['course_max_students'])?htmlspecialchars($POST['course_max_students']):'') ?>" required>
              <label for="course_max_students">Course Max Students</label>
            </div>

            <input type="hidden" name="form" value="edit">
            <button class="course_update course_updatebtn btn waves-effect waves-light" type="submit">Update</button>
        </form>