<?php

echo '<table class="table table-dark mt-2">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Username</th>
      <th scope="col">Role</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>';
  foreach($users as $user){
  echo ' <tr>
      <th>'.$user['userID'].'</th>
      <td>'.$user['username'].'</td>
      <td>'.$user['role'].'</td>
      <td>
        <form method="post" action="admin/delete/'.$user['userID'].'">
          <input type="submit" class="btn btn-danger btn-sm mt-1" name="action" value="X"/>
        </form>
      </td>
    </tr>';
}

echo'</tbody>
</table>';

?>