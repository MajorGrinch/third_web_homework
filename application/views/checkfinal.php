		<form action="" class="form">
            <fieldset>

            	<div class="formRow" method="post">
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
                    <label><strong>报告内容:</strong></label>
                    <div class="formRight"><p><?php echo $final_report; ?></p></textarea></div>
                    <div class="clear"></div>
                </div>

            </fieldset>
       	</form>