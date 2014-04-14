    <!--==============================footer=================================-->
    <footer>
      <div class="container">
         <div class="row">
           <div class="span12">
              <ul class="social-icons">
                  <li><a href="<?=base_url().$this->lang->lang();?>/contacto"><img src="<?=base_url();?>img/_old_web/_email.png" alt="<?=lang('footer.email');?>"></a></li>
                  <li><a target="_blank" href="https://www.facebook.com/Emakers?fref=ts"><img src="<?=base_url();?>img/_old_web/_facebook.png" alt="<?=lang('footer.facebook');?>"></a></li>
                  <li><a target="_blank" href="https://twitter.com/emakers_es"><img src="<?=base_url();?>img/_old_web/_twitter.png" alt="<?=lang('footer.twitter');?>"></a></li>
              </ul>
              <div class="footer-logo">
              	<a href="<?=base_url().$this->lang->lang();?>">
              		<img src="<?=base_url()?>img/_old_web/logo_header_bn.png" />
              	</a>
              	<span> &copy; 2013 | <?=lang('footer.derechos');?></span><br>
              </div>
           </div>
         </div>  
      </div>
    </footer>
<script type="text/javascript" src="<?=base_url();?>js/_old_web/bootstrap.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37509776-3']);
  _gaq.push(['_setDomainName', 'emakers.es']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>