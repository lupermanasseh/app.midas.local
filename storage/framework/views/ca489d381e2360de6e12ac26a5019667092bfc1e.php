<div class="overview">
    <h6 class="overview__heading">Search</h6>
    <form class="customsearch" method="POST" action="/Dashboard/user/customsearch">
        <?php echo e(csrf_field()); ?>

        <span>From</span>
        <div class="customsearch__item"><input class="custom-input" type="date" name="from" id="from"></div>
        <span>To</span>
        <div class="customsearch__item"><input class="custom-input" type="date" name="to" id="to"></div>
        
        <div class="customsearch__item"><button class="custom-input" type="submit">Search</button></div>
    </form>
</div>