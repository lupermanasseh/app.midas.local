<section class="section section-stats center">
    <div class="row search_bar">
        <form class="customsearch" method="POST" action="/search/User">
            <?php echo e(csrf_field()); ?>


            <div class="customsearch__item"><input class="custom-input custom-width" type="text" name="search_term"
                    id="search_term" placeholder="Provide IPPIS or First Name">
            </div>
            <div class="customsearch__item"><button class="custom-input" type="submit">Search</button></div>
        </form>
    </div>
    
</section>