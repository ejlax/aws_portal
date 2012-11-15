<?php
include_once('verify.php');
require_once 'AWSSDKforPHP/sdk.class.php';
$ec2 = new AmazonEC2();
include_once('header.php');
?>
        <div class="span10">
          <div class="hero-unit">
            <h1>AWS Portal</h1>
            <p>In this portal you will be able to create new AWS instances for QA and Development purposes with the help of the AWS APIs.</p>
            <p><a class="btn btn-primary btn-large" href="//aws.amazon.com/what-is-aws/">Learn more &raquo;</a></p>
          </div>
		<div>
			<h2>Live Service Updates</h2>
          <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab1" data-toggle="tab">AWS Service Health</a></li>
		    <li><a href="#rightScale" data-toggle="tab">RightScale</a></li>
		    <li><a href="#monitoring" data-toggle="tab">Monitoring</a></li>
		  </ul>
		  <div class="tab-content">
		    <div class="tab-pane active" id="tab1">
              	<p><script type='text/javascript' charset='utf-8' src='http://scripts.hashemian.com/jss/feed.js?print=yes&numlinks=10&summarylen=50&seedate=yes&popwin=yes&url=http:%2F%2Fstatus.aws.amazon.com%2Frss%2Fec2-us-east-1.rss'></script>
				</p>
			  </p>
		    </div>
		    <div class="tab-pane" id="rightScale">
		      <p><script type='text/javascript' charset='utf-8' src='http://scripts.hashemian.com/jss/feed.js?print=yes&numlinks=10&summarylen=50&seedate=yes&popwin=no&url=http:%2F%2Fmy.rightscale.com%2Facct%2F19654%2Fuser_notifications%2Ffeed.atom%3Ffeed_token%3Dfada3a148e2f4effb8e2868a134448e13e466964'>
				</script>
				</p>
		    </div>
		    <div class="tab-pane" id="monitoring">
		      <p><a href="#"><img src="https://my.rightscale.com/sketchy1-57/hosts/01-2320B2G/plugins/load/views/load.png?title=prd-mdb-01&period=day&clip=&size=small&deployment_title=&tok=pV4BcejSDhqFWmE0FHDs1AA&tz=America%2FDenver&t=1350079184736"></a></p>
		    </div>
		  </div>
  		</div><!--/endtab-->
<?php
include_once('footer.php');
?>
