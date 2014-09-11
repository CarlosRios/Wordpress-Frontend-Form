<?php
/* Gather Options */
$sitetitle = get_bloginfo('name');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title></title>
  <meta name="viewport" content="width=device-width" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body bgcolor="#f3f3f3">

<!-- header -->
<table class="head-wrap">
  <tr>
    <td></td>
    <td class="header container">
      <div class="content">
        <table>
          <tr>
            <td class="logo">
              <a href="http://codecanyon.net/item/wordpress-frontend-form/8659223"><img src="http://lavabucket.co/wp-content/uploads/projects/wpff_logo_light.png" alt="" /></a>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>


<!-- body -->
<table class="body-wrap">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">
      <div class="content wrapper">
      <table>
        <tr>
          <td>
            <h3 style="text-align:center;">You have a new submission at<br><small><?php echo $sitetitle; ?></small></h3>
            <ul class="nolist">
            <?php foreach($data as $label => $value) : ?>
              <li><strong><?php echo $label; ?></strong> - <?php echo $value; ?></li>
            <?php endforeach; ?>
            </ul>
            <p style="text-align:center;"><a href="<?php echo admin_url('edit.php?post_type=wpfrontendform'); ?>" class="primary-button">View Submission</a></p>
          </td>
        </tr>
      </table>
      </div>            
    </td>
    <td></td>
  </tr>
</table><!-- /body -->

<!-- FOOTER -->
<table class="footer-wrap">
  <tr>
    <td></td>
    <td class="container">
      
      <!-- content -->
      <div class="content footer-content">
      <table>
      <tr>
        <td align="center">
          <p class="desc">
            You are receiving this email to notify you of a new submission to <?php echo $sitetitle; ?>. To stop receiving emails simply change your form settings <a href="<?php echo admin_url('edit.php?post_type=wpfrontendform'); ?>">here</a>.
          </p>
          <p>
            <a href="http://codecanyon.net/item/wordpress-frontend-form/8659223">Forms powered by WordPress Frontend Forms</a>
          </p>
        </td>
      </tr>
      </table>
      </div><!-- /content -->
        
    </td>
    <td></td>
  </tr>
</table><!-- /FOOTER -->

</body>
</html>