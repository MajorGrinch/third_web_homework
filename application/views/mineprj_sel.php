    <div class="widget">
      <div class="title"><h6>项目列表</h6></div>
          <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck" id="checkAll">
              <thead>
                  <tr>
                      <td>项目名称</td>
                      <td>项目资金</td>
                      <td>指导老师</td>
                      <td>操作</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td><?php echo $prj_name; ?></td>
                      <td><?php echo $fina_lv; ?></td>
                      <td><?php echo $instructor ?></td>
                      <td>
                        <button type="button" class="logMeIn dblueB" onclick="del(<?php echo $prj_num; ?>)">退选</button>
                      </td>
                  </tr>
              </tbody>
          </table>
    </div>
  <script type="text/javascript"> 
  function del(prj_num)
  {
    if(confirm("您确定删除此项目？"))
    {
        location.href='index.php/test/del/'+prj_num;
    }
   
  }
  </script>