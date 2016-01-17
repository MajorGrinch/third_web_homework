<!-- Table with check all checkboxes fubction -->
        <div class="widget">
        <div class="title"><h6><?php echo $name; ?></h6></div>
        <form action="index.php/test/sel_prj" method="post" >
          <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck" id="checkAll">
              <thead>
                  <tr>
                      <td>学号</td>
                      <td>姓名</td>
                      <td>选择</td>
                  </tr>
              </thead>
              <tbody>
                <?php foreach( $stu as $stu_item ): ?>
                  <tr>
                      <td><?php echo $stu_item['account']; ?></td>
                      <td><?php echo $stu_item['name']; ?></td>
                      <td>
                        <button type="button" class="logMeIn dblueB" onclick="cnfirm(<?php echo $stu_item['account']; ?>)">选择</button>
                      </td>
                  </tr>
                <?php endforeach; ?> 
              </tbody>
          </table>
          </form>
        </div>
        <button type="button" class="apply dblueB" onclick="apply()">立项</button>

  <script type="text/javascript"> 
  function cnfirm(stu_account)
  {
    if(confirm("您确定选择此人？"))
    {
        location.href='index.php/teacher/choose_stu/'+stu_account;
    }
   
  }
  function apply()
  {
    if(confirm("您确定立项？"))
    {
      location.href='index.php/teacher/apply_prj/';
    }
  }
  </script>