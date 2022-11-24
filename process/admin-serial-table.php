 <table  class="admin-serials" >
        <tr style="border-bottom:1px solid #C7C7C7;">

            <td class="admin-border-right">Order #</td>
    <?php if (isset($_SESSION["site_admin"]) && (int) $_SESSION["site_admin"]) { ?>
              <td class="admin-border-right">Site</td>	
    <?php } ?>
            <td class="admin-border-right">Name</td>
	        <td class="admin-border-right">Course</td>
            <td class="admin-border-right">Language</td>
            <td class="admin-border-right">Module Progress</td> 
            <td class="admin-border-right">Status</td>
            <td class="admin-border-right">Password</td>

        </tr>
        <?php
        $x = 1;
     //   $check_all = NULL;
		 
        while ($row = mysql_fetch_array($data)) {
          $suffix_resit = '';
          if($row['resit-order'] != '') {
            $suffix_resit =  ' (Resit)';
          }
          if ($row['activated'] == "yes") {
            $result = 'Activated';
          } else {
            $result = '<a href="admin-serials.php?serial=' . $row['serial'] . '&&update=no">Admin Activation <strong>' . $suffix_resit . '</strong></a>';
          }
          $completed_modules = 0;
		  
$sql = "SELECT * FROM course WHERE course_ID = '".$row['course']."'";
$courseResult = mysql_query($sql) or die(mysql_error());
$courseDetails = mysql_fetch_assoc($courseResult);
		      $total_modules = $courseDetails['modules']; 
		      if ($courseDetails['modules'] =='')  $total_modules = 8;//default
	
		  
		  
          for ($i = 1; $i <= $total_modules; $i++) {
            if ($row[$i] == "No") {
              $i -= 1;
              break;
            }
          }

          $completed_modules = ($i > $total_modules) ? $total_modules : $i;
	     
		 if ($courseDetails['course'] == 'allergen' && $completed_modules > 1 ) {
		  $completed_modules =  $completed_modules  - 1;
		  }
		  
		  
		  
          $result = ($i > $total_modules) ? "Passed" : $result;

          if ($row['activated'] == "yes" || $i > $total_modules) {
              $link = "<a href=\"admin-modules.php?x=" . $row['ID'] . "\">" . $completed_modules . "/" . $courseDetails['modules_admin'] . " Modules" . ( ($completed_modules >= $courseDetails['modules_admin']) ? ' (Cert. sent)'  : ''  ) . "{$suffix_resit}</a>";

            } else {

            $link = " - ";
          }
	/* echo 'result:' .$result;
	 echo '<br/>';  
     echo 'total_modules:' .$total_modules;
	 echo '<br/>';
	 echo 'completed_modules:' .$completed_modules;
	 echo '<br/>';
	 echo 'i:' .$i;*/
	 
          echo "<tr>";

          echo "<td class=\"admin-border-right\">" . $row['order-number'] . "</td>";
          if (isset($_SESSION["site_admin"]) && (int) $_SESSION["site_admin"]) {
            echo "<td  class=\"admin-border-right\">" . ((int) $row['site_id'] && isset($sites[(int) $row['site_id']]['site']) ? $sites[(int) $row['site_id']]['site'] : '--') . "</td>";
          }

          echo "<td class=\"admin-border-right\">" . mb_strimwidth($row['name'], 0, 25, "...") . "</td>";
          echo "<td class=\"admin-border-right\">" . $courseDetails['course_name'] . "</td>";
          echo "<td  class=\"admin-border-right\">" . ucwords($row['language']) . "</td>";
          echo "<td  class=\"admin-border-right\">" . $link . " </td>";
          $ss__pass_active = ucwords($result) . 
                  (($row['activated'] == "yes" && strtotime($row['date_activated'])) ? ': ' . date('d/m/y', strtotime($row['date_activated'])) 
                  . "  <a href=\"admin-serials.php?serial=" . $row['serial'] ."&&update=yes\">(Update)</a>" : '');

          if ($i > $total_modules) {
                $ss__pass_active = '<span class="passed-green" >Passed: ' . date('d/m/y', strtotime($row['date_activated'] )) . ' </span>';
          }
          echo "<td  class=\"admin-border-right\">" . $ss__pass_active . "</td>";

          if ($row['activated'] == "yes") {
            ?>
            <td  class="download admin-border-right-center"><a href="admin-serials.php?id=<?php echo $row['ID'] ?>"><i class="fa fa-download"></i></a></td>
            <?php
          } else {
            echo "<td class=\"download admin-border-right-center\">-</td></tr>";
          }

        } 
        ?>
    </table>