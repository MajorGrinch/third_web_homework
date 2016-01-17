<!-- Table with check all checkboxes fubction -->
        <div class="widget">
        <div class="title"><h6>日志列表</h6></div>
        <form action="index.php/test/sel_prj" method="post" >
          <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck" id="checkAll">
              <thead>
                  <tr>
                      <td>项目名称</td>
                      <td>日志内容</td>
                  </tr>
              </thead>
              <tbody>
                <?php foreach( $log as $log_item): ?>
                  <tr>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $log_item['content']; ?></td>
                  </tr>
                <?php endforeach; ?> 
              </tbody>
          </table>
          </form>
        </div>