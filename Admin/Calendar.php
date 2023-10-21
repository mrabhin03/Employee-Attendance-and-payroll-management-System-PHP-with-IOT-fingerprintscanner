<?php
  include '../common/connection.php';
  $month=array("","January","February","March","April","May","June","July","August","September","October","November","December");
  ?>
<div class="calendar">
    <div class="head">
        <a href="?page=addcal"><button>ADD</button></a>
        <h2>Calendar Details</h2>
    </div>
    <div class="cal_data">
        <div class="cal_detail">
        <table >
                <thead>
                  <th>SI</th>
                  <th>Year</th>
                  <th>Month</th>
                  <th>Day</th>
                  <th>Tools</th>
                </thead>
                <tbody >
                  <?php
                    $sql = "SELECT * FROM company_calender";
                    $query = $con->query($sql);
                    if($query->num_rows)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $i; $i=$i+1;?></td>
                          <td><?php echo $row['Year']; ?></td>
                          <td><?php echo $month[$row['Month']]; ?></td>
                          <td><?php echo $row['Working_day']; ?></td>
                          <td>
                          <?php $data=$row['Month_id']; echo "<a href='?page=delete_calender&id=$data'><button class='view-emp' >Delete</button></a>" ?>                            
                          </td>
                        </tr>
                      <?php
                    }
                  }
                  else
                  {
                    ?>
                    <tr>
                      <td colspan="8">
                        NO DATA
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
        </div>
    </div>
</div>