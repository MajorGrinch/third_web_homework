
<!-- Table with check all checkboxes fubction -->
        <div class="widget">
        <div class="title"><h6>项目列表</h6></div>
        <form action="index.php/test/sel_prj" method="post" >
          <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck" id="checkAll">
              <thead>
                  <tr>
                      <td>项目编号</td>
                      <td>项目名称</td>
                      <td>项目资金</td>
                      <td>指导老师</td>
                      <td>所属年级</td>
                      <td>已选人数</td>
                      <td>选择</td>
                  </tr>
              </thead>
              <tbody>
                <?php foreach( $prj as $prj_item ): ?>
                  <tr>
                      <td><?php echo $prj_item['prj_num']; ?></td>
                      <td><?php echo $prj_item['prj_name']; ?></td>
                      <td><?php echo $prj_item['fina_lv']?></td>
                      <td><?php echo $prj_item['instructor']?></td>
                      <td><?php echo $prj_item['grade']?></td>
                      <td><?php echo $prj_item['curr_mem']?></td>
                      <td>
                          <?php if ($_SESSION['par_prj'] !== NULL):?>    <!-- 判断是否已有项目 -->
                              <button type="button" class="logMeIn dblueB">已有一个项目,不能选择！</button>
                          <?php elseif($prj_item['selected'] == 1): ?>
                            <button type="button" class="logMeIn dblueB">该项目已确定成员</button>
                          <?php else: ?>
                            <button type="button" class="logMeIn dblueB" onclick="cnfirm(<?php echo $prj_item['prj_num']; ?>)">选择项目</button>
                          <?php endif; ?>
                      </td>
                  </tr>
                <?php endforeach; ?> 
              </tbody>
          </table>
          </form>
        </div>

  <script type="text/javascript"> 
  function cnfirm(prj_num)
  {
    if(confirm("您确定选择此项目？"))
    {
        location.href='index.php/test/choose/'+prj_num;
    }
   
  }
  </script>