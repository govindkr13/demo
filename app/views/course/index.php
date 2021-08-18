<?php

$this->title = 'Users'

?>

<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>DOB</th>
        <th>Contact No</th>
        <th>Action</th>
    </tr>


    <?php if (!empty($users)) : ?>

        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?=$user->first_name?></td>
                <td><?=$user->last_name?></td>
                <td><?=$user->dob?></td>
                <td><?=$user->contact_no?></td>
                <td>
                    <a href="/user/update?id=<?=$user->id?>">Edit</a>
                    <a href="/user/delete?id=<?=$user->id?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else : ?>
        <tr>
            <td colspan="4">No Result Found</td>
        </tr>
    <?php endif ?>

</table>