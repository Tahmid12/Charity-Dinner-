<?php
require '../library/mysql_queries.php';

$events = get_all_events();
?>
<table>
  <tr>
    <th>Name</th>
    <th>Description</th> 
    <th>Location</th>
    <th>Event Date</th>
    <th>Category</th>
    <th>Tickets Available</th>
    <th>Sale Ends</th>
  </tr>
<?php foreach ($events as $e): array_map('htmlentities', $e); ?>
    <tr>
      <td><?php echo implode('</td><td>', $e); ?></td>
      <td><?php echo "$e[name]" ?></td>
    </tr>
<?php endforeach; ?>
</table>