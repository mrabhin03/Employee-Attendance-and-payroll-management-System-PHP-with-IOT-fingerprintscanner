<?php
  include '../common/connection.php';
  $month=array("","January","February","March","April","May","June","July","August","September","October","November","December");
  $year = date('Y');
  ?>
<div class="calendar">
    <div class="head">
        <a href="?page=addcal"><button>ADD</button></a>
        <h2>Calendar Details</h2>
        <form method="post">
            <select onchange="this.form.submit()" name="date" id="">
              <?php
              if(isset($_POST["date"]))
              {
                $year=$_POST["date"];
                for($j= 2020;$j<2040;$j++)
                {
                  if($year==$j)
                  {
                    echo "<option selected value='$j'>$j</option>";
                  }
                  else
                  {
                    echo "<option value='$j'>$j</option>";
                  }
                  
                }
              }
              else
              {
                for($j= 2020;$j<2040;$j++)
                {
                  if($year==$j)
                  {
                    echo "<option selected value='$j'>$j</option>";
                  }
                  else
                  {
                    echo "<option value='$j'>$j</option>";
                  }
                  
                }
              }
              ?>
            </select>
        </form>
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
                    $sql = "SELECT * FROM company_calender WHERE Year='$year'";
                    $query = $con->query($sql);
                    if($query->num_rows)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['Month_id'];?></td>
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