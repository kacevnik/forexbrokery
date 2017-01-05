<?php global $site_url;?>    
	<form action="<?php echo $site_url;?>" method="get">
	    <div class="searchform">
	        <input type="text" class="input" name="s" value="<?php echo $_GET['s'];?>" /> 
	        <input type="submit" class="submit" name="" value="Поиск" />
	
	    <div id="fbpajaxform"></div>
			
        </div>
    </form>