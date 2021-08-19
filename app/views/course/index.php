<?php

$this->title = 'courses'

?>

<table>
    <tr>
        <th>Course Name</th>
     
        <th>Action</th>
    </tr>


    <?php if (!empty($courses)) : ?>

        <?php foreach ($courses as $course) : ?>
            <tr>
                <td><?= $course->name ?></td>
                
               
                <td>
                    <a href="/course/update?id=<?= $course->id ?>">Edit</a>
                    <a href="/course/delete?id=<?= $course->id ?>" onclick="return confirm('Are you sure, you want to delte this record?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else : ?>
        <tr>
            <td colspan="2">No Result Found</td>
        </tr>
    <?php endif ?>

</table>

<div class="pagination">
    
    <?php for ($i = 1; $i <= $pages; $i++) : ?>
        <a href="/course?page=<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>