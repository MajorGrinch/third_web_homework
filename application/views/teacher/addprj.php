<base href="<?php echo base_url(); ?>" />
<!DOCTYPE HTML>
<html class="no-js">
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>发布项目</title>
        <link rel="stylesheet" href="http://www.jisxu.top/admin/css/normalize.css?v=14.10.10">
        <link rel="stylesheet" href="http://www.jisxu.top/admin/css/grid.css?v=14.10.10">
        <link rel="stylesheet" href="http://www.jisxu.top/admin/css/style.css?v=14.10.10">
    </head>
<body>
    <form action="index.php/teacher/poprj" method="post">
        <fieldset>
            <div class="main">
                <div class="body container">
                    <div class="typecho-page-title">
                <h2>发布新项目</h2>
                    </div>                        
                <p class="title">
                    <label for="title" class="sr-only">项目名称</label>
                    <input type="text" id="title" name="title" autocomplete="off" value="" placeholder="项目名称"  />
                    <label>        </label><input type="text" name="prj_num" placeholder="项目编号" />
                    <label>        </label><input type="text" name="instructor" placeholder="指导老师" />
                    <label>        </label><input type="text" name="applicant" placeholder="申请人"  /><br>
                    <label>        </label><input type="text" name="final_lv"  placeholder="经费预算"/>
                    <label>        </label><input type="text" name="property" placeholder="项目类型" />
                    <label>        </label><input type="text" name="start_date" placeholder="开始时间:如2015-12-31" />
                    <label>        </label><input type="text" name="finish_date" placeholder="结束时间:如2016-01-01" />
                </p>                                           
                <p>
                    <label for="text" class="sr-only">内容</label>
                    <textarea style="height: 350px" autocomplete="off" id="text" name="text" class="w-100 mono"></textarea>
                </p>                 
                    <button type="submit" name="do" value="publish" class="btn_primary" id="btn-submit">发布项目</button>
                    
            </div>
        </fieldset>
    </form>
</body>
</html>
