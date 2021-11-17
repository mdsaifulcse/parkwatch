<div class="content">
    <div class="row"> 
        <div class="col-sm-12">
            <div id="message"></div>
        </div>
        
        <div class="col-sm-12">
            <form action="./app/controller/Setup_process.php" method="post" class="form-horizontal" id="setupForm">

                <input type="hidden" name="csrf_token" value="<?= (!empty($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : null) ?>">

  
                <!-- App URL -->
                <div class="form-group">
                    <label for="app_url"  class="col-sm-4 control-label">App URL *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="app_url" placeholder="App URL" name="app_url" value="<?= (isset($_POST['app_url']) ? $_POST['app_url'] : 'http://localhost') ?>">
                    </div>
                </div>  

                <!-- Database Connection -->
                <input type="hidden" name="db_connection" value="mysql">

                <!-- Database Hostname -->
                <div class="form-group">
                    <label for="db_host"  class="col-sm-4 control-label">Database Hostname</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="db_host" placeholder="Database Hostname" name="db_host" value="<?= (isset($_POST['db_host']) ? $_POST['db_host'] : '127.0.0.1') ?>">
                    </div>
                </div>   

                <!-- Database Port -->
                <div class="form-group">
                    <label for="db_port"  class="col-sm-4 control-label">Database Port</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="db_port" placeholder="Database Port" name="db_port" value="<?= (isset($_POST['db_port']) ? $_POST['db_port'] : '3306') ?>">
                    </div>
                </div> 

                <!-- Database Name -->
                <div class="form-group">
                    <label for="db_name"  class="col-sm-4 control-label">Database Name *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="db_name" placeholder="Database Name" name="db_name" value="<?= (isset($_POST['db_name']) ? $_POST['db_name'] : '') ?>">
                    </div>
                </div>  
                
                <!-- Database Username -->
                <div class="form-group">
                    <label for="db_username"  class="col-sm-4 control-label">Database Username *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="db_username" placeholder="Database Username" name="db_username" value="<?= (isset($_POST['db_username']) ? $_POST['db_username'] : 'root') ?>">
                    </div>
                </div>  
                
                <!-- Database Password -->
                <div class="form-group">
                    <label for="db_password"  class="col-sm-4 control-label">Database Password</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="db_password" placeholder="Database Password" name="db_password" value="<?= (isset($_POST['db_password']) ? $_POST['db_password'] : '') ?>">
                    </div>
                </div>   

                <div class="divider"></div>
                <div class="pull-right">
                    <button type="reset" class="cbtn">Reset</button>
                    <button type="submit" class="cbtn">Install</button>
                </div>

            </form> 
        </div>
    </div>
</div>
