        <form action="index.php/test/add_log" class="form" method="post">
            <fieldset>

                <div class="formRow" >
                    <label><strong>项目名称:</strong></label>
                    <label class = "formRight"><strong><?php echo $prj_name; ?></strong></label>
                </div>

                <div class="formRow">
                    <label><strong>指导老师:</strong></label>
                    <label class = "formRight"><strong><?php echo $instructor; ?></strong></label>
                </div>

                <div class="formRow">
                    <label><strong>组长:</strong></label>
                    <label class = "formRight"><strong><?php echo $leader_num."  ".$leader_name; ?></strong></label>
                </div>

                <div class="formRow">
                    <label><strong>日志内容:</strong></label>
                    <div class="formRight"><textarea rows="8" cols="" name="content"></textarea></div>
                    <div class="clear"></div>
                </div>

                <input type="submit" value="提交日志">
            </fieldset>
        </form>