 <table  class="table align-middle table-bordered" >
    <thead>

        <tr>



            <th scope="col">Order #</td>

    <?php if (isset($_SESSION["site_admin"]) && (int) $_SESSION["site_admin"]) { ?>

              <th scope="col">Site</td>	

    <?php } ?>

            <th scope="col">Name</td>

	        <th scope="col">Course</td>

            <th scope="col">Language</td>

            <th scope="col">Module Progress</td> 

            <th scope="col">Status</td>

            <th scope="col">Password</td>



        </tr>
        </thead>
        <tbody>
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

            $result = '<a style="color: green;" href="admin-serials.php?serial=' . $row['serial'] . '&&update=no"><u> Admin Activation </u> <strong>' . $suffix_resit . '</strong></a>';

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

              $link = "<u><a style='color: green;' href=\"admin-modules.php?x=" . $row['ID'] . "\">" . $completed_modules . "/" . $courseDetails['modules_admin'] . " Modules" . ( ($completed_modules >= $courseDetails['modules_admin']) ? ' (Cert. sent)'  : ''  ) . "{$suffix_resit}</u></a>";



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



          echo "<td><span>" . $row['order-number'] . "</span></td>";

          if (isset($_SESSION["site_admin"]) && (int) $_SESSION["site_admin"]) {

            echo "<td ><span>" . ((int) $row['site_id'] && isset($sites[(int) $row['site_id']]['site']) ? $sites[(int) $row['site_id']]['site'] : '--') . "</span></td>";

          }

          echo "<td><span>" . mb_strimwidth($row['name'], 0, 25, "...") . "</span></td>";

          echo "<td><span>" . $courseDetails['course_name'] . "</span></td>";

          echo "<td ><span>" . ucwords($row['language']) . "</span></td>";

          echo "<td ><span>" . $link . " </span></td>";

          $ss__pass_active = ucwords($result) . 

                  (($row['activated'] == "yes" && strtotime($row['date_activated'])) ? ': ' . date('d/m/y', strtotime($row['date_activated'])) 

                  . "  <a style='color: green;' href=\"admin-serials.php?serial=" . $row['serial'] ."&&update=yes\"><u>(Update)</u></a>" : '');



          if ($i > $total_modules) {

                $ss__pass_active = '<span style="color: green;" class="passed-green" >Passed: ' . date('d/m/y', strtotime($row['date_activated'] )) . ' </span>';

          }

          echo "<td ><span>" . $ss__pass_active . "</span></td>";



          if ($row['activated'] == "yes") {

            ?>
            <td scope="row">
                                    <a href="admin-serials.php?id=<?php echo $row['ID'] ?>">
                                        <img src="assets/images/icon/download.svg" width="32" alt="link">
                                    </a>
                                </td>

           
            <?php

          } else {

            echo "<td class=\"download admin-border-right-center\">-</span></td></tr>";

          }



        } 

        ?>
    </tbody>
    </table>