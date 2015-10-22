<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package salus
 */

?>
	
  </div> <!-- /.main -->
  </main> <!-- /.site-main -->

</div> <!-- /.site -->

<!-- <footer> is outside of main .site frame for "sticky" footer setup. -->
<footer class="site-footer">
  <div class="frame">
    <?php
      // Get current year
      $yearNow = date('Y');
    ?>
    <p class="copyright">Copyright &copy; <?php echo $yearNow; ?> Salus, Inc. All&nbsp;rights&nbsp;reserved.</p>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
