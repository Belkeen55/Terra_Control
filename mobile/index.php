<?php
	exec('sudo /var/www/html/Adafruit_Python_DHT/examples/./AdafruitDHT.py 22 17', $rep_cmd_DHT22);
	$tempDHT22 = substr($rep_cmd_DHT22[0], 0);
	exec('python /var/www/html/DS/temp.py', $rep_cmd_DS);
	$tempDS = substr($rep_cmd_DS[0], 0);
?>
<form>
        <input type="text" name="tempDHT22" value="<?php echo $tempDHT22; ?>" />
        <input type="text" name="tempDS" value="<?php echo $tempDS; ?>" />
</form>