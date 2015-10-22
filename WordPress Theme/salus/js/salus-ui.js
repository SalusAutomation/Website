jQuery(document).ready(function($) {
  //
  //  SCROLLING
  //  Implements "smooth" scrolling on
  //  all on-page #anchor links
  //  Source: https://css-tricks.com/snippets/jquery/smooth-scrolling/
  //  —·—·—·—·—·—·—·—·—·—

  $('a[href*=#]:not([href=#])').click(function() {
    console.log("clicked");
    if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");

      if (target.length) {
        $("html, body").animate({
          scrollTop: target.offset().top
        }, 500, "easeOutCirc");

        return false;
      }
    }
  });

})