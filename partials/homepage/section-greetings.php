<!-- Homepage - Hero section -->

<?php
$radiobutton = get_field('home_greetings')['greetings_show_hide'];
$section_title = get_field('home_greetings')['greetings_title'];
$photo = get_field('home_greetings')['greetings_photo'];
$text = get_field('home_greetings')['greetings_text'];

?>
<?php if($radiobutton=='true'): ?>
  <section class="greetings">

    <div class="wrapper">

      <h2 class="section-title"><?php echo $section_title; ?></h2>

      <div class="inner">

        <div class="text">
          <?php if ($photo['greetings_photo_show_hide']) { ?>
            <img class="governor" src="<?php echo $photo['greetings_photo_file'] ?>" alt="Δήμαρχος Αμπελοκήπων Μενεμένης">
          <?php } ?>
          <div class="text-content hideContent">
            <?php echo $text; ?>
          </div>
          <div class="show-more" data-show="more">
            <a href="#"> <?php _e('Διαβάστε περισσότερα', 'gov-portal'); ?></a>
          </div>
          
        </div>

      </div>


    </div>

  </section>
<?php  endif; ?>
  <script>

    const showGreeting = document.querySelector('.show-more a')
    showGreeting.addEventListener('click', (e)=>{
      e.preventDefault();
      const container = showGreeting.parentNode;
      const text = container.previousElementSibling;

      if(container.dataset.show == 'more'){
        container.dataset.show = 'less';
        showGreeting.innerHTML = 'Λιγότερα';
      }else {
        container.dataset.show = 'more';
        showGreeting.innerHTML = 'Διαβάστε περισσότερα';
      }

      text.classList.toggle('showContent');
      text.classList.toggle('hideContent')
      
    })
    
    // $(".show-more a").on("click", function(e) {
    //   e.preventDefault();

    //   var $this = $(this); 
    //   var $content = $this.parent().prev("div.content");
    //   var linkText = $this.text().toUpperCase();    
      
    //   if(linkText === "ΔΙΑΒΑΣΤΕ ΠΕΡΙΣΣΟΤΕΡΑ"){
    //       linkText = "Show less";
    //       $content.switchClass("hideContent", "showContent", 400);
    //   } else {
    //       linkText = "Show more";
    //       $content.switchClass("showContent", "hideContent", 400);
    //   };

    //   $this.text(linkText);
    // });
  </script>

